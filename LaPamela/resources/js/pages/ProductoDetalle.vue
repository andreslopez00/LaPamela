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

    <!-- Reseñas -->
    <div class="mt-5">
      <h3>⭐ Opiniones</h3>

      <div v-if="resenas.length === 0" class="text-muted mb-4">Este producto aún no tiene reseñas.</div>

      <ul class="list-group mb-4" v-else>
        <li v-for="resena in resenas" :key="resena.id" class="list-group-item">
          <strong>{{ resena.user.name }}</strong> 
          <span class="text-warning">★ {{ resena.rating }}/5</span><br>
          <small class="text-muted">{{ formatearFecha(resena.created_at) }}</small>
          <p class="mb-0 mt-1">{{ resena.comment }}</p>
        </li>
      </ul>

      <div v-if="logueado">
        <h5 class="mb-3">Escribe tu reseña</h5>
        <form @submit.prevent="enviarResena">
          <div class="mb-2">
            <label class="form-label">Valoración (1-5):</label>
            <input type="number" class="form-control" v-model="nuevaResena.rating" min="1" max="5" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Comentario:</label>
            <textarea class="form-control" v-model="nuevaResena.comment" rows="3" maxlength="1000"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Enviar reseña</button>
        </form>
      </div>

      <div v-else class="alert alert-info mt-4">
        Inicia sesión para dejar una reseña.
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const producto = ref(null);
const resenas = ref([]);
const nuevaResena = ref({ rating: 5, comment: '' });
const logueado = ref(false);
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

defineProps(['agregarAlCarrito']);

function getImagenUrl(imagen) {
  if (!imagen) return '';
  if (imagen.startsWith('http')) return imagen;
  return '/' + imagen;
}

function formatearFecha(fecha) {
  return new Date(fecha).toLocaleDateString('es-ES', {
    day: '2-digit',
    month: 'long',
    year: 'numeric'
  });
}

onMounted(() => {
  fetch(`/producto-data/${route.params.id}`)
    .then(res => res.json())
    .then(data => producto.value = data);

  fetch(`/resenas/${route.params.id}`)
    .then(res => res.json())
    .then(data => resenas.value = data);

  fetch('/user-info')
    .then(res => res.ok ? res.json() : null)
    .then(data => {
      if (data) logueado.value = true;
    });
});

function enviarResena() {
  fetch('/resenas', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify({
      product_id: route.params.id,
      rating: nuevaResena.value.rating,
      comment: nuevaResena.value.comment
    })
  })
    .then(res => res.json())
    .then(() => {
      nuevaResena.value.rating = 5;
      nuevaResena.value.comment = '';
      return fetch(`/resenas/${route.params.id}`);
    })
    .then(res => res.json())
    .then(data => resenas.value = data);
}
</script>
