import { createApp } from 'vue'
import './style.css'
import './styles/global.scss'
import App from './App.vue'
import { registerAppProviders } from '@/app/providers/app-provider'

const app = createApp(App)

registerAppProviders(app)

app.mount('#app')
