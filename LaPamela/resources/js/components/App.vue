<template>
  <div class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <router-link class="navbar-brand" to="/">La Pamela</router-link>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item">
              <router-link class="nav-link" to="/">{{ $t('nav.inicio') }}</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/productos">{{ $t('nav.productos') }}</router-link>
            </li>
            <li class="nav-item" v-if="logueado">
              <router-link class="nav-link" to="/mis-pedidos">{{ $t('nav.misPedidos') }}</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/contacto">{{ $t('nav.contacto') }}</router-link>
            </li>

            <!-- Carrito -->
            <li class="nav-item">
              <button class="btn btn-outline-light position-relative ms-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCarrito">
                <i class="bi bi-cart3"></i>
                <span v-if="carritoTotal > 0" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ carritoTotal }}
                </span>
              </button>
            </li>

            

            <!-- Modo oscuro -->
            <li class="nav-item ms-3">
              <button @click="toggleDarkMode" class="btn btn-sm btn-outline-light">
                <i class="bi" :class="isDarkMode ? 'bi-moon-fill' : 'bi-sun-fill'"></i>
              </button>
            </li>

            <!-- Idioma -->
            <li class="nav-item ms-3">
              <select v-model="locale" @change="cambiarIdioma" class="form-select form-select-sm bg-dark text-light border-secondary">
                <option value="es">ES</option>
                <option value="en">EN</option>
              </select>
            </li>
            <!-- Logout -->
            <li class="nav-item" v-if="logueado">
              <form method="POST" action="/logout" class="d-inline">
                <input type="hidden" name="_token" :value="csrfToken" />
                <button type="submit" class="btn btn-danger ms-3">{{ $t('nav.cerrarSesion') }}</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Contenido -->
    <main class="flex-fill p-0 m-0 w-100">
      <router-view :agregarAlCarrito="agregarAlCarrito" :user="user" />
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto bg-dark text-light py-4">
      <div class="container text-center">
        <div class="mb-3">
          <a href="https://www.instagram.com" target="_blank" class="text-light mx-3"><i class="bi bi-instagram"></i></a>
          <a href="https://www.facebook.com" target="_blank" class="text-light mx-3"><i class="bi bi-facebook"></i></a>
          <a href="https://wa.me/34666666666" target="_blank" class="text-light mx-3"><i class="bi bi-whatsapp"></i></a>
        </div>
        <small>&copy; 2025 La Pamela. {{ $t('footer.derechos') }}</small>
      </div>
    </footer>

    <!-- Carrito Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCarrito">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">{{ $t('carrito.titulo') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <div v-if="carrito.length === 0">
          <p>{{ $t('carrito.vacio') }}</p>
        </div>
        <div v-else>
          <ul class="list-group">
            <li v-for="item in carrito" :key="item.id" class="list-group-item d-flex justify-content-between">
              <div>
                {{ item.nombre }} <br />
                <small>x{{ item.cantidad }} - {{ (item.precio * item.cantidad).toFixed(2) }} €</small>
              </div>
              <button @click="eliminarProducto(item.id)" class="btn btn-sm btn-outline-danger">🗑</button>
            </li>
          </ul>
          <div class="text-end mt-3">
            <h5>{{ $t('carrito.total') }}: {{ carritoTotalPrecio.toFixed(2) }} €</h5>
            <button @click="vaciarCarrito" class="btn btn-outline-secondary w-100 mt-2">{{ $t('carrito.vaciar') }}</button>
            <button @click="irACheckout" data-bs-dismiss="offcanvas" class="btn btn-success mt-3 w-100">{{ $t('carrito.pagar') }}</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Botón WhatsApp -->
    <a href="https://wa.me/34666666666?text=Hola%2C%20quiero%20hacer%20una%20consulta%20sobre%20un%20producto"
       target="_blank"
       class="btn btn-success position-fixed"
       style="bottom: 20px; right: 20px; border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; z-index: 1050;">
      <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
    </a>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'

const { locale } = useI18n()
const router = useRouter()

const logueado = ref(false)
const user = ref(null)
const carrito = ref([])
const isDarkMode = ref(false)
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')

onMounted(() => {
  // Cargar carrito
  const savedCarrito = localStorage.getItem('carrito')
  if (savedCarrito) carrito.value = JSON.parse(savedCarrito)

  // Modo oscuro
  const savedMode = localStorage.getItem('darkMode')
  isDarkMode.value = savedMode === 'true'
  updateBodyClass()

  // Cargar idioma
  const savedLang = localStorage.getItem('idioma')
  if (savedLang) locale.value = savedLang

  // Obtener usuario
  fetch('/user-info')
    .then(res => res.ok ? res.json() : null)
    .then(data => {
      if (data) {
        user.value = data
        logueado.value = true
      } else {
        logueado.value = false
      }
    }).catch(() => logueado.value = false)
})

watch(carrito, () => {
  localStorage.setItem('carrito', JSON.stringify(carrito.value))
}, { deep: true })

function agregarAlCarrito(producto) {
  const encontrado = carrito.value.find(p => p.id === producto.id)
  if (encontrado) {
    encontrado.cantidad++
  } else {
    carrito.value.push({ ...producto, cantidad: 1 })
  }
}

function eliminarProducto(id) {
  carrito.value = carrito.value.filter(p => p.id !== id)
}

function vaciarCarrito() {
  carrito.value = []
}

function irACheckout() {
  router.push('/checkout')
}

function toggleDarkMode() {
  isDarkMode.value = !isDarkMode.value
  localStorage.setItem('darkMode', isDarkMode.value)
  updateBodyClass()
}

function updateBodyClass() {
  document.body.classList.toggle('dark-mode', isDarkMode.value)
}

function cambiarIdioma() {
  localStorage.setItem('idioma', locale.value)
}

const carritoTotal = computed(() =>
  carrito.value.reduce((total, item) => total + item.cantidad, 0)
)

const carritoTotalPrecio = computed(() =>
  carrito.value.reduce((total, item) => total + item.precio * item.cantidad, 0)
)
</script>
