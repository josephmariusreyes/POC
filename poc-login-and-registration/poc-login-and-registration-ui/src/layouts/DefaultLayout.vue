<template>
  <v-app>
    <!-- Navigation Bar -->
    <v-app-bar color="primary" density="comfortable">
      <v-app-bar-title>
        <router-link to="/" class="text-white text-decoration-none d-flex align-center">
          <v-icon class="mr-2">mdi-shield-lock</v-icon>
          POC Login & Registration
        </router-link>
      </v-app-bar-title>

      <v-spacer />

      <!-- Navigation Links -->
      <template v-if="!mobile">
        <v-btn to="/" variant="text">
          <v-icon start>mdi-home</v-icon>
          Home
        </v-btn>

        <template v-if="authStore.isAuthenticated">
          <v-btn
            v-if="authStore.hasRole(['admin', 'superAdmin'])"
            to="/register"
            variant="text"
          >
            <v-icon start>mdi-account-plus</v-icon>
            Register
          </v-btn>

          <v-btn
            v-if="authStore.hasRole(['admin'])"
            to="/admin"
            variant="text"
          >
            <v-icon start>mdi-shield-account</v-icon>
            Admin
          </v-btn>

          <v-btn
            v-if="authStore.hasRole(['superAdmin'])"
            to="/superadmin"
            variant="text"
          >
            <v-icon start>mdi-shield-crown</v-icon>
            Super Admin
          </v-btn>
        </template>
      </template>

      <!-- User Menu -->
      <v-menu v-if="authStore.isAuthenticated">
        <template v-slot:activator="{ props }">
          <v-btn icon v-bind="props">
            <v-avatar color="secondary" size="36">
              <span class="text-h6">{{ userInitials }}</span>
            </v-avatar>
          </v-btn>
        </template>

        <v-list density="compact" min-width="200">
          <v-list-item>
            <v-list-item-title class="font-weight-bold">
              {{ authStore.user?.fullname }}
            </v-list-item-title>
            <v-list-item-subtitle>
              <v-chip size="x-small" :color="roleColor" class="mt-1">
                {{ authStore.user?.role }}
              </v-chip>
            </v-list-item-subtitle>
          </v-list-item>

          <v-divider class="my-2" />

          <v-list-item @click="handleLogout" prepend-icon="mdi-logout">
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>

      <v-btn v-else to="/login" variant="outlined">
        <v-icon start>mdi-login</v-icon>
        Login
      </v-btn>

      <!-- Mobile Navigation Drawer Toggle -->
      <v-app-bar-nav-icon
        v-if="mobile"
        @click="drawer = !drawer"
      />
    </v-app-bar>

    <!-- Mobile Navigation Drawer -->
    <v-navigation-drawer
      v-model="drawer"
      temporary
      location="right"
    >
      <v-list nav density="compact">
        <v-list-item to="/" prepend-icon="mdi-home" title="Home" />

        <template v-if="authStore.isAuthenticated">
          <v-list-item
            v-if="authStore.hasRole(['admin', 'superAdmin'])"
            to="/register"
            prepend-icon="mdi-account-plus"
            title="Register"
          />

          <v-list-item
            v-if="authStore.hasRole(['admin'])"
            to="/admin"
            prepend-icon="mdi-shield-account"
            title="Admin"
          />

          <v-list-item
            v-if="authStore.hasRole(['superAdmin'])"
            to="/superadmin"
            prepend-icon="mdi-shield-crown"
            title="Super Admin"
          />

          <v-divider class="my-2" />

          <v-list-item
            @click="handleLogout"
            prepend-icon="mdi-logout"
            title="Logout"
          />
        </template>

        <v-list-item
          v-else
          to="/login"
          prepend-icon="mdi-login"
          title="Login"
        />
      </v-list>
    </v-navigation-drawer>

    <!-- Main Content -->
    <v-main>
      <router-view />
    </v-main>

    <!-- Footer -->
    <v-footer app class="bg-grey-lighten-4 text-center d-flex flex-column">
      <div class="text-caption text-medium-emphasis">
        POC Login & Registration - Vue.js + Laravel Sanctum Demo
      </div>
    </v-footer>
  </v-app>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useDisplay } from 'vuetify'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore()
const { mobile } = useDisplay()

const drawer = ref(false)

const userInitials = computed(() => {
  const name = authStore.user?.fullname || ''
  return name
    .split(' ')
    .map((n) => n[0])
    .join('')
    .toUpperCase()
    .slice(0, 2)
})

const roleColor = computed(() => {
  const role = authStore.user?.role
  if (role === 'superAdmin') return 'warning'
  if (role === 'admin') return 'info'
  return 'grey'
})

async function handleLogout() {
  await authStore.logout()
  router.push('/login')
}
</script>
