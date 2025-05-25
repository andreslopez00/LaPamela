import { createRouter, createWebHistory } from 'vue-router'

import Home from '../pages/Home.vue'
import Productos from '../pages/Productos.vue'
import Carrito from '../pages/Carrito.vue'
import Checkout from '../pages/Checkout.vue'
import Success from '../pages/Success.vue'

const routes = [
  { path: '/', name: 'home', component: Home },
  { path: '/productos', name: 'productos', component: Productos },
  { path: '/carrito', name: 'carrito', component: Carrito },
  { path: '/checkout', name: 'checkout', component: Checkout },
  { path: '/success', name: 'success', component: Success },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
