import { createRouter, createWebHistory } from 'vue-router'

import { authRoutes } from '@/features/auth/routes/auth.routes'

const router = createRouter({
	history: createWebHistory(),
	routes: [
		{
			path: '/',
			redirect: '/auth/login',
		},
		authRoutes,
	],
})

export default router
