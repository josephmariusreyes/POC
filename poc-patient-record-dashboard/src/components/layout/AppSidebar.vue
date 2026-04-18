<template>
  <v-navigation-drawer
    v-model="drawer"
    :rail="rail"
    permanent
    color="primary"
    class="app-sidebar"
  >
    <!-- Clinic Logo & Name -->
    <div class="sidebar-header pa-4">
      <div class="d-flex align-center">
        <v-avatar color="white" size="36" class="mr-3">
          <span class="text-primary font-weight-bold">Z</span>
        </v-avatar>
        <div v-if="!rail" class="clinic-info">
          <div class="clinic-name text-white font-weight-medium">
            {{ clinic?.name || 'Clinic Name' }}
          </div>
          <div class="clinic-version text-white-50 text-caption">
            {{ clinic?.version || 'v1.0.0' }}
          </div>
        </div>
      </div>
    </div>

    <v-divider class="border-opacity-25"></v-divider>

    <!-- Navigation Menu -->
    <v-list density="compact" nav class="px-2">
      <template v-for="(section, sectionIndex) in navigationSections" :key="sectionIndex">
        <v-list-subheader 
          v-if="!rail" 
          class="text-white-50 text-uppercase text-caption mt-2"
        >
          {{ section.title }}
        </v-list-subheader>

        <v-list-item
          v-for="item in section.items"
          :key="item.path"
          :to="item.path"
          :prepend-icon="item.icon"
          :title="item.title"
          :active="isActive(item.path)"
          rounded="lg"
          class="nav-item mb-1"
          color="white"
        >
          <template #append v-if="item.external">
            <v-icon size="small" class="text-white-50">mdi-open-in-new</v-icon>
          </template>
        </v-list-item>
      </template>
    </v-list>

    <template #append>
      <div class="pa-2">
        <v-btn
          block
          variant="text"
          color="white"
          :icon="rail ? 'mdi-chevron-right' : 'mdi-chevron-left'"
          @click="rail = !rail"
        ></v-btn>
      </div>
    </template>
  </v-navigation-drawer>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import { useUserStore } from '@/stores/user'
import type { NavigationSection, Clinic } from '@/types'

const route = useRoute()
const userStore = useUserStore()

const drawer = ref(true)
const rail = ref(false)

const clinic = computed<Clinic | null>(() => userStore.clinic)

const navigationSections: NavigationSection[] = [
  {
    title: 'Clinic Operations',
    items: [
      { title: 'Appointments', path: '/appointments', icon: 'mdi-calendar-check' },
      { title: 'Reception Queue', path: '/reception-queue', icon: 'mdi-account-clock' },
    ],
  },
  {
    title: 'Patient Care',
    items: [
      { title: 'Patients', path: '/patients', icon: 'mdi-account-group' },
      { title: 'Billing', path: '/billing', icon: 'mdi-receipt' },
      { title: 'Laboratory', path: '/laboratory', icon: 'mdi-flask' },
    ],
  },
  {
    title: 'Medical Records',
    items: [
      { title: 'Consultations', path: '/consultations', icon: 'mdi-stethoscope' },
      { title: 'Medical Certificates', path: '/medical-certificates', icon: 'mdi-file-document' },
    ],
  },
  {
    title: 'Clinic Setup',
    items: [
      { title: 'Doctors', path: '/doctors', icon: 'mdi-doctor' },
      { title: 'Services', path: '/services', icon: 'mdi-medical-bag' },
      { title: 'Inventory', path: '/inventory', icon: 'mdi-package-variant' },
    ],
  },
  {
    title: 'Account settings',
    items: [
      { title: 'User Management', path: '/user-management', icon: 'mdi-account-cog' },
      { title: 'Queue Display', path: '/queue-display', icon: 'mdi-monitor', external: true },
    ],
  },
]

function isActive(path: string): boolean {
  return route.path === path
}
</script>

<style scoped>
.app-sidebar {
  border: none !important;
}

.sidebar-header {
  min-height: 64px;
}

.clinic-name {
  font-size: 14px;
  line-height: 1.2;
}

.clinic-version {
  font-size: 11px;
}

.text-white-50 {
  color: rgba(255, 255, 255, 0.5) !important;
}

.nav-item {
  color: rgba(255, 255, 255, 0.85) !important;
}

.nav-item:hover {
  background-color: rgba(255, 255, 255, 0.1) !important;
}

.nav-item.v-list-item--active {
  background-color: rgba(255, 255, 255, 0.15) !important;
}
</style>
