<template>
  <div class="container fade-in mt-5">
    <h2 class="text-center mb-5">Catálogo de Productos Semana Santa</h2>

    <h3 class="mt-4 mb-3">Para Músicos</h3>
    <div class="row">
      <ProductCard
        v-for="p in productos.musicos"
        :key="p.id"
        :producto="p"
        :agregarAlCarrito="agregarAlCarrito"
      />
    </div>

    <h3 class="mt-5 mb-3">Ropa para Costaleros</h3>
    <div class="row">
      <ProductCard
        v-for="p in productos.costaleros"
        :key="p.id"
        :producto="p"
        :agregarAlCarrito="agregarAlCarrito"
      />
    </div>

    <h3 class="mt-5 mb-3">Otros Artículos</h3>
    <div class="row">
      <ProductCard
        v-for="p in productos.otros"
        :key="p.id"
        :producto="p"
        :agregarAlCarrito="agregarAlCarrito"
      />
    </div>
  </div>
</template>

<script setup>
import { defineProps, reactive } from 'vue'
import ProductCard from '@/components/ProductCard.vue'

const props = defineProps(['agregarAlCarrito'])

const productos = reactive({
  musicos: [
    {
      id: 1,
      nombre: 'Trompeta Yamaha',
      descripcion: 'Trompeta Yamaha perfecta para AM Y CCTT.',
      precio: 120.00,
      imagen: '/images/instrumento.jpg'
    },
    {
      id: 2,
      nombre: 'Corneta Honsuy',
      descripcion: 'Corneta Honsuy DO/Slb perfecta para cornetería de CCTT.',
      precio: 279.90,
      imagen: '/images/corneta.jpg'
    },

  ],
  costaleros: [
    {
      id: 4,
      nombre: 'Costal Saco Yute',
      descripcion: 'Costal tradicional confeccionado con saco de yute.',
      precio: 25.00,
      imagen: '/images/costal.jpg'
    },
    {
      id: 5,
      nombre: 'Faja Tradicional',
      descripcion: 'Faja negra de tela fuerte para costalero.',
      precio: 18.00,
      imagen: '/images/faja-tradicional.jpg'
    },
    {
      id: 6,
      nombre: 'Faja Elástica',
      descripcion: 'Faja moderna de sujeción lumbar.',
      precio: 22.00,
      imagen: '/images/faja-elastica.jpg'
    },
    {
      id: 7,
      nombre: 'Zapatos Negros',
      descripcion: 'Zapatos resistentes y cómodos para procesión.',
      precio: 38.00,
      imagen: '/images/zapatos.jpg'
    },
    {
      id: 8,
      nombre: 'Camiseta Tirantas',
      descripcion: 'Camiseta blanca sin mangas para costalero.',
      precio: 12.00,
      imagen: '/images/camiseta-tirantes.jpg'
    },
    {
      id: 9,
      nombre: 'Camiseta de manga corta',
      descripcion: 'Camiseta blanca básica para procesión.',
      precio: 10.00,
      imagen: '/images/camiseta-corta.jpg'
    }
  ],
  otros: [
    {
      id: 10,
      nombre: 'Traje de Mantilla',
      descripcion: 'Vestido negro elegante para mantilla sevillana.',
      precio: 99.00,
      imagen: '/images/mantilla1.jpg'
    },
    {
      id: 11,
      nombre: 'Guantes de Nazareno',
      descripcion: 'Guantes blancos para acompañamiento penitente.',
      precio: 6.50,
      imagen: '/images/guantes.jpg'
    },
    {
      id: 12,
      nombre: 'Sudadera La Pamela',
      descripcion: 'Sudadera oficial de la tienda La Pamela.',
      precio: 30.00,
      imagen: '/images/sudadera.jpg'
    }
  ]
})
</script>
