<template>
  <div class="user-management-view">
    <PageHeader
      title="User Management"
      subtitle="Manage system users and permissions"
      icon="mdi-account-cog"
    >
      <template #actions>
        <v-btn color="white" variant="flat" prepend-icon="mdi-plus">
          Add User
        </v-btn>
      </template>
    </PageHeader>

    <div class="pa-6">
      <v-card flat class="pa-6">
        <div class="text-center text-grey py-12">
          <v-icon size="64" color="grey-lighten-1">mdi-account-cog-outline</v-icon>
          <h3 class="mt-4">User Management Module</h3>
          <p>User management will be displayed here.</p>
        </div>
      </v-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import PageHeader from '@/components/common/PageHeader.vue'
</script>
