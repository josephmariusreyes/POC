<template>
  <div class="page-header" :class="{ 'has-gradient': gradient }">
    <div class="page-header-content d-flex align-center justify-space-between pa-6">
      <div class="d-flex align-center">
        <v-avatar 
          v-if="icon" 
          color="rgba(255,255,255,0.2)" 
          size="48" 
          class="mr-4"
        >
          <v-icon color="white" size="24">{{ icon }}</v-icon>
        </v-avatar>
        <div>
          <h1 class="text-h5 font-weight-medium text-white mb-1">
            {{ title }}
          </h1>
          <p v-if="subtitle" class="text-white-70 text-body-2 ma-0">
            {{ subtitle }}
          </p>
        </div>
      </div>
      
      <div class="page-header-actions">
        <slot name="actions"></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    required: true,
  },
  subtitle: {
    type: String,
    default: '',
  },
  icon: {
    type: String,
    default: '',
  },
  gradient: {
    type: Boolean,
    default: true,
  },
})
</script>

<style scoped>
.page-header {
  background-color: rgb(var(--v-theme-primary));
  border-radius: 0;
}

.page-header.has-gradient {
  background: linear-gradient(135deg, rgb(var(--v-theme-primary)) 0%, rgb(var(--v-theme-secondary)) 100%);
}

.text-white-70 {
  color: rgba(255, 255, 255, 0.7) !important;
}
</style>
