<template>
  <div class="home-landing fade-in">

   <section id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="hero d-flex align-items-center justify-content-center text-center text-light" style="background-image: url('https://img.freepik.com/foto-gratis/multitud-disfrazada-semana-santa-capturada-sevilla_181624-15679.jpg');">
        <div class="overlay"></div>
        <div class="content z-2">
          <h1 class="display-4 fw-bold">Bienvenido a La Pamela</h1>
          <p class="lead mb-4">Tradición, elegancia y devoción en cada producto de Semana Santa.</p>
          <router-link to="/productos" class="btn btn-lg btn-warning text-dark fw-bold px-5 py-3">Ver Productos</router-link>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <div class="hero d-flex align-items-center justify-content-center text-center text-light" style="background-image: url('https://fotografias.larazon.es/clipping/cmsimages01/2021/03/31/01478BBA-79AE-4416-87CF-76C331DD7085/98.jpg?crop=6016,3385,x0,y316&width=1900&height=1069&optimize=low&format=webply');">
        <div class="overlay"></div>
        <div class="content z-2">
          <h1 class="display-4 fw-bold">Artesanía Cofrade</h1>
          <p class="lead mb-4">Calidad garantizada para tus pasos procesionales</p>
          <router-link to="/productos" class="btn btn-lg btn-warning text-dark fw-bold px-5 py-3">Explorar</router-link>
        </div>
      </div>
    </div>

  </div>

  <!-- Controles -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
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
