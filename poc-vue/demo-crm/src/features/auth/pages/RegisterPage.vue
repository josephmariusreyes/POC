<template>
	<div class="space-y-6">
		<div class="space-y-2 text-center lg:text-left">
			<p class="text-sm font-medium uppercase tracking-[0.28em] text-cyan-700">Auth / Register</p>
			<h2 class="font-heading text-3xl font-semibold tracking-tight text-slate-950">
				Create your workspace access
			</h2>
			<p class="text-sm leading-6 text-slate-600">
				Set up a polished registration experience first, then wire validation and persistence once the auth flow is ready.
			</p>
		</div>

		<RegisterForm />
	</div>
</template>

<script setup lang="ts">
import RegisterForm from '@/features/auth/components/RegisterForm.vue'
</script>
