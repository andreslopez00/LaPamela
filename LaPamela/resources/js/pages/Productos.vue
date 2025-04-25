<template>
    <div class="container mt-5">
      <h2 class="mb-4">Nuestros Productos</h2>
      <div class="row">
        <div
          class="col-md-4 mb-4"
          v-for="producto in productos"
          :key="producto.id"
        >
          <div class="card h-100">
            <img :src="producto.imagen" class="card-img-top" alt="Producto" />
            <div class="card-body">
              <h5 class="card-title">{{ producto.nombre }}</h5>
              <p class="card-text">{{ producto.descripcion }}</p>
              <p class="card-text fw-bold">{{ producto.precio }} €</p>
              <button class="btn btn-success" @click="agregarAlCarrito(producto)">
                Añadir al carrito
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const productos = ref([
    {
      id: 1,
      nombre: 'Pamela Clásica',
      descripcion: 'Sombrero elegante para eventos',
      precio: 49.99,
      imagen: 'https://via.placeholder.com/300x200'
    },
    {
      id: 2,
      nombre: 'Pamela Verano',
      descripcion: 'Perfecta para la playa',
      precio: 29.99,
      imagen: 'https://via.placeholder.com/300x200'
    },
    {
      id: 3,
      nombre: 'Pamela Gala',
      descripcion: 'Ideal para bodas y ocasiones especiales',
      precio: 89.99,
      imagen: 'https://via.placeholder.com/300x200'
    }
  ])
  
  function agregarAlCarrito(producto) {
    alert(`Producto "${producto.nombre}" añadido al carrito.`)
  }
  </script>
  