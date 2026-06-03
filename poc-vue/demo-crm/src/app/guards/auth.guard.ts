import type { RouteLocationNormalized } from 'vue-router'
import { useAuthStore } from '@/features/auth/stores/auth.store'

import type { UserRole } from '@/features/auth/types/auth.types'

export function canAccessRoute(to: RouteLocationNormalized) {
	const authStore = useAuthStore()

	if (!authStore.isInitialized) {
		authStore.initialize()
	}

	const requiresAuth = to.matched.some((routeRecord) => routeRecord.meta.requiresAuth)
	const isGuestOnly = to.matched.some((routeRecord) => routeRecord.meta.guestOnly)
	const requiredRoles = to.matched.flatMap((routeRecord) => {
		const roles = routeRecord.meta.requiredRoles

		return Array.isArray(roles) ? (roles as UserRole[]) : []
	})

	if (requiresAuth && !authStore.isAuthenticated) {
		return {
			name: 'auth-login',
			query: {
				redirect: to.fullPath,
			},
		}
	}

	if (isGuestOnly && authStore.isAuthenticated) {
		return {
			name: 'customer-listing',
		}
	}

	if (requiredRoles.length > 0 && authStore.user && !requiredRoles.includes(authStore.user.role)) {
		return {
			name: 'customer-listing',
		}
	}

	return true
}
