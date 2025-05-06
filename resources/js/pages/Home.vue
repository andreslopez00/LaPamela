<template>
    <div class="landing">
      <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content text-center">
          <h1 class="display-3 fade-in">Bienvenido a <strong>La Pamela</strong></h1>
          <p class="lead fade-in delay-1">
            Especialistas en productos de Semana Santa: velas, inciensos, mantillas y más.
          </p>
          <router-link to="/productos" class="btn btn-light btn-lg mt-4 fade-in delay-2">
            Ver Productos
          </router-link>
        </div>
      </section>

      <!-- Más contenido debajo -->
      <section class="contenido-extra text-center py-5">
        <h2>Productos Destacados</h2>
        <p>Velas artesanas, mantillas bordadas, inciensos naturales y más.</p>
      </section>
    </div>
  </template>

  <script setup>
  </script>

  <style scoped>
  /* 🔥 Reseteamos todo posible margen/padding heredado */
  .landing {
    margin: 0;
    padding: 0;
  }

  /* 🔥 HERO secciona toda la ventana, sin nav/footer */
  .hero-section {
    position: relative;
    width: 100%;
    height: 100vh; /* Pantalla completa */
    background: url('../../../public/images/bg.jpg') center center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
    z-index: 1;
  }

  .hero-content {
    position: relative;
    z-index: 2;
    padding: 2rem;
    color: #fff;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
  }

  .fade-in {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.8s ease forwards;
  }

  .delay-1 {
    animation-delay: 0.4s;
  }
  .delay-2 {
    animation-delay: 0.8s;
  }

  @keyframes fadeInUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* 🔻 Sección adicional debajo */
  .contenido-extra {
    background-color: #f9f9f9;
    color: #333;
  }
  </style>
