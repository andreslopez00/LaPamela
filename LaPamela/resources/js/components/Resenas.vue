<template>
  <div class="resenas mt-4">
    <h5 class="mb-3">Reseñas</h5>

    <div v-if="logueado">
      <form @submit.prevent="enviarResena">
        <div class="mb-2">
          <label class="form-label">Puntuación:</label>
          <select v-model="nueva.rating" class="form-select">
            <option disabled value="">Selecciona</option>
            <option v-for="n in 5" :key="n" :value="n">{{ n }} estrellas</option>
          </select>
        </div>
        <div class="mb-2">
          <textarea v-model="nueva.comment" class="form-control" rows="3" placeholder="Escribe tu reseña (opcional)"></textarea>
        </div>
        <button class="btn btn-primary">Enviar</button>
      </form>
    </div>
    <div v-else>
      <p class="text-muted">Inicia sesión para dejar una reseña.</p>
    </div>

    <hr />
    <div v-for="r in resenas" :key="r.id" class="mb-3 border-bottom pb-2">
      <strong>{{ r.user.name }}</strong> - {{ r.rating }} ⭐
      <p class="mb-1" v-if="r.comment">{{ r.comment }}</p>
      <small class="text-muted">{{ new Date(r.created_at).toLocaleDateString() }}</small>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router'

const props = defineProps(['user'])
const route = useRoute()
const resenas = ref([])
const nueva = ref({ rating: '', comment: '' })
const logueado = props.user !== null

onMounted(() => {
  cargarResenas()
})

function cargarResenas() {
  axios.get(`/products/${route.params.id}/reviews`)
    .then(res => resenas.value = res.data)
}

function enviarResena() {
  axios.post('/reviews', {
    product_id: route.params.id,
    ...nueva.value
  }).then(() => {
    cargarResenas()
    nueva.value = { rating: '', comment: '' }
  })
}
</script>
