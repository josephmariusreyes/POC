import { createRouter, createWebHistory } from 'vue-router'

import { canAccessRoute } from '@/app/guards/auth.guard'
import { authRoutes } from '@/features/auth/routes/auth.routes'
import { customerRoutes } from '@/features/customers/routes/customer.routes'

const router = createRouter({
	history: createWebHistory(),
	routes: [
		{
			path: '/',
			redirect: '/auth/login',
		},
		authRoutes,
		customerRoutes,
	],
})

router.beforeEach((to) => canAccessRoute(to))

export default router
