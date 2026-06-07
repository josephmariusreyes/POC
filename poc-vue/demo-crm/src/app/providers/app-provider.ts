import type { App as VueApp } from 'vue'
import { createPinia } from 'pinia'

import router from '@/app/router'
import { useAuthStore } from '@/features/auth/stores/auth.store'

export function registerAppProviders(app: VueApp) {
	const pinia = createPinia()

	app.use(pinia)

	const authStore = useAuthStore(pinia)
	if (!authStore.isInitialized) {
		authStore.initialize()
	}

	app.use(router)
}
