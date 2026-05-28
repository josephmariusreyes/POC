<template>
	<div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(14,116,144,0.16),_transparent_35%),linear-gradient(180deg,_#f8fafc_0%,_#ecfeff_50%,_#f8fafc_100%)] text-foreground">
		<div class="mx-auto grid min-h-screen max-w-7xl gap-10 px-6 py-8 lg:grid-cols-[1.1fr_0.9fr] lg:px-10 lg:py-10">
			<section class="hidden overflow-hidden rounded-[2rem] border border-border/60 bg-slate-950 px-8 py-10 text-slate-50 shadow-2xl shadow-cyan-950/20 lg:flex lg:flex-col lg:justify-between">
				<div class="space-y-6">
					<div class="inline-flex items-center gap-3 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-medium backdrop-blur">
						<span class="flex h-8 w-8 items-center justify-center rounded-full bg-cyan-400/20 text-cyan-200">
							<ShieldCheck class="h-4 w-4" />
						</span>
						Demo CRM workspace
					</div>

					<div class="max-w-lg space-y-4">
						<p class="text-sm uppercase tracking-[0.3em] text-cyan-200/80">Auth experience</p>
						<h1 class="font-heading text-4xl font-semibold tracking-tight text-white xl:text-5xl">
							A clean entry flow for your CRM POC.
						</h1>
						<p class="text-base leading-7 text-slate-300">
							This layout gives your login and registration pages a stable shell now, so the auth logic can be added later without reshaping the UI.
						</p>
					</div>
				</div>

				<div class="grid gap-4 sm:grid-cols-2">
					<article class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm">
						<Users class="mb-4 h-5 w-5 text-cyan-200" />
						<h2 class="text-sm font-semibold text-white">Customer-ready shell</h2>
						<p class="mt-2 text-sm leading-6 text-slate-300">
							Designed to grow into protected routes, role-aware navigation, and a proper dashboard.
						</p>
					</article>
					<article class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm">
						<Sparkles class="mb-4 h-5 w-5 text-cyan-200" />
						<h2 class="text-sm font-semibold text-white">Shadcn-style primitives</h2>
						<p class="mt-2 text-sm leading-6 text-slate-300">
							The screens use reusable card, button, input, and label components that match your Tailwind token setup.
						</p>
					</article>
				</div>
			</section>

			<section class="flex min-h-[calc(100vh-4rem)] items-center justify-center lg:min-h-0">
				<div class="w-full max-w-md">
					<RouterView />
				</div>
			</section>
		</div>
	</div>
</template>

<script setup lang="ts">
import { ShieldCheck, Sparkles, Users } from '@lucide/vue'
import { RouterView } from 'vue-router'
</script>
