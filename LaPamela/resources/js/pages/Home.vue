<template>
  <div class="home-landing fade-in">

    <section class="hero d-flex flex-column justify-content-center align-items-center text-center text-light">
  <div class="overlay"></div>
  <div class="content z-2">
    <h1 class="display-4 fw-bold">Bienvenido a La Pamela</h1>
    <p class="lead mb-4">Tradición, elegancia y devoción en cada producto de Semana Santa.</p>
    <router-link to="/productos" class="btn btn-lg btn-warning text-dark fw-bold px-5 py-3">
      Ver Productos
    </router-link>
  </div>
</section>


    <!-- Beneficios -->
    <section class="py-5 bg-light">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-4 mb-4">
            <i class="bi bi-truck fs-1 text-success"></i>
            <h5 class="mt-3 fw-bold">Envío rápido</h5>
            <p>Recibe tus productos antes de la próxima procesión.</p>
          </div>
          <div class="col-md-4 mb-4">
            <i class="bi bi-patch-check fs-1 text-primary"></i>
            <h5 class="mt-3 fw-bold">Calidad garantizada</h5>
            <p>Productos seleccionados con el máximo cuidado y respeto.</p>
          </div>
          <div class="col-md-4 mb-4">
            <i class="bi bi-cash-coin fs-1 text-warning"></i>
            <h5 class="mt-3 fw-bold">Precios justos</h5>
            <p>Accesorios devocionales al alcance de todos.</p>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
// Sin lógica por ahora
</script>
