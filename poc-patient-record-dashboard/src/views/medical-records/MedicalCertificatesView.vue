<template>
  <div class="medical-certificates-view">
    <PageHeader
      title="Medical Certificates"
      subtitle="Generate and manage medical certificates"
      icon="mdi-file-document"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-plus">
          New Certificate
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-file-document-outline</v-icon>
          <h3 class="mt-4">Medical Certificates Module</h3>
          <p>Medical certificate management will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import PageHeader from '@/components/common/PageHeader.vue'
</script>
