<template>
  <div class="container fade-in mt-5">
    <h2 class="text-center mb-5">Catálogo de Productos Semana Santa</h2>

    <!-- Botón para admins -->
    <div v-if="user?.email === 'admin@gmail.com'" class="text-end mb-4">
      <button class="btn btn-primary" @click="goToAdd">➕ Añadir producto</button>
    </div>

    <div class="row">
      <div
        class="col-md-4 mb-4"
        v-for="producto in productos"
        :key="producto.id"
      >
        <div class="card h-100">
          <router-link :to="`/producto/${producto.id}`">
  <img :src="getImagenUrl(producto.imagen)" class="card-img-top" :alt="producto.nombre" />
</router-link>
          <div class="card-body text-center">
            <h5 class="card-title">
  <router-link :to="`/producto/${producto.id}`" class="text-dark text-decoration-none">
    {{ producto.nombre }}
  </router-link>
</h5>
            <p class="card-text">{{ producto.descripcion }}</p>
            <p class="fw-bold text-primary">{{ producto.precio }} €</p>

            <button class="btn btn-success mb-2" @click="agregarAlCarrito(producto)">
              Añadir al carrito
            </button>

            <!-- Botones para admins -->
            <div v-if="user?.email === 'admin@gmail.com'" class="mt-2">
              <button class="btn btn-warning btn-sm me-2" @click="goToEdit(producto.id)">Editar</button>
              <button class="btn btn-danger btn-sm" @click="goToDelete(producto.id)">Eliminar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';

const props = defineProps(['agregarAlCarrito', 'user']);
const route = useRoute();

const productos = ref([]);

// Cargar productos desde backend
function cargarProductos() {
  fetch('/productos-data')
    .then(res => res.json())
    .then(data => {
      productos.value = data;
    });
}

onMounted(cargarProductos);
watch(() => route.fullPath, cargarProductos);

// Funciones admin
function goToAdd() {
  window.location.href = '/admin/productos/create';
}
function goToEdit(id) {
  window.location.href = `/admin/productos/${id}/edit`;
}
function goToDelete(id) {
  window.location.href = `/admin/productos/${id}/delete`;
}

// Imagen desde internet o local
function getImagenUrl(imagen) {
  if (!imagen) return '';
  return imagen.startsWith('http') ? imagen : '/' + imagen;
}
</script>
