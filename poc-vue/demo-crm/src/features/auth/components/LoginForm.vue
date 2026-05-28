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
					Use your email and password to enter the CRM dashboard.
				</p>
			</div>

			<form class="space-y-5" @submit.prevent>
				<div class="space-y-2">
					<Label for="login-email">Email</Label>
					<Input id="login-email" type="email" placeholder="name@company.com" />
				</div>

				<div class="space-y-2">
					<div class="flex items-center justify-between gap-3">
						<Label for="login-password">Password</Label>
						<button type="button" class="text-sm font-medium text-cyan-700 transition hover:text-cyan-800">
							Forgot password?
						</button>
					</div>
					<Input id="login-password" type="password" placeholder="Enter your password" />
				</div>

				<Button class="w-full gap-2" size="lg" type="submit">
					Continue to CRM
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
import { ArrowRight } from '@lucide/vue'
import { RouterLink } from 'vue-router'

import { Button } from '@/components/ui/button'
import { Card, CardContent } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
</script>
