<template>
	<Card class="border-white/70 bg-white/90 shadow-xl shadow-slate-200/70 backdrop-blur">
		<CardContent class="space-y-6 p-6 sm:p-8">
			<div class="space-y-2">
				<h3 class="text-xl font-semibold tracking-tight text-slate-950">Create account</h3>
				<p class="text-sm text-slate-600">
					Start with the fields you need most. Validation and submission will be added later.
				</p>
			</div>

			<form class="space-y-5" @submit.prevent>
				<div class="grid gap-5 sm:grid-cols-2">
					<div class="space-y-2">
						<Label for="register-first-name">First name</Label>
						<Input id="register-first-name" type="text" placeholder="Juan" />
					</div>
					<div class="space-y-2">
						<Label for="register-last-name">Last name</Label>
						<Input id="register-last-name" type="text" placeholder="Dela Cruz" />
					</div>
				</div>

				<div class="space-y-2">
					<Label for="register-email">Work email</Label>
					<Input id="register-email" type="email" placeholder="you@company.com" />
				</div>

				<div class="space-y-2">
					<Label for="register-role">Preferred role</Label>
					<Input id="register-role" type="text" placeholder="Sales manager" />
				</div>

				<div class="grid gap-5 sm:grid-cols-2">
					<div class="space-y-2">
						<Label for="register-password">Password</Label>
						<Input id="register-password" type="password" placeholder="Create a password" />
					</div>
					<div class="space-y-2">
						<Label for="register-confirm-password">Confirm password</Label>
						<Input id="register-confirm-password" type="password" placeholder="Repeat your password" />
					</div>
				</div>

				<Button class="w-full gap-2" size="lg" type="submit">
					Create account
					<ArrowRight class="h-4 w-4" />
				</Button>
			</form>

			<p class="text-center text-sm text-slate-600">
				Already have an account?
				<RouterLink class="font-semibold text-cyan-700 transition hover:text-cyan-800" :to="{ name: 'auth-login' }">
					Sign in instead
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
