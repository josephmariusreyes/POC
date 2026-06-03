<script setup lang="ts">
import { ref, watch } from 'vue'

import { customerService } from '@/features/customers/services/customer.service'
import type { Customer } from '@/features/customers/types/customer.types'

import {
	Table,
	TableBody,
	TableCell,
	TableEmpty,
	TableHead,
	TableHeader,
	TableRow,
} from '@/components/ui/table'

interface Props {
	query: string
}

const props = defineProps<Props>()

const customers = ref<Customer[]>([])
const isLoading = ref(false)
const errorMessage = ref('')

async function loadCustomers(query: string) {
	isLoading.value = true
	errorMessage.value = ''

	try {
		customers.value = await customerService.getAll(query)
	} catch {
		errorMessage.value = 'Failed to load customers.'
	} finally {
		isLoading.value = false
	}
}

watch(
	() => props.query,
	(query) => {
		void loadCustomers(query)
	},
	{ immediate: true },
)
</script>

<template>
	<Table>
		<TableHeader>
			<TableRow>
				<TableHead>Customer ID</TableHead>
				<TableHead>Name</TableHead>
				<TableHead>Email</TableHead>
				<TableHead>Phone</TableHead>
				<TableHead>City</TableHead>
				<TableHead>Employment</TableHead>
			</TableRow>
		</TableHeader>
		<TableBody>
			<TableEmpty v-if="isLoading" :colspan="6">Loading customers...</TableEmpty>
			<TableEmpty v-else-if="errorMessage" :colspan="6">{{ errorMessage }}</TableEmpty>
			<TableEmpty v-else-if="customers.length === 0" :colspan="6">No customers found.</TableEmpty>
			<TableRow v-else v-for="customer in customers" :key="customer.personalInfo.customerId">
				<TableCell>{{ customer.personalInfo.customerId }}</TableCell>
				<TableCell>
					{{ customer.personalInfo.lastName }}, {{ customer.personalInfo.firstName }}
				</TableCell>
				<TableCell>{{ customer.contactInfo.email }}</TableCell>
				<TableCell>{{ customer.contactInfo.phone }}</TableCell>
				<TableCell>{{ customer.address.city }}</TableCell>
				<TableCell>{{ customer.employment.jobTitle }}</TableCell>
			</TableRow>
		</TableBody>
	</Table>
</template>
