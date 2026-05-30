import axios from 'axios'

import { registerGlobalHttpInterceptors } from './global_http_interceptor'

const globalHttp = registerGlobalHttpInterceptors(
	axios.create({
		baseURL: '/',
	}),
)

export { globalHttp }
