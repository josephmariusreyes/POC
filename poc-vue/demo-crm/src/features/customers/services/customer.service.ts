import { globalHttp } from '@/app/services/http/global_http'
import type { Customer } from '@/features/customers/types/customer.types'

const CUSTOMERS_ENDPOINT = '/mock-api/customers.json'

export const customerService = {
	async getAll(query = '') {
		const response = await globalHttp.get<Customer[]>(CUSTOMERS_ENDPOINT, {
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
	async getById(customerId: string) {
		const response = await globalHttp.get<Customer[]>(CUSTOMERS_ENDPOINT, {
			params: customerId ? { id: customerId } : undefined,
		})

		return (
			response.data.find(
				(customer) => customer.personalInfo.customerId === customerId,
			) ?? null
		)
	},
}
