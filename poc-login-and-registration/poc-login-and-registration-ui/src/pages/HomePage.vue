<template>
  <v-container class="fill-height" fluid>
    <v-row justify="center" align="center">
      <v-col cols="12" class="text-center">
        <v-icon size="100" color="primary" class="mb-4">mdi-home</v-icon>
        <h1 class="text-h2 font-weight-bold mb-4">Welcome Home</h1>
        <p class="text-h6 text-medium-emphasis mb-8">
          This is the public home page. Anyone can access this page.
        </p>

        <v-card class="mx-auto" max-width="600" variant="outlined">
          <v-card-text class="pa-6">
            <div v-if="!authStore.isAuthenticated">
              <p class="text-body-1 mb-4">
                You are currently not logged in. Please login to access protected areas.
              </p>
              <v-btn color="primary" to="/login" size="large">
                <v-icon start>mdi-login</v-icon>
                Login
              </v-btn>
            </div>

            <div v-else>
              <v-alert type="success" variant="tonal" class="mb-4">
                <div class="d-flex align-center">
                  <v-icon start>mdi-account-check</v-icon>
                  <div>
                    <div class="text-subtitle-1 font-weight-medium">
                      Welcome back, {{ authStore.user?.fullname }}!
                    </div>
                    <div class="text-caption">
                      You are logged in as <strong>{{ authStore.user?.role }}</strong>
                    </div>
                  </div>
                </div>
              </v-alert>

              <p class="text-body-1 mb-4">Navigate to your accessible pages:</p>

              <v-row justify="center" class="ga-2">
                <v-btn
                  v-if="authStore.hasRole(['admin', 'superAdmin'])"
                  color="primary"
                  to="/register"
                  variant="tonal"
                >
                  <v-icon start>mdi-account-plus</v-icon>
                  Register Users
                </v-btn>

                <v-btn
                  v-if="authStore.hasRole(['admin'])"
                  color="info"
                  to="/admin"
                  variant="tonal"
                >
                  <v-icon start>mdi-shield-account</v-icon>
                  Admin Page
                </v-btn>

                <v-btn
                  v-if="authStore.hasRole(['superAdmin'])"
                  color="warning"
                  to="/superadmin"
                  variant="tonal"
                >
                  <v-icon start>mdi-shield-crown</v-icon>
                  Super Admin Page
                </v-btn>
              </v-row>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()
</script>
