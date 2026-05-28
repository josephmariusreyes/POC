<!--
DEVNOTE: 
For real app implementation its better if sidebar functionality is a separate feature or a separate layout
then we will inject menus from different features of the app, for now this is fine
-->
<template>
	<Sidebar class="">
		<SidebarHeader>
			<SidebarMenu>
				<SidebarMenuItem>
					<SidebarMenuButton size="lg">
						<div class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground">
							<GalleryVerticalEnd class="size-4" />
						</div>
						<div class="grid flex-1 text-left text-sm leading-tight">
							<span class="truncate font-semibold">Acme Inc</span>
							<span class="truncate text-xs">Enterprise</span>
						</div>
					</SidebarMenuButton>
				</SidebarMenuItem>
			</SidebarMenu>
		</SidebarHeader>
		<SidebarContent>
			<SidebarGroup>
				<SidebarGroupContent>
					<SidebarMenu>
						<SidebarMenuItem>
							<SidebarMenuButton @click="isCustomersOpen = !isCustomersOpen">
								<ChevronRight class="transition-transform" :class="isCustomersOpen ? 'rotate-90' : ''" />
								<span>Customers</span>
							</SidebarMenuButton>
							<SidebarMenuSub v-if="isCustomersOpen">
								<SidebarMenuSubItem>
									<RouterLink :to="{ name: 'customer-create' }" custom v-slot="{ href, navigate, isActive }">
										<SidebarMenuSubButton as-child :is-active="isActive">
											<a :href="href" @click="navigate">
												<span>Create Customer</span>
											</a>
										</SidebarMenuSubButton>
									</RouterLink>
								</SidebarMenuSubItem>
								<SidebarMenuSubItem>
									<RouterLink :to="{ name: 'customer-listing' }" custom v-slot="{ href, navigate, isActive }">
										<SidebarMenuSubButton as-child :is-active="isActive">
											<a :href="href" @click="navigate">
												<span>Customer List</span>
											</a>
										</SidebarMenuSubButton>
									</RouterLink>
								</SidebarMenuSubItem>
							</SidebarMenuSub>
						</SidebarMenuItem>
					</SidebarMenu>
				</SidebarGroupContent>
			</SidebarGroup>
		</SidebarContent>
		<SidebarFooter />
		<SidebarRail />
	</Sidebar>
</template>

<script setup lang="ts">
import { ChevronRight, GalleryVerticalEnd } from '@lucide/vue'
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

import {
	Sidebar,
	SidebarContent,
	SidebarFooter,
	SidebarGroup,
	SidebarGroupContent,
	SidebarHeader,
	SidebarMenu,
	SidebarMenuButton,
	SidebarMenuItem,
	SidebarMenuSub,
	SidebarMenuSubButton,
	SidebarMenuSubItem,
	SidebarRail,
} from '@/components/ui/sidebar'

const isCustomersOpen = ref(true)
</script>
