<template>
  <div class="container fade-in mt-5">
    <h2 class="mb-4">Carrito de Compras</h2>

    <div v-if="carrito.length === 0" class="text-center">
      <p class="lead">Tu carrito está vacío.</p>
      <router-link to="/productos" class="btn btn-outline-primary">
        Ir a Productos
      </router-link>
    </div>

    <div v-else>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between" v-for="item in carrito" :key="item.id">
          <span>{{ item.nombre }} (x{{ item.cantidad }})</span>
          <span>{{ (item.precio * item.cantidad).toFixed(2) }} €</span>
        </li>
      </ul>

      <div class="text-end">
        <h4>Total: {{ totalCarrito.toFixed(2) }} €</h4>
        <router-link to="/checkout" class="btn btn-success mt-3">
          Finalizar compra
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const carrito = ref([
  { id: 1, nombre: 'Vela Procesional', precio: 15.00, cantidad: 2 },
  { id: 2, nombre: 'Incienso Premium', precio: 9.99, cantidad: 1 }
])

const totalCarrito = carrito.value.reduce((total, item) => total + item.precio * item.cantidad, 0);
</script>
