<template>
  <div class="col-md-4 mb-4">
    <div class="card h-100">
      <div class="image-wrapper">
        <img :src="producto.imagen" class="card-img-top" :alt="producto.nombre" />
      </div>
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
</template>

<script setup>
defineProps(['producto', 'agregarAlCarrito'])
</script>

<style scoped>
.image-wrapper {
  height: 200px;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

.card-img-top {
  max-height: 100%;
  width: auto;
  object-fit: contain;
}
</style>
