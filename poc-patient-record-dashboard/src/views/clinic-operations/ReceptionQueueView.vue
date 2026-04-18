<template>
  <div class="reception-queue-view">
    <PageHeader
      title="Reception Queue"
      subtitle="Manage patient queue"
      icon="mdi-account-clock"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-plus">
          Add to Queue
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-account-clock-outline</v-icon>
          <h3 class="mt-4">Reception Queue Module</h3>
          <p>Patient queue management will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup>
import PageHeader from '@/components/common/PageHeader.vue'
</script>
