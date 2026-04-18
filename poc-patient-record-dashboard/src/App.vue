<script setup>
import { onMounted } from 'vue'
import { useUserStore } from '@/stores/user'
import AppSidebar from '@/components/layout/AppSidebar.vue'
import AppHeader from '@/components/layout/AppHeader.vue'

const userStore = useUserStore()

onMounted(() => {
  userStore.loadUser()
})
</script>

<template>
  <v-app>
    <AppSidebar />
    
    <AppHeader />
    
    <v-main class="bg-grey-lighten-4">
      <router-view />
    </v-main>
  </v-app>
</template>

<style>
html, body {
  height: 100%;
  margin: 0;
  overflow: hidden;
}

#app {
  height: 100%;
}
</style>
