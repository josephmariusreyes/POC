import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import { useAuthStore } from './stores/auth'

// Import global styles
import './style.css'

// Create Vue app
const app = createApp(App)

// Create Pinia store
const pinia = createPinia()
app.use(pinia)

// Initialize auth store before mounting
const authStore = useAuthStore()
authStore.initialize()

// Use plugins
app.use(router)
app.use(vuetify)

// Mount app
app.mount('#app')
