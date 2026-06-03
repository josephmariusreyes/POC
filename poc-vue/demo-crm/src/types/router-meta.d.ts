import type { UserRole } from '@/features/auth/types/auth.types'

import 'vue-router'

declare module 'vue-router' {
	interface RouteMeta {
		requiresAuth?: boolean
		guestOnly?: boolean
		requiredRoles?: UserRole[]
	}
}