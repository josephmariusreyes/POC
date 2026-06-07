import { globalHttp } from '@/app/services/http/global_http'
import type { AuthSession, AuthUser, MockUser, UserRole } from '@/features/auth/types/auth.types'

const USERS_ENDPOINT = '/mock-api/users.json'
const AUTH_SESSION_STORAGE_KEY = 'demo-crm.auth.session'
const SESSION_DURATION_MS = 1000 * 60 * 30

function toAuthUser(user: MockUser): AuthUser {
	return {
		id: user.id,
		name: user.name,
		email: user.email,
		username: user.username,
		role: user.role,
	}
}

function isObject(value: unknown): value is Record<string, unknown> {
	return typeof value === 'object' && value !== null
}

function isUserRole(value: unknown): value is UserRole {
	return (
		value === 'admin' ||
		value === 'manager' ||
		value === 'staff' ||
		value === 'viewer'
	)
}

function createMockSession(user: AuthUser): AuthSession {
	const tokenSource = `${user.id}:${user.username}:${Date.now()}`
	const encodedSource = btoa(tokenSource)

	return {
		user,
		accessToken: `mock-access-${encodedSource}`,
		refreshToken: `mock-refresh-${encodedSource}`,
		expiresAt: Date.now() + SESSION_DURATION_MS,
	}
}

function persistSession(session: AuthSession) {
	localStorage.setItem(AUTH_SESSION_STORAGE_KEY, JSON.stringify(session))
}

function removeSession() {
	localStorage.removeItem(AUTH_SESSION_STORAGE_KEY)
}

function isSessionExpired(session: AuthSession) {
	return session.expiresAt <= Date.now()
}

function parseSession(rawSession: string): AuthSession | null {
	try {
		const parsed = JSON.parse(rawSession) as unknown

		if (!isObject(parsed)) {
			return null
		}

		const user = parsed.user

		if (
			!isObject(user) ||
			typeof user.id !== 'number' ||
			typeof user.name !== 'string' ||
			typeof user.email !== 'string' ||
			typeof user.username !== 'string' ||
			!isUserRole(user.role) ||
			typeof parsed.accessToken !== 'string' ||
			typeof parsed.refreshToken !== 'string' ||
			typeof parsed.expiresAt !== 'number'
		) {
			return null
		}

		return {
			user: {
				id: user.id,
				name: user.name,
				email: user.email,
				username: user.username,
				role: user.role,
			},
			accessToken: parsed.accessToken,
			refreshToken: parsed.refreshToken,
			expiresAt: parsed.expiresAt,
		}
	} catch {
		return null
	}
}

export const authService = {
	
	async login(username: string, password: string) {
		const response = await globalHttp.get<MockUser[]>(USERS_ENDPOINT, {
			params: username ? { username } : undefined,
		})

		const normalizedUsername = username.trim().toLowerCase()
		const matchedUser = response.data.find(
			(user) => user.username.toLowerCase() === normalizedUsername,
		)

		if (!matchedUser || matchedUser.password !== password) {
			throw new Error('Invalid username or password.')
		}

		if (!matchedUser.isActive) {
			throw new Error('User account is inactive.')
		}

		const loggedInUser = toAuthUser(matchedUser)
		const session = createMockSession(loggedInUser)
		persistSession(session)

		return session
	},
	getSession() {
		const storedSession = localStorage.getItem(AUTH_SESSION_STORAGE_KEY)

		if (!storedSession) {
			return null
		}

		const session = parseSession(storedSession)

		if (!session || isSessionExpired(session)) {
			removeSession()
			return null
		}

		return session
	},
	getLoggedInUser() {
		return authService.getSession()?.user ?? null
	},
	getAccessToken() {
		return authService.getSession()?.accessToken ?? null
	},
	getRefreshToken() {
		return authService.getSession()?.refreshToken ?? null
	},
	isLoggedIn() {
		return authService.getSession() !== null
	},
	logout() {
		removeSession()
	},
}
