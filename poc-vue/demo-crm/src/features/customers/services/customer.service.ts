import { globalHttp } from '@/app/services/http/global_http'
import type { Customer } from '@/features/customers/types/customer.types'

export const customerService = {
	async getAll(query = '') {
		const response = await globalHttp.get<Customer[]>('/mock-api/customers.json', {
			params: query ? { query } : undefined,
		})

		const normalizedQuery = query.trim().toLowerCase()

		if (!normalizedQuery) {
			return response.data
		}

		return response.data.filter((customer) =>
			Object.values(customer.personalInfo).some((value) =>
				String(value).toLowerCase().includes(normalizedQuery),
			),
		)
	},
}
