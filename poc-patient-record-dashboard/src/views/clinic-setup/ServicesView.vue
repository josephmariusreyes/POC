<template>
  <div class="services-view">
    <PageHeader
      title="Services"
      subtitle="Manage clinic services"
      icon="mdi-medical-bag"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-plus">
          Add Service
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-medical-bag</v-icon>
          <h3 class="mt-4">Services Module</h3>
          <p>Service management will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import PageHeader from '@/components/common/PageHeader.vue'
</script>
