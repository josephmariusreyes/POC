import type {
	AxiosInstance,
	AxiosResponse,
	InternalAxiosRequestConfig,
} from 'axios'

import { authService } from '@/features/auth/services/auth.service'


function buildAuthorizationHeader(accessToken: string) {
	return `Bearer ${accessToken}`
}

function assignAuthorizationHeader(config: InternalAxiosRequestConfig) {
	const accessToken = authService.getAccessToken()

	if (accessToken) {
		config.headers.set('Authorization', buildAuthorizationHeader(accessToken))
	}

	return config
}

export function registerGlobalHttpInterceptors(http: AxiosInstance) {
	http.interceptors.request.use((config) => assignAuthorizationHeader(config))

	http.interceptors.response.use(
		(response: AxiosResponse) => {
			return response
		},
		(error) => Promise.reject(error),
	)

	return http
}
