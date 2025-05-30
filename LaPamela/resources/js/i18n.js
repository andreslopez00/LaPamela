
import { createI18n } from 'vue-i18n'

const messages = {
  es: {
    nav: {
      inicio: 'Inicio',
      productos: 'Productos',
      misPedidos: 'Mis pedidos',
      contacto: 'Contacto',
      cerrarSesion: 'Cerrar sesión'
    },
    carrito: {
      titulo: 'Tu Carrito',
      vacio: 'El carrito está vacío.',
      total: 'Total',
      vaciar: 'Vaciar carrito',
      pagar: 'Ir a pagar'
    },
    footer: {
      derechos: 'Todos los derechos reservados.'
    }
  },
  en: {
    nav: {
      inicio: 'Home',
      productos: 'Products',
      misPedidos: 'My Orders',
      contacto: 'Contact',
      cerrarSesion: 'Log Out'
    },
    carrito: {
      titulo: 'Your Cart',
      vacio: 'The cart is empty.',
      total: 'Total',
      vaciar: 'Empty cart',
      pagar: 'Checkout'
    },
    footer: {
      derechos: 'All rights reserved.'
    }
  }
}

const idiomaGuardado = localStorage.getItem('idioma') || 'es'

export default createI18n({
  legacy: false,
  locale: idiomaGuardado,
  fallbackLocale: 'es',
  messages
})
