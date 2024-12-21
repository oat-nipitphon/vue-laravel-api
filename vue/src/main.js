// // import Bootstrap 5
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle'

import './assets/main.css'

import { createApp, markRaw  } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import Index from './Index.vue'
import router from './router'

const app = createApp(App)
const pinia = createPinia()

pinia.use(({store}) => {
    store.router = markRaw(router)
})
app.use(pinia)
app.use(router)

app.mount('#app')
