export type UserRole = 'admin' | 'manager' | 'staff' | 'viewer'

export interface MockUser {
	id: number
	name: string
	email: string
	username: string
	password: string
	role: UserRole
	isActive: boolean
}

export interface AuthUser {
	id: number
	name: string
	email: string
	username: string
	role: UserRole
}

export interface AuthSession {
	user: AuthUser
	accessToken: string
	refreshToken: string
	expiresAt: number
}
