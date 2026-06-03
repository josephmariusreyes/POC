import { defineStore } from 'pinia'

import { authService } from '@/features/auth/services/auth.service'
import type { AuthSession, AuthUser } from '@/features/auth/types/auth.types'

interface AuthState {
	user: AuthUser | null
	accessToken: string | null
	refreshToken: string | null
	expiresAt: number | null
	isInitialized: boolean
}

function mapSessionToState(state: AuthState, session: AuthSession | null) {
	state.user = session?.user ?? null
	state.accessToken = session?.accessToken ?? null
	state.refreshToken = session?.refreshToken ?? null
	state.expiresAt = session?.expiresAt ?? null
}

export const useAuthStore = defineStore('auth', {
	state: (): AuthState => ({
		user: null,
		accessToken: null,
		refreshToken: null,
		expiresAt: null,
		isInitialized: false,
	}),
	getters: {
		isAuthenticated: (state): boolean => {
			if (!state.accessToken || !state.expiresAt) {
				return false
			}

			return state.expiresAt > Date.now()
		},
	},
	actions: {
		initialize() {
			const session = authService.getSession()
			mapSessionToState(this, session)
			this.isInitialized = true
		},
		async login(username: string, password: string) {
			const session = await authService.login(username, password)
			mapSessionToState(this, session)
			this.isInitialized = true
			return session.user
		},
		logout() {
			authService.logout()
			mapSessionToState(this, null)
			this.isInitialized = true
		},
	},
})
