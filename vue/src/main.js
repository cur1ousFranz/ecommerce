import { createApp } from 'vue'
import './index.css'
import App from './App.vue'
import router from './router'
import store from './store'
import VueLazyload from 'vue-lazyload'

import Swal from 'sweetalert2'
window.Swal = Swal

createApp(App)
    .use(store)
    .use(router)
    .use(VueLazyload)
    .mount('#app')
