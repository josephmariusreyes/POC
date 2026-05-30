import type {
	AxiosInstance,
	AxiosResponse,
	InternalAxiosRequestConfig,
} from 'axios'

const SIMULATED_BEARER_TOKEN = 'Bearer sim-token-7f3a1c92-demo'

function assignAuthorizationHeader(config: InternalAxiosRequestConfig) {
	config.headers.set('Authorization', SIMULATED_BEARER_TOKEN)

	return config
}

export function registerGlobalHttpInterceptors(http: AxiosInstance) {
	http.interceptors.request.use((config) => assignAuthorizationHeader(config))

	http.interceptors.response.use(
		(response: AxiosResponse) => {
			console.log('HTTP response:', response)
			return response
		},
		(error) => Promise.reject(error),
	)

	return http
}
