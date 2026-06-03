<template>
	<div class="w-full md:max-w-sm">
		<Input
			:model-value="props.modelValue"
			placeholder="Filter by personal info..."
			@update:model-value="onUpdateModelValue"
		/>
	</div>
</template>

<script setup lang="ts">
import { Input } from '@/components/ui/input'

interface Props {
	modelValue: string
}

const props = defineProps<Props>()

const emit = defineEmits<{
	(e: 'update:modelValue', value: string): void
}>()

function onUpdateModelValue(value: string | number) {
	emit('update:modelValue', String(value))
}
</script>
