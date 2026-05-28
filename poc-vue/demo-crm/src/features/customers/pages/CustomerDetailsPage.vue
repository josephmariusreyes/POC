<script setup lang="ts">
import { computed } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()

const customerId = computed(() => {
	const id = route.query.id

	return Array.isArray(id) ? id[0] ?? '' : (id ?? '')
})
</script>

<template>
	<div>Customer details {{ customerId }}</div>
</template>