<template>
  <div class="container fade-in mt-5">
    <h2 class="mb-4 text-center">Completa tu pedido</h2>

    <form @submit.prevent="realizarPago" class="row g-3">
      <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre" v-model="nombre" required />
      </div>

      <div class="col-md-6">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" v-model="email" required />
      </div>

      <div class="col-12">
        <label for="direccion" class="form-label">Dirección de envío</label>
        <input type="text" class="form-control" id="direccion" v-model="direccion" required />
      </div>

      <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary mt-4">Pagar ahora</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { loadStripe } from '@stripe/stripe-js'

const nombre = ref('')
const email = ref('')
const direccion = ref('')
const carrito = ref([])
const total = ref(0)

onMounted(() => {
  const data = localStorage.getItem('carrito')
  if (data) {
    carrito.value = JSON.parse(data)
    total.value = carrito.value.reduce((acc, item) => acc + item.precio * item.cantidad, 0)
  }
})

async function realizarPago() {
  if (!nombre.value || !email.value || !direccion.value) {
    alert('Por favor, completa todos los campos')
    return
  }

  // Guardar datos en localStorage para luego enviarlos al backend
  localStorage.setItem('datosPedido', JSON.stringify({
    nombre: nombre.value,
    email: email.value,
    direccion: direccion.value,
    carrito: carrito.value
  }))

  const response = await fetch('/crear-sesion-stripe', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
    },
    body: JSON.stringify({
      carrito: carrito.value
    }),
  })

  const data = await response.json()
  const stripe = await loadStripe(import.meta.env.VITE_STRIPE_KEY)
  await stripe.redirectToCheckout({ sessionId: data.id })
}
</script>
