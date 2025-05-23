<template>
  <div class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
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
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item">
              <router-link class="nav-link" to="/">Inicio</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/productos">Productos</router-link>
            </li>
            <li class="nav-item" v-if="logueado">
  <form method="POST" action="/logout">
    <input type="hidden" name="_token" :value="csrfToken">
    <button type="submit" class="btn btn-danger ms-3">
      Cerrar sesión
    </button>
  </form>
</li>

            <li class="nav-item">
              <!-- Icono carrito -->
              <button 
                class="btn btn-outline-light position-relative ms-3"
                data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasCarrito"
              >
                <i class="bi bi-cart3"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ carritoTotal }}
                </span>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex-fill container my-4">
      <router-view :agregarAlCarrito="agregarAlCarrito" />
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto bg-dark text-light py-4">
      <div class="container text-center">
        <div class="mb-3">
          <a href="https://www.instagram.com" target="_blank" class="text-light mx-3">
            <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
          </a>
          <a href="https://www.facebook.com" target="_blank" class="text-light mx-3">
            <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
          </a>
          <a href="https://wa.me/123456789" target="_blank" class="text-light mx-3">
            <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
          </a>
        </div>
        <small>&copy; 2025 La Pamela. Todos los derechos reservados.</small>
      </div>
    </footer>

    <!-- Carrito Offcanvas -->
    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="offcanvasCarrito"
      aria-labelledby="offcanvasCarritoLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCarritoLabel">Tu Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <div v-if="carrito.length === 0">
          <p>El carrito está vacío.</p>
        </div>
        <ul class="list-group" v-else>
          <li
            class="list-group-item d-flex justify-content-between align-items-center"
            v-for="item in carrito"
            :key="item.id"
          >
            <span>{{ item.nombre }} (x{{ item.cantidad }})</span>
            <span>{{ (item.precio * item.cantidad).toFixed(2) }} €</span>
          </li>
        </ul>
        <div v-if="carrito.length > 0" class="mt-3 text-end">
          <h5>Total: {{ carritoTotalPrecio.toFixed(2) }} €</h5>
          <router-link
            to="/checkout"
            class="btn btn-success mt-3 w-100"
            data-bs-dismiss="offcanvas"
          >
            Ir a pagar
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'


// Detectar si el usuario está autenticado
const logueado = ref(false);
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

// Comprobar estado de sesión al cargar
fetch('/api/user')
  .then(res => {
    logueado.value = res.ok;
  })
  .catch(() => {
    logueado.value = false;
  });

const carrito = ref([])

function agregarAlCarrito(producto) {
  const encontrado = carrito.value.find((p) => p.id === producto.id)
  if (encontrado) {
    encontrado.cantidad++
  } else {
    carrito.value.push({ ...producto, cantidad: 1 })
  }
}

const carritoTotal = computed(() =>
  carrito.value.reduce((total, item) => total + item.cantidad, 0)
)

const carritoTotalPrecio = computed(() =>
  carrito.value.reduce((total, item) => total + item.precio * item.cantidad, 0)
)
</script>

