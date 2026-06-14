import type { RouteLocationNormalized } from 'vue-router'
import { useAuthStore } from '@/features/auth/stores/auth.store'

import type { UserRole } from '@/features/auth/types/auth.types'

export function canAccessRoute(to: RouteLocationNormalized) {
	const authStore = useAuthStore()

	// Load persisted auth state the first time a route guard runs.
	if (!authStore.isInitialized) {
		authStore.initialize()
	}

	// Read auth-related route metadata from the target route and its parent records.
	const requiresAuth = to.matched.some((routeRecord) => routeRecord.meta.requiresAuth)
	const isGuestOnly = to.matched.some((routeRecord) => routeRecord.meta.guestOnly)
	const requiredRoles = to.matched.flatMap((routeRecord) => {
		const roles = routeRecord.meta.requiredRoles

		return Array.isArray(roles) ? (roles as UserRole[]) : []
	})

	// Protected routes send unauthenticated users to login and preserve the intended URL.
	if (requiresAuth && !authStore.isAuthenticated) {
		return {
			name: 'auth-login',
			query: {
				redirect: to.fullPath,
			},
		}
	}

	// Guest-only pages, such as login/register, should not be shown after signing in.
	if (isGuestOnly && authStore.isAuthenticated) {
		return {
			name: 'customer-listing',
		}
	}

	// If a route declares allowed roles, authenticated users outside those roles are redirected.
	if (requiredRoles.length > 0 && authStore.user && !requiredRoles.includes(authStore.user.role)) {
		return {
			name: 'customer-listing',
		}
	}

	// Returning true tells Vue Router to continue to the requested route.
	return true
}
