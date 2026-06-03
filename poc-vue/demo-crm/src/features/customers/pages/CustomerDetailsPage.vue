<script setup lang="ts">
import { ArrowLeft } from '@lucide/vue'
import { computed, ref, watch } from 'vue'
import { RouterLink, useRoute } from 'vue-router'

import CustomerListSideBar from '@/features/customers/components/CustomerListSideBar.vue'
import { customerService } from '@/features/customers/services/customer.service'
import type { Customer } from '@/features/customers/types/customer.types'

import { Button } from '@/components/ui/button'
import {
	Card,
	CardContent,
	CardDescription,
	CardHeader,
	CardTitle,
} from '@/components/ui/card'
import { Separator } from '@/components/ui/separator'
import {
	SidebarInset,
	SidebarProvider,
	SidebarTrigger,
} from '@/components/ui/sidebar'

const route = useRoute()
const customer = ref<Customer | null>(null)
const isLoading = ref(false)
const errorMessage = ref('')

const customerId = computed(() => {
	const id = route.query.id

	return Array.isArray(id) ? id[0] ?? '' : (id ?? '')
})

async function loadCustomer(id: string) {
	if (!id) {
		customer.value = null
		errorMessage.value = 'Missing customer ID.'
		return
	}

	isLoading.value = true
	errorMessage.value = ''

	try {
		customer.value = await customerService.getById(id)
	} catch {
		customer.value = null
		errorMessage.value = 'Failed to load customer details.'
	} finally {
		isLoading.value = false
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
									View customer profile information.
								</CardDescription>
							</div>
							<Button as-child variant="outline" size="sm">
								<RouterLink :to="{ name: 'customer-listing' }">
									<ArrowLeft class="h-4 w-4" />
									Back to list
								</RouterLink>
							</Button>
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
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Customer ID</p>
									<p class="text-sm font-medium">{{ customer.personalInfo.customerId }}</p>
								</div>
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">First Name</p>
									<p class="text-sm font-medium">{{ customer.personalInfo.firstName }}</p>
								</div>
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Last Name</p>
									<p class="text-sm font-medium">{{ customer.personalInfo.lastName }}</p>
								</div>
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Middle Name</p>
									<p class="text-sm font-medium">{{ customer.personalInfo.middleName }}</p>
								</div>
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Birth Date</p>
									<p class="text-sm font-medium">{{ customer.personalInfo.birthDate }}</p>
								</div>
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Gender</p>
									<p class="text-sm font-medium">{{ customer.personalInfo.gender }}</p>
								</div>
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Civil Status</p>
									<p class="text-sm font-medium">{{ customer.personalInfo.civilStatus }}</p>
								</div>
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Nationality</p>
									<p class="text-sm font-medium">{{ customer.personalInfo.nationality }}</p>
								</div>
							</section>

							<Separator />

							<section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Email</p>
									<p class="text-sm font-medium">{{ customer.contactInfo.email }}</p>
								</div>
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Phone</p>
									<p class="text-sm font-medium">{{ customer.contactInfo.phone }}</p>
								</div>
								<div>
									<p class="text-xs uppercase tracking-wide text-muted-foreground">Alternate Phone</p>
									<p class="text-sm font-medium">{{ customer.contactInfo.alternatePhone }}</p>
								</div>
							</section>
						</div>
					</CardContent>
				</Card>
			</div>
		</SidebarInset>
	</SidebarProvider>
</template>