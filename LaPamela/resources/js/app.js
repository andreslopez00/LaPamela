
import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router'
import i18n from './i18n' // 👈 importar i18n
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import './script.js';
import '../css/styles.css';
import 'bootstrap-icons/font/bootstrap-icons.css';

createApp(App)
  .use(router)
  .use(i18n) // 👈 usar i18n
  .mount('#app')
