<template>
  <div class="queue-display-view">
    <PageHeader
      title="Queue Display"
      subtitle="Public queue display settings"
      icon="mdi-monitor"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-open-in-new">
          Open Display
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-monitor</v-icon>
          <h3 class="mt-4">Queue Display Module</h3>
          <p>Queue display settings will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import PageHeader from '@/components/common/PageHeader.vue'
</script>
