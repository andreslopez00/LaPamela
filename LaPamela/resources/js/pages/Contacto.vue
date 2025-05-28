<template>
  <div class="container fade-in my-5">
    <h2 class="text-center mb-4">📬 Contáctanos</h2>

    <form @submit.prevent="enviarMensaje" class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" v-model="nombre" required />
      </div>
      <div class="col-md-6">
        <label class="form-label">Correo</label>
        <input type="email" class="form-control" v-model="email" required />
      </div>
      <div class="col-12">
        <label class="form-label">Mensaje</label>
        <textarea class="form-control" rows="5" v-model="mensaje" required></textarea>
      </div>
      <div class="col-12 text-center">
        <button class="btn btn-primary px-5 mt-3">Enviar</button>
      </div>
    </form>

    <div v-if="enviado" class="alert alert-success mt-4 text-center">
      Tu mensaje ha sido enviado correctamente.
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const nombre = ref('')
const email = ref('')
const mensaje = ref('')
const enviado = ref(false)

function enviarMensaje() {
  // Simulación de envío
  console.log({ nombre: nombre.value, email: email.value, mensaje: mensaje.value })
  enviado.value = true
  nombre.value = ''
  email.value = ''
  mensaje.value = ''
}
</script>
