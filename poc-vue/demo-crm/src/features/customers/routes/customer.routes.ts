import type { RouteRecordRaw } from 'vue-router'

import CustomerDetailsPage from '@/features/customers/pages/CustomerDetailsPage.vue'
import CustomerListPage from '@/features/customers/pages/CustomerListPage.vue'

export const customerRoutes: RouteRecordRaw[] = [
	{
		path: '/customers/listing',
		name: 'customer-listing',
		component: CustomerListPage,
	},
	{
		path: '/customers/details',
		name: 'customer-details',
		component: CustomerDetailsPage,
	},
]
