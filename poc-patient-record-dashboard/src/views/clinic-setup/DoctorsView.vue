<template>
  <div class="doctors-view">
    <PageHeader
      title="Doctors"
      subtitle="Manage clinic doctors"
      icon="mdi-doctor"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-plus">
          Add Doctor
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-doctor</v-icon>
          <h3 class="mt-4">Doctors Module</h3>
          <p>Doctor management will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import PageHeader from '@/components/common/PageHeader.vue'
</script>
