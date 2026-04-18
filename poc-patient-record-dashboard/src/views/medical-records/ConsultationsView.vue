<template>
  <div class="consultations-view">
    <PageHeader
      title="Consultations"
      subtitle="Patient consultation records"
      icon="mdi-stethoscope"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-plus">
          New Consultation
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-stethoscope</v-icon>
          <h3 class="mt-4">Consultations Module</h3>
          <p>Consultation records will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import PageHeader from '@/components/common/PageHeader.vue'
</script>
