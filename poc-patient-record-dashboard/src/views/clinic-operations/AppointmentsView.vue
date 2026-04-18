<template>
  <div class="appointments-view">
    <PageHeader
      title="Appointments"
      subtitle="Manage clinic appointments"
      icon="mdi-calendar-check"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-plus">
          New Appointment
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-calendar-check-outline</v-icon>
          <h3 class="mt-4">Appointments Module</h3>
          <p>Appointment management will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import PageHeader from '@/components/common/PageHeader.vue'
</script>
