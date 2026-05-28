<template>
	<div class="space-y-6">
		<div class="space-y-2 text-center lg:text-left">
			<p class="text-sm font-medium uppercase tracking-[0.28em] text-cyan-700">Auth / Login</p>
			<h2 class="font-heading text-3xl font-semibold tracking-tight text-slate-950">
				Welcome back
			</h2>
			<p class="text-sm leading-6 text-slate-600">
				Sign in to continue into the CRM workspace. Functionality comes next; for now this page establishes the final UI direction.
			</p>
		</div>

		<LoginForm />
	</div>
</template>

<script setup lang="ts">
import LoginForm from '@/features/auth/components/LoginForm.vue'
</script>
