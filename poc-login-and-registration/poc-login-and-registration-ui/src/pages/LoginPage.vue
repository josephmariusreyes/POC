<template>
  <v-container class="fill-height" fluid>
    <v-row justify="center" align="center">
      <v-col cols="12" sm="8" md="6" lg="4">
        <v-card class="elevation-8">
          <v-card-title class="text-h5 text-center pa-6 bg-primary">
            <v-icon size="40" class="mr-2">mdi-login</v-icon>
            Login
          </v-card-title>

          <v-card-text class="pa-6">
            <v-form ref="formRef" v-model="valid" @submit.prevent="handleLogin">
              <v-alert
                v-if="error"
                type="error"
                variant="tonal"
                class="mb-4"
                closable
                @click:close="error = ''"
              >
                {{ error }}
              </v-alert>

              <v-text-field
                v-model="form.username"
                label="Username"
                prepend-inner-icon="mdi-account"
                :rules="[rules.required]"
                :disabled="loading"
                autocomplete="username"
                class="mb-4"
              />

              <v-text-field
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                label="Password"
                prepend-inner-icon="mdi-lock"
                :append-inner-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[rules.required]"
                :disabled="loading"
                autocomplete="current-password"
                class="mb-4"
                @click:append-inner="showPassword = !showPassword"
              />

              <v-btn
                type="submit"
                color="primary"
                block
                size="large"
                :loading="loading"
                :disabled="!valid"
              >
                <v-icon start>mdi-login</v-icon>
                Login
              </v-btn>
            </v-form>
          </v-card-text>

          <v-divider />

          <v-card-actions class="pa-4 justify-center">
            <v-btn variant="text" to="/" color="secondary">
              <v-icon start>mdi-home</v-icon>
              Back to Home
            </v-btn>
          </v-card-actions>
        </v-card>

        <!-- Demo credentials card -->
        <v-card class="mt-4" variant="outlined">
          <v-card-title class="text-subtitle-1">
            <v-icon start size="small">mdi-information</v-icon>
            Demo Credentials
          </v-card-title>
          <v-card-text class="pt-0">
            <v-list density="compact" class="pa-0">
              <v-list-item>
                <template v-slot:prepend>
                  <v-icon color="warning" size="small">mdi-shield-crown</v-icon>
                </template>
                <v-list-item-title class="text-caption">
                  <strong>Super Admin:</strong> superadmin / SuperAdmin@123
                </v-list-item-title>
              </v-list-item>
              <v-list-item>
                <template v-slot:prepend>
                  <v-icon color="info" size="small">mdi-shield-account</v-icon>
                </template>
                <v-list-item-title class="text-caption">
                  <strong>Admin:</strong> admin1 / Admin@123
                </v-list-item-title>
              </v-list-item>
            </v-list>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const route = useRoute()
const authStore = useAuthStore()

const formRef = ref(null)
const valid = ref(false)
const loading = ref(false)
const error = ref('')
const showPassword = ref(false)

const form = reactive({
  username: '',
  password: '',
})

const rules = {
  required: (v) => !!v || 'This field is required',
}

async function handleLogin() {
  if (!valid.value) return

  loading.value = true
  error.value = ''

  try {
    const result = await authStore.login(form.username, form.password)

    if (result.success) {
      // Redirect to intended page or home based on role
      const redirect = route.query.redirect
      if (redirect) {
        router.push(redirect)
      } else {
        // Redirect based on role
        if (authStore.isSuperAdmin) {
          router.push('/superadmin')
        } else if (authStore.isAdmin) {
          router.push('/admin')
        } else {
          router.push('/')
        }
      }
    } else {
      error.value = result.message
    }
  } catch (err) {
    error.value = 'An unexpected error occurred. Please try again.'
  } finally {
    loading.value = false
  }
}
</script>
