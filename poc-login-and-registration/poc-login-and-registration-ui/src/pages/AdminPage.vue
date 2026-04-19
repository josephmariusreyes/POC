<template>
  <v-container class="fill-height" fluid>
    <v-row justify="center" align="center">
      <v-col cols="12" class="text-center">
        <v-card class="mx-auto pa-8" max-width="600" color="info" variant="tonal">
          <v-icon size="80" color="info" class="mb-4">mdi-shield-account</v-icon>
          
          <h1 class="text-h3 font-weight-bold mb-4 text-info">
            Admin Dashboard
          </h1>
          
          <v-divider class="my-4" />
          
          <v-alert type="info" variant="outlined" class="mb-4">
            <div class="text-h6">
              <v-icon start>mdi-check-circle</v-icon>
              This is the <strong>ADMIN</strong> page
            </div>
          </v-alert>
          
          <p class="text-body-1 mb-4">
            This page can only be accessed by users with the <strong>admin</strong> role.
          </p>

          <v-card variant="outlined" class="pa-4 mb-4">
            <div class="text-subtitle-2 text-medium-emphasis mb-2">Current User Info:</div>
            <div class="text-body-2">
              <v-chip color="info" size="small" class="ma-1">
                <v-icon start size="small">mdi-account</v-icon>
                {{ authStore.user?.fullname }}
              </v-chip>
              <v-chip color="success" size="small" class="ma-1">
                <v-icon start size="small">mdi-shield</v-icon>
                Role: {{ authStore.user?.role }}
              </v-chip>
            </div>
          </v-card>

          <v-btn color="primary" to="/" variant="elevated" class="mr-2">
            <v-icon start>mdi-home</v-icon>
            Back to Home
          </v-btn>
          
          <v-btn
            v-if="authStore.hasRole(['admin', 'superAdmin'])"
            color="success"
            to="/register"
            variant="elevated"
          >
            <v-icon start>mdi-account-plus</v-icon>
            Register Users
          </v-btn>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()
</script>
