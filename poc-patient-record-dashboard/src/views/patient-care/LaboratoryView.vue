<template>
  <div class="laboratory-view">
    <PageHeader
      title="Laboratory"
      subtitle="Manage lab tests and results"
      icon="mdi-flask"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-plus">
          New Lab Request
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-flask-outline</v-icon>
          <h3 class="mt-4">Laboratory Module</h3>
          <p>Laboratory test management will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup>
import PageHeader from '@/components/common/PageHeader.vue'
</script>
