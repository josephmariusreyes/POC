<template>
	<Card>
		<!--
			space-y-6: adds vertical spacing between each direct child inside the card content.
			p-6: applies consistent padding on all sides of the card content.
			sm:p-8: increases that padding on small screens and up for a roomier layout.
		-->
		<CardContent
			class="space-y-6
			p-6
			sm:p-8"
		>
			<div class="space-y-2">
				<h3 class="text-xl font-semibold tracking-tight text-slate-950">Sign in</h3>
				<p class="text-sm text-slate-600">
					Use your username and password to enter the CRM dashboard.
				</p>
			</div>

			<form class="space-y-5" @submit.prevent="onSubmit">
				<div class="space-y-2">
					<Label for="login-username">Username</Label>
					<Input id="login-username" v-model="username" placeholder="Enter your username" />
				</div>

				<div class="space-y-2">
					<div class="flex items-center justify-between gap-3">
						<Label for="login-password">Password</Label>
						<button type="button" class="text-sm font-medium text-cyan-700 transition hover:text-cyan-800">
							Forgot password?
						</button>
					</div>
					<Input id="login-password" v-model="password" type="password" placeholder="Enter your password" />
				</div>

				<p v-if="errorMessage" class="text-sm text-destructive">{{ errorMessage }}</p>

				<Button class="w-full gap-2" size="lg" type="submit" :disabled="isLoading">
					{{ isLoading ? 'Signing in...' : 'Continue to CRM' }}
					<ArrowRight class="h-4 w-4" />
				</Button>
			</form>

			<div class="rounded-2xl border border-cyan-100 bg-cyan-50/80 p-4 text-sm text-cyan-900">
				<p class="font-medium">UI-only phase</p>
				<p class="mt-1 text-cyan-800">
					This screen is intentionally static for now so you can focus on layout, spacing, and component composition.
				</p>
			</div>

			<p class="text-center text-sm text-slate-600">
				New here?
				<RouterLink class="font-semibold text-cyan-700 transition hover:text-cyan-800" :to="{ name: 'auth-register' }">
					Create an account
				</RouterLink>
			</p>
		</CardContent>
	</Card>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { ArrowRight } from '@lucide/vue'
import { RouterLink, useRoute, useRouter } from 'vue-router'

import { useAuthStore } from '@/features/auth/stores/auth.store'

import { Button } from '@/components/ui/button'
import { Card, CardContent } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'

const route = useRoute()
const router = useRouter()
const authStore = useAuthStore()

const username = ref('')
const password = ref('')
const isLoading = ref(false)
const errorMessage = ref('')

function resolvePostLoginRedirect(rawRedirect: unknown) {
	if (typeof rawRedirect !== 'string') {
		return { name: 'customer-listing' }
	}

	if (!rawRedirect.startsWith('/') || rawRedirect.startsWith('//')) {
		return { name: 'customer-listing' }
	}

	const resolved = router.resolve(rawRedirect)
	const isKnownRoute = resolved.matched.length > 0
	const isProtectedRoute = resolved.matched.some((record) => record.meta.requiresAuth)

	if (!isKnownRoute || !isProtectedRoute) {
		return { name: 'customer-listing' }
	}

	return resolved.fullPath
}

async function onSubmit() {
	errorMessage.value = ''
	isLoading.value = true

	try {
		await authStore.login(username.value, password.value)

		const redirectPath = resolvePostLoginRedirect(route.query.redirect)

		await router.push(redirectPath)
	} catch (error) {
		errorMessage.value =
			error instanceof Error ? error.message : 'Unable to login. Please try again.'
	} finally {
		isLoading.value = false
	}
}
</script>
