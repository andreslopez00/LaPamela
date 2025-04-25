<template>
    <div class="container mt-5">
      <h2 class="mb-4">Tu Carrito</h2>
  
      <div v-if="carrito.length === 0">
        <p>El carrito está vacío.</p>
        <router-link to="/productos" class="btn btn-outline-primary">
          Ver productos
        </router-link>
      </div>
  
      <div v-else>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between align-items-center" v-for="item in carrito" :key="item.id">
            <span>
              {{ item.nombre }} (x{{ item.cantidad }})
            </span>
            <span>{{ item.precio * item.cantidad }} €</span>
          </li>
        </ul>
  
        <div class="text-end">
          <h4>Total: {{ totalCarrito }} €</h4>
          <router-link to="/checkout" class="btn btn-success mt-3">
            Ir a pagar
          </router-link>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const carrito = ref([
    { id: 1, nombre: 'Pamela Clásica', precio: 49.99, cantidad: 1 },
    { id: 2, nombre: 'Pamela Verano', precio: 29.99, cantidad: 2 }
  ])
  
  const totalCarrito = carrito.value.reduce((total, item) => {
    return total + item.precio * item.cantidad
  }, 0)
  </script>
  