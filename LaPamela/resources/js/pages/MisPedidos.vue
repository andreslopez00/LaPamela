<template>
  <div class="container fade-in my-5">
    <h2 class="text-center mb-4">🧾 Historial de Pedidos</h2>

    <div v-if="pedidos.length === 0" class="text-center mt-5">
      <p>No tienes pedidos registrados aún.</p>
      <router-link class="btn btn-primary mt-3" to="/productos">Ver productos</router-link>
    </div>

    <div v-else>
      <div v-for="(pedido, index) in pedidos" :key="index" class="card mb-4 shadow">
        <div class="card-header bg-primary text-white">
          Pedido #{{ pedido.id }} - {{ formatearFecha(pedido.created_at) }}
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li
              v-for="(item, idx) in pedido.productos"
              :key="idx"
              class="list-group-item d-flex justify-content-between"
            >
              <div>
                {{ item.nombre }} <br />
                <small>Cantidad: {{ item.cantidad }}</small>
              </div>
              <div>{{ (item.precio * item.cantidad).toFixed(2) }} €</div>
            </li>
          </ul>
          <div class="text-end fw-bold mt-3">
            Total: {{ pedido.total.toFixed(2) }} €
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const pedidos = ref([])

onMounted(() => {
  fetch('/mis-pedidos')
    .then(res => res.json())
    .then(data => {
      pedidos.value = data
    })
})

// Formatear fecha en formato legible
function formatearFecha(fecha) {
  return new Date(fecha).toLocaleDateString('es-ES', {
    day: '2-digit',
    month: 'long',
    year: 'numeric',
  })
}
</script>
