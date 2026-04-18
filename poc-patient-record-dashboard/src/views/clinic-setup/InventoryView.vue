<template>
  <div class="inventory-view">
    <PageHeader
      title="Inventory"
      subtitle="Manage clinic inventory"
      icon="mdi-package-variant"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-plus">
          Add Item
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-package-variant</v-icon>
          <h3 class="mt-4">Inventory Module</h3>
          <p>Inventory management will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup>
import PageHeader from '@/components/common/PageHeader.vue'
</script>
