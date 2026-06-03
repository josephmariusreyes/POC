import type { RouteLocationNormalized } from 'vue-router'

import { canAccessRoute } from '@/app/guards/auth.guard'

export function authGuard(to: RouteLocationNormalized) {
	return canAccessRoute(to)
}
