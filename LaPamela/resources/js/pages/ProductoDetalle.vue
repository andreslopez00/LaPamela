<template>
  <div class="container mt-5 fade-in">
    <div v-if="producto" class="row">
      <div class="col-md-6">
        <img :src="getImagenUrl(producto.imagen)" class="img-fluid rounded shadow" />
      </div>
      <div class="col-md-6">
        <h2>{{ producto.nombre }}</h2>
        <p class="lead">{{ producto.descripcion }}</p>
        <h4 class="text-primary">{{ producto.precio }} €</h4>
        <button class="btn btn-success mt-3" @click="agregarAlCarrito(producto)">
          Añadir al carrito
        </button>
      </div>
    </div>
    <div v-else class="text-center">
      <p>Cargando producto...</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const producto = ref(null);

function getImagenUrl(imagen) {
  if (!imagen) return '';
  if (imagen.startsWith('http')) return imagen;
  return '/' + imagen;
}

// Esta función se espera que venga como prop desde App.vue
defineProps(['agregarAlCarrito'])

onMounted(() => {
  fetch(`/producto-data/${route.params.id}`)
    .then(res => res.json())
    .then(data => {
      producto.value = data;
    });
});
</script>
