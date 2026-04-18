import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import type { User, Clinic } from '@/types'
import userData from '@/data/user.json'

export const useUserStore = defineStore('user', () => {
  // State
  const user = ref<User | null>(null)
  const isLoading = ref(false)
  const error = ref<string | null>(null)

  // Getters
  const isLoggedIn = computed(() => !!user.value && user.value.isLoggedIn)
  const fullName = computed(() => {
    if (!user.value) return ''
    return `${user.value.firstName} ${user.value.lastName}`
  })
  const initials = computed(() => {
    if (!user.value) return ''
    return `${user.value.firstName.charAt(0)}${user.value.lastName.charAt(0)}`.toUpperCase()
  })
  const clinic = computed<Clinic | null>(() => user.value?.clinic || null)
  const permissions = computed<string[]>(() => user.value?.permissions || [])

  // Actions
  function loadUser(): void {
    isLoading.value = true
    error.value = null
    try {
      // In a real app, this would be an API call
      user.value = userData as User
    } catch (e) {
      error.value = 'Failed to load user data'
      console.error(e)
    } finally {
      isLoading.value = false
    }
  }

  function hasPermission(permission: string): boolean {
    return permissions.value.includes(permission)
  }

  function logout(): void {
    user.value = null
  }

  return {
    // State
    user,
    isLoading,
    error,
    // Getters
    isLoggedIn,
    fullName,
    initials,
    clinic,
    permissions,
    // Actions
    loadUser,
    hasPermission,
    logout,
  }
})
