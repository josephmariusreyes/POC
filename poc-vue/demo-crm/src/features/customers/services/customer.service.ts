import { globalHttp } from '@/app/services/http/global_http'

export interface Customer {
	personalInfo: {
		customerId: string
		firstName: string
		lastName: string
		middleName: string
		birthDate: string
		gender: string
		civilStatus: string
		nationality: string
	}
	contactInfo: {
		email: string
		phone: string
		alternatePhone: string
	}
	address: {
		street: string
		barangay: string
		city: string
		province: string
		postalCode: string
		country: string
	}
	employment: {
		employmentStatus: string
		company: string
		jobTitle: string
		monthlyIncome: number
		yearsEmployed: number
	}
}

class CustomerService {
	async GetAllCustomers() {
		const response = await globalHttp.get<Customer[]>('/mock-api/customers.json')

		return response.data
	}
}

export const customerService = new CustomerService()
