import type { RouteRecordRaw } from 'vue-router'

import CustomerLayout from '@/components/layouts/CustomerLayout.vue'
import CustomerCreatePage from '@/features/customers/pages/CustomerCreatePage.vue'
import CustomerDetailsPage from '@/features/customers/pages/CustomerDetailsPage.vue'
import CustomerListPage from '@/features/customers/pages/CustomerListPage.vue'

export const customerRoutes: RouteRecordRaw = {
	path: '/customers',
	component: CustomerLayout,
	children: [
		{
			path: '',
			redirect: { name: 'customer-listing' },
		},
		{
			path: 'create',
			name: 'customer-create',
			component: CustomerCreatePage,
		},
		{
			path: 'listing',
			name: 'customer-listing',
			component: CustomerListPage,
		},
		{
			path: 'details',
			name: 'customer-details',
			component: CustomerDetailsPage,
		},
	],
}
