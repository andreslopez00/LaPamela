<template>
    <div class="container mt-5">
      <h2 class="mb-4">Checkout</h2>
      <form @submit.prevent="realizarPago">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre completo</label>
          <input type="text" class="form-control" id="nombre" required />
        </div>
  
        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección</label>
          <input type="text" class="form-control" id="direccion" required />
        </div>
  
        <div class="mb-3">
          <label for="tarjeta" class="form-label">Número de tarjeta</label>
          <input type="text" class="form-control" id="tarjeta" required />
        </div>
  
        <button type="submit" class="btn btn-primary">Pagar ahora</button>
      </form>
    </div>
  </template>
  
  <script setup>
  function realizarPago() {
    alert('¡Gracias por tu compra en La Pamela! 🛒');
  }
  </script>
  