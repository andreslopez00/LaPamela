<template>
  <div class="container fade-in mt-5">
    <h2 class="mb-4 text-center">Completa tu pedido</h2>

    <form @submit.prevent="realizarPago" class="row g-3">
      <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre" required />
      </div>

      <div class="col-md-6">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" required />
      </div>

      <div class="col-12">
        <label for="direccion" class="form-label">Dirección de envío</label>
        <input type="text" class="form-control" id="direccion" required />
      </div>

      <div class="col-12">
        <label for="tarjeta" class="form-label">Número de tarjeta</label>
        <input type="text" class="form-control" id="tarjeta" required />
      </div>

      <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary mt-4">Pagar ahora</button>
      </div>
    </form>
  </div>
</template>

<script setup>
function realizarPago() {
  alert('¡Gracias por tu compra en La Pamela! Tu pedido será procesado ✨.');
}
</script>
