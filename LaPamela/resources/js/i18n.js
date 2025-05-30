import { createI18n } from 'vue-i18n'

const messages = {
  es: {
    nav: {
      inicio: 'Inicio',
      productos: 'Productos',
      misPedidos: 'Mis pedidos',
      contacto: 'Contacto',
      cerrarSesion: 'Cerrar sesión',
    },
    carrito: {
      titulo: 'Tu Carrito',
      vacio: 'El carrito está vacío.',
      total: 'Total',
      vaciar: 'Vaciar carrito',
      pagar: 'Ir a pagar',
    },
    footer: {
      derechos: 'Todos los derechos reservados.',
    }
  },
  en: {
    nav: {
      inicio: 'Home',
      productos: 'Products',
      misPedidos: 'My Orders',
      contacto: 'Contact',
      cerrarSesion: 'Log out',
    },
    carrito: {
      titulo: 'Your Cart',
      vacio: 'Your cart is empty.',
      total: 'Total',
      vaciar: 'Clear cart',
      pagar: 'Checkout',
    },
    footer: {
      derechos: 'All rights reserved.',
    }
  }
}

const idiomaPorDefecto = localStorage.getItem('idioma') || 'es'

const i18n = createI18n({
  legacy: false,
  locale: idiomaPorDefecto,
  fallbackLocale: 'es',
  messages,
})

export default i18n
