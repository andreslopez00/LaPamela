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
    <router-link class="nav-link" to="/">Inicio</router-link>
  </li>
  <li class="nav-item">
    <router-link class="nav-link" to="/productos">Productos</router-link>
  </li>

  <li class="nav-item" v-if="logueado">
    <router-link class="nav-link" to="/mis-pedidos">Mis pedidos</router-link>
  </li>

<li class="nav-item">
  <router-link class="nav-link" to="/contacto">Contacto</router-link>
</li>

  <!-- Logout -->
  <li class="nav-item" v-if="logueado">
    <form method="POST" action="/logout">
      <input type="hidden" name="_token" :value="csrfToken">
      <button type="submit" class="btn btn-danger ms-3">Cerrar sesión</button>
    </form>
  </li>

  <!-- Carrito -->
  <li class="nav-item">
    <button class="btn btn-outline-light position-relative ms-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCarrito">
      <i class="bi bi-cart3"></i>
      <span v-if="carritoTotal" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        {{ carritoTotal }}
      </span>
    </button>
  </li>
</ul>

        </div>
      </div>
    </nav>

    <!-- Contenido principal -->
<main class="flex-fill p-0 m-0 w-100">
  <router-view :agregarAlCarrito="agregarAlCarrito" :user="user" />
</main>


    <!-- Footer -->
    <footer class="footer mt-auto bg-dark text-light py-4">
      <div class="container text-center">
        <div class="mb-3">
          <a href="https://www.instagram.com" target="_blank" class="text-light mx-3"><i class="bi bi-instagram" style="font-size: 1.5rem;"></i></a>
          <a href="https://www.facebook.com" target="_blank" class="text-light mx-3"><i class="bi bi-facebook" style="font-size: 1.5rem;"></i></a>
          <a href="https://wa.me/123456789" target="_blank" class="text-light mx-3"><i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i></a>
        </div>
        <small>&copy; 2025 La Pamela. Todos los derechos reservados.</small>
      </div>
    </footer>

    <!-- Carrito Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCarrito" aria-labelledby="offcanvasCarritoLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCarritoLabel">Tu Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <div v-if="carrito.length === 0">
          <p>El carrito está vacío.</p>
        </div>
        <div v-else>
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center" v-for="item in carrito" :key="item.id">
              <div>
                {{ item.nombre }} <br />
                <small>x{{ item.cantidad }} - {{ (item.precio * item.cantidad).toFixed(2) }} €</small>
              </div>
              <button class="btn btn-sm btn-outline-danger" @click="eliminarProducto(item.id)">🗑</button>
            </li>
          </ul>
          <div class="mt-3 text-end">
            <h5>Total: {{ carritoTotalPrecio.toFixed(2) }} €</h5>
            <button class="btn btn-outline-secondary w-100 mt-2" @click="vaciarCarrito">Vaciar carrito</button>
            <button class="btn btn-success mt-3 w-100" data-bs-dismiss="offcanvas" @click="irACheckout">
  Ir a pagar
</button>

          </div>
        </div>
      </div>
    </div>
    <!-- Botón de WhatsApp flotante -->
<a
  href="https://wa.me/34666666666?text=Hola%2C%20quiero%20hacer%20una%20consulta%20sobre%20un%20producto"
  target="_blank"
  class="btn btn-success position-fixed"
  style="bottom: 20px; right: 20px; border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; z-index: 1050;"
>
  <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
</a>

  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { useRouter } from 'vue-router';

const logueado = ref(false);
const user = ref(null); // ← Aquí guardaremos el usuario completo
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
const router = useRouter();

function irACheckout() {
  router.push('/checkout');
}

// Obtener usuario autenticado
fetch('/user-info')
  .then(res => res.ok ? res.json() : null)
  .then(data => {
    if (data) {
      user.value = data;
      logueado.value = true;
    } else {
      logueado.value = false;
    }
  })
  .catch(() => {
    logueado.value = false;
  });

// Carrito
const carrito = ref([]);

// Cargar carrito desde localStorage
onMounted(() => {
  const data = localStorage.getItem('carrito');
  if (data) {
    carrito.value = JSON.parse(data);
  }
});

// Guardar carrito cada vez que cambia
watch(carrito, () => {
  localStorage.setItem('carrito', JSON.stringify(carrito.value));
}, { deep: true });

// Funciones carrito
function agregarAlCarrito(producto) {
  const encontrado = carrito.value.find(p => p.id === producto.id);
  if (encontrado) {
    encontrado.cantidad++;
  } else {
    carrito.value.push({ ...producto, cantidad: 1 });
  }
}

function eliminarProducto(id) {
  carrito.value = carrito.value.filter(p => p.id !== id);
}

function vaciarCarrito() {
  carrito.value = [];
}

const carritoTotal = computed(() =>
  carrito.value.reduce((total, item) => total + item.cantidad, 0)
);

const carritoTotalPrecio = computed(() =>
  carrito.value.reduce((total, item) => total + item.precio * item.cantidad, 0)
);
</script>
