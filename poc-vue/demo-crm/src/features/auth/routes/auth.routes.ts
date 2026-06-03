import type { RouteRecordRaw } from 'vue-router'

import AuthLayout from '@/components/layouts/AuthLayout.vue'
import LoginPage from '@/features/auth/pages/LoginPage.vue'
import RegisterPage from '@/features/auth/pages/RegisterPage.vue'

export const authRoutes: RouteRecordRaw = {
	path: '/auth',
	component: AuthLayout,
	meta: {
		guestOnly: true,
	},
	children: [
		{
			path: '',
			redirect: { name: 'auth-login' },
		},
		{
			path: 'login',
			name: 'auth-login',
			component: LoginPage,
		},
		{
			path: 'register',
			name: 'auth-register',
			component: RegisterPage,
		},
	],
}
