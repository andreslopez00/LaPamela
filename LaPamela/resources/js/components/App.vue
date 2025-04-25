<template>
  <div>
    <!-- Navbar de Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <router-link class="navbar-brand" to="/">La Pamela</router-link>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <router-link class="nav-link" to="/">Inicio</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/productos">Productos</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/carrito">Carrito</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/checkout">Checkout</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Vista dinámica del router -->
    <div class="container mt-4">
      <router-view />
    </div>
  </div>
</template>

<script setup>
</script>
