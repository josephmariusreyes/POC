<template>
  <v-app-bar flat color="white" height="56" class="app-header px-4">
    <!-- Breadcrumb -->
    <v-breadcrumbs :items="breadcrumbs" class="pa-0">
      <template #prepend>
        <v-icon size="small" class="mr-2">mdi-file-document-outline</v-icon>
      </template>
      <template #divider>
        <v-icon size="small">mdi-chevron-right</v-icon>
      </template>
    </v-breadcrumbs>

    <v-spacer></v-spacer>

    <!-- Right side actions -->
    <div class="d-flex align-center">
      <!-- Notifications -->
      <v-btn icon variant="text" class="mr-2">
        <v-icon>mdi-bell-outline</v-icon>
      </v-btn>

      <!-- User Menu -->
      <v-menu offset-y>
        <template #activator="{ props }">
          <v-btn
            v-bind="props"
            variant="text"
            class="user-menu-btn"
          >
            <v-avatar color="primary" size="32">
              <span class="text-white text-body-2 font-weight-medium">
                {{ userInitials }}
              </span>
            </v-avatar>
            <span class="online-indicator"></span>
          </v-btn>
        </template>

        <v-list density="compact" min-width="200">
          <v-list-item>
            <template #prepend>
              <v-avatar color="primary" size="36">
                <span class="text-white">{{ userInitials }}</span>
              </v-avatar>
            </template>
            <v-list-item-title class="font-weight-medium">
              {{ fullName }}
            </v-list-item-title>
            <v-list-item-subtitle>{{ userEmail }}</v-list-item-subtitle>
          </v-list-item>

          <v-divider class="my-1"></v-divider>

          <v-list-item prepend-icon="mdi-account-outline" title="Profile"></v-list-item>
          <v-list-item prepend-icon="mdi-cog-outline" title="Settings"></v-list-item>

          <v-divider class="my-1"></v-divider>

          <v-list-item 
            prepend-icon="mdi-logout" 
            title="Logout"
            @click="handleLogout"
          ></v-list-item>
        </v-list>
      </v-menu>
    </div>
  </v-app-bar>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { useUserStore } from '@/stores/user'

const route = useRoute()
const userStore = useUserStore()

const fullName = computed(() => userStore.fullName)
const userInitials = computed(() => userStore.initials)
const userEmail = computed(() => userStore.user?.email || '')

const breadcrumbs = computed(() => {
  const items = []
  
  if (route.meta?.section) {
    items.push({
      title: route.meta.section,
      disabled: false,
    })
  }
  
  items.push({
    title: route.name || 'Page',
    disabled: true,
  })
  
  return items
})

function handleLogout() {
  userStore.logout()
  // In a real app, redirect to login page
}
</script>

<style scoped>
.app-header {
  border-bottom: 1px solid rgba(0, 0, 0, 0.08) !important;
}

.user-menu-btn {
  position: relative;
}

.online-indicator {
  position: absolute;
  bottom: 8px;
  right: 4px;
  width: 10px;
  height: 10px;
  background-color: #4CAF50;
  border: 2px solid white;
  border-radius: 50%;
}
</style>
