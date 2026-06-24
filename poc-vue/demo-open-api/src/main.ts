import { createApp } from 'vue'
import './style.css'
import App from './App.vue'

import { OpenAPI } from '@/api';

OpenAPI.BASE = import.meta.env.VITE_API_URL;
OpenAPI.TOKEN = async () => {
    return localStorage.getItem('token') ?? '';
};
createApp(App).mount('#app')
