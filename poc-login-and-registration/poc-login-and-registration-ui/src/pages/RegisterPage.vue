<template>
  <v-container class="fill-height" fluid>
    <v-row justify="center" align="center">
      <v-col cols="12" sm="8" md="6" lg="5">
        <v-card class="elevation-8">
          <v-card-title class="text-h5 text-center pa-6 bg-primary">
            <v-icon size="40" class="mr-2">mdi-account-plus</v-icon>
            Register New User
          </v-card-title>

          <v-card-text class="pa-6">
            <v-alert
              type="info"
              variant="tonal"
              class="mb-4"
            >
              <v-icon start>mdi-information</v-icon>
              Only <strong>Admin</strong> and <strong>Super Admin</strong> can register new users.
            </v-alert>

            <v-form ref="formRef" v-model="valid" @submit.prevent="handleRegister">
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

              <v-alert
                v-if="success"
                type="success"
                variant="tonal"
                class="mb-4"
                closable
                @click:close="success = ''"
              >
                {{ success }}
              </v-alert>

              <v-text-field
                v-model="form.username"
                label="Username"
                prepend-inner-icon="mdi-account"
                :rules="[rules.required, rules.minLength(3)]"
                :disabled="loading"
                autocomplete="username"
                class="mb-2"
              />

              <v-text-field
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                label="Password"
                prepend-inner-icon="mdi-lock"
                :append-inner-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[rules.required, rules.minLength(6)]"
                :disabled="loading"
                autocomplete="new-password"
                class="mb-2"
                @click:append-inner="showPassword = !showPassword"
              />

              <v-text-field
                v-model="form.fullname"
                label="Full Name"
                prepend-inner-icon="mdi-badge-account"
                :rules="[rules.required]"
                :disabled="loading"
                autocomplete="name"
                class="mb-2"
              />

              <v-text-field
                v-model="form.contactNumber"
                label="Contact Number"
                prepend-inner-icon="mdi-phone"
                :disabled="loading"
                autocomplete="tel"
                class="mb-2"
              />

              <v-select
                v-model="form.role"
                :items="roleOptions"
                item-title="label"
                item-value="value"
                label="Role"
                prepend-inner-icon="mdi-shield-account"
                :rules="[rules.required]"
                :disabled="loading"
                class="mb-4"
              />

              <v-btn
                type="submit"
                color="primary"
                block
                size="large"
                :loading="loading"
                :disabled="!valid"
              >
                <v-icon start>mdi-account-plus</v-icon>
                Register User
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
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()

const formRef = ref(null)
const valid = ref(false)
const loading = ref(false)
const error = ref('')
const success = ref('')
const showPassword = ref(false)

const form = reactive({
  username: '',
  password: '',
  fullname: '',
  contactNumber: '',
  role: 'admin',
})

const roleOptions = [
  { label: 'Admin', value: 'admin' },
  { label: 'Super Admin', value: 'superAdmin' },
]

const rules = {
  required: (v) => !!v || 'This field is required',
  minLength: (min) => (v) => (v && v.length >= min) || `Minimum ${min} characters required`,
}

async function handleRegister() {
  if (!valid.value) return

  loading.value = true
  error.value = ''
  success.value = ''

  try {
    const result = await authStore.register({
      username: form.username,
      password: form.password,
      fullname: form.fullname,
      contactNumber: form.contactNumber,
      role: form.role,
    })

    if (result.success) {
      success.value = `User "${form.username}" registered successfully!`
      // Reset form
      form.username = ''
      form.password = ''
      form.fullname = ''
      form.contactNumber = ''
      form.role = 'admin'
      formRef.value?.resetValidation()
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
