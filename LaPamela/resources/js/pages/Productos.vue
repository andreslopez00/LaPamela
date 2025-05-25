<template>
  <div class="container fade-in mt-5">
    <h2 class="text-center mb-5">Catálogo de Productos Semana Santa</h2>
    <div class="row">
      <div
        class="col-md-4 mb-4"
        v-for="producto in productos"
        :key="producto.id"
      >
        <div class="card h-100">
          <img :src="producto.imagen" class="card-img-top" :alt="producto.nombre" />
          <div class="card-body text-center">
            <h5 class="card-title">{{ producto.nombre }}</h5>
            <p class="card-text">{{ producto.descripcion }}</p>
            <p class="fw-bold text-primary">{{ producto.precio }} €</p>
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
import { defineProps, ref } from 'vue'

const props = defineProps(['agregarAlCarrito'])

const productos = ref([
  {
    id: 1,
    nombre: 'Vela Procesional',
    descripcion: 'Vela blanca de cera pura para procesiones.',
    precio: 15.00,
    imagen: 'https://s10.s3c.es/imag/_v0/1600x873/a/a/c/ceraruso.jpeg'
  },
  {
    id: 2,
    nombre: 'Incienso Premium',
    descripcion: 'Incienso tradicional de Semana Santa.',
    precio: 9.99,
    imagen: 'https://palaciodeincienso.com/cdn/shop/files/PACKSEMANASANTAENSEVILLA.jpg?v=1694464327'
  },
  {
    id: 3,
    nombre: 'Mantilla Española',
    descripcion: 'Mantilla negra bordada para celebraciones religiosas.',
    precio: 89.00,
    imagen: 'https://images.ecestaticos.com/FljfWOexuoxoFalhzAaP1-WwBZI=/0x0:2272x1556/1200x900/filters:fill(white):format(jpg)/f.elconfidencial.com%2Foriginal%2F9e0%2F3fb%2F024%2F9e03fb024161f82c8c5a1968fee15558.jpg'
  }
])
</script>
