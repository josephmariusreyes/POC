import { ref } from 'vue'
import { defineStore } from 'pinia'

import type { Customer } from '@/features/customers/types/customer.types'

export const useCustomerStore = defineStore('customer', () => {
	const customer = ref<Customer | null>(null)

	function setCustomer(nextCustomer: Customer | null) {
		customer.value = nextCustomer
			? (JSON.parse(JSON.stringify(nextCustomer)) as Customer)
			: null
	}

	return {
		customer,
		setCustomer,
	}
})
