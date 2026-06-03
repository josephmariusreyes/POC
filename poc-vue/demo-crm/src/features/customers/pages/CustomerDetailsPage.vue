<script setup lang="ts">
import { ArrowLeft } from '@lucide/vue'
import { computed, ref, watch } from 'vue'
import { storeToRefs } from 'pinia'
import { RouterLink, useRoute } from 'vue-router'

import CustomerListSideBar from '@/features/customers/components/CustomerListSideBar.vue'
import { customerService } from '@/features/customers/services/customer.service'
import { useCustomerStore } from '@/features/customers/stores/customer.store'

import { Button } from '@/components/ui/button'
import {
	Card,
	CardContent,
	CardDescription,
	CardHeader,
	CardTitle,
} from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Separator } from '@/components/ui/separator'
import {
	SidebarInset,
	SidebarProvider,
	SidebarTrigger,
} from '@/components/ui/sidebar'

const route = useRoute()
const customerStore = useCustomerStore()
const { customer } = storeToRefs(customerStore)
const isLoading = ref(false)
const isSaving = ref(false)
const errorMessage = ref('')

const customerId = computed(() => {
	const id = route.query.id

	return Array.isArray(id) ? id[0] ?? '' : (id ?? '')
})

async function loadCustomer(id: string) {
	if (!id) {
		customerStore.setCustomer(null)
		isLoading.value = false
		errorMessage.value = 'Missing customer ID.'
		return
	}

	isLoading.value = true
	errorMessage.value = ''

	try {
		const result = await customerService.getById(id)
		customerStore.setCustomer(result)
	} catch {
		customerStore.setCustomer(null)
		errorMessage.value = 'Failed to load customer details.'
	} finally {
		isLoading.value = false
	}
}

async function saveCustomerChanges() {
	if (!customer.value) {
		return
	}

	isSaving.value = true

	try {
		const savedCustomer = await customerService.saveCustomer(customer.value)
		customerStore.setCustomer(savedCustomer)
	} catch {
		errorMessage.value = 'Failed to save customer details.'
	} finally {
		isSaving.value = false
	}
}

watch(
	() => customerId.value,
	(id) => {
		void loadCustomer(id)
	},
	{ immediate: true },
)
</script>

<template>
	<SidebarProvider>
		<CustomerListSideBar />
		<SidebarInset>
			<header
				class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12 text-foreground"
			>
				<div class="flex items-center gap-2 px-4">
					<SidebarTrigger class="-ml-1" />
				</div>
			</header>

			<div class="flex flex-1 flex-col gap-4 p-4 pt-0 text-foreground">
				<Card class="rounded-xl bg-muted/50">
					<CardHeader class="gap-3">
						<div class="flex items-center justify-between gap-3">
							<div>
								<CardTitle>Customer Details</CardTitle>
								<CardDescription>
									View and update customer profile information.
								</CardDescription>
							</div>
							<div class="flex items-center gap-2">
								<Button variant="default" size="sm" :disabled="isSaving || !customer" @click="saveCustomerChanges">
									{{ isSaving ? 'Saving...' : 'Save' }}
								</Button>
								<Button as-child variant="outline" size="sm">
									<RouterLink :to="{ name: 'customer-listing' }">
										<ArrowLeft class="h-4 w-4" />
										Back to list
									</RouterLink>
								</Button>
							</div>
						</div>
					</CardHeader>
					<CardContent class="space-y-6">
						<div v-if="isLoading" class="text-sm text-muted-foreground">
							Loading customer details...
						</div>

						<div v-else-if="errorMessage" class="text-sm text-destructive">
							{{ errorMessage }}
						</div>

						<div v-else-if="!customer" class="text-sm text-muted-foreground">
							No customer record found for ID {{ customerId }}.
						</div>

						<div v-else class="space-y-6">
							<section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
								<div>
									<Label for="customer-id">Customer ID</Label>
									<Input id="customer-id" v-model="customer.personalInfo.customerId" />
								</div>
								<div>
									<Label for="first-name">First Name</Label>
									<Input id="first-name" v-model="customer.personalInfo.firstName" />
								</div>
								<div>
									<Label for="last-name">Last Name</Label>
									<Input id="last-name" v-model="customer.personalInfo.lastName" />
								</div>
								<div>
									<Label for="middle-name">Middle Name</Label>
									<Input id="middle-name" v-model="customer.personalInfo.middleName" />
								</div>
								<div>
									<Label for="birth-date">Birth Date</Label>
									<Input id="birth-date" type="date" v-model="customer.personalInfo.birthDate" />
								</div>
								<div>
									<Label for="gender">Gender</Label>
									<Input id="gender" v-model="customer.personalInfo.gender" />
								</div>
								<div>
									<Label for="civil-status">Civil Status</Label>
									<Input id="civil-status" v-model="customer.personalInfo.civilStatus" />
								</div>
								<div>
									<Label for="nationality">Nationality</Label>
									<Input id="nationality" v-model="customer.personalInfo.nationality" />
								</div>
							</section>

							<Separator />

							<section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
								<div>
									<Label for="email">Email</Label>
									<Input id="email" v-model="customer.contactInfo.email" />
								</div>
								<div>
									<Label for="phone">Phone</Label>
									<Input id="phone" v-model="customer.contactInfo.phone" />
								</div>
								<div>
									<Label for="alternate-phone">Alternate Phone</Label>
									<Input id="alternate-phone" v-model="customer.contactInfo.alternatePhone" />
								</div>
							</section>
						</div>
					</CardContent>
				</Card>
			</div>
		</SidebarInset>
	</SidebarProvider>
</template>