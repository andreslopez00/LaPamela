<template>
  <div class="container text-center my-5 fade-in">
    <h1 class="text-success mb-4">¡Gracias por tu compra!</h1>
    <p>Tu pedido ha sido procesado y recibirás un correo con tu factura.</p>
    <router-link to="/" class="btn btn-primary mt-4">Volver al inicio</router-link>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'

onMounted(() => {
  const datos = localStorage.getItem('datosPedido')
  if (datos) {
  const pedido = JSON.parse(datos);
  const total = pedido.carrito.reduce((acc, item) => acc + item.precio * item.cantidad, 0);

  fetch('/pedido', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
    },
    body: JSON.stringify({
      nombre: pedido.nombre,
      email: pedido.email,
      direccion: pedido.direccion,
      carrito: pedido.carrito,
      total: total,
    }),
  }).then(() => {
    localStorage.removeItem('carrito');
    localStorage.removeItem('datosPedido');
  });
}

})
</script>

