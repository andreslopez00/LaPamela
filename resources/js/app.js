import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import './script.js';
import '../css/styles.css';
import 'bootstrap-icons/font/bootstrap-icons.css';

createApp(App)
  .use(router)
  .mount('#app')
