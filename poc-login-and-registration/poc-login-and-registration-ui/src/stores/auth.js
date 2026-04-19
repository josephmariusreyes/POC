import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import authService from '@/services/authService'

/**
 * Authentication Store
 * Manages user authentication state and provides auth-related actions
 */
export const useAuthStore = defineStore('auth', () => {
  // State
  const user = ref(null)
  const token = ref(null)
  const loading = ref(false)
  const error = ref(null)

  // Getters
  const isAuthenticated = computed(() => !!token.value)
  const userRole = computed(() => user.value?.role || null)
  const isAdmin = computed(() => userRole.value === 'admin')
  const isSuperAdmin = computed(() => userRole.value === 'superAdmin')
  const canAccessAdmin = computed(() => isAdmin.value || isSuperAdmin.value)

  // Initialize state from localStorage
  function initialize() {
    const storedToken = localStorage.getItem('token')
    const storedUser = localStorage.getItem('user')

    if (storedToken) {
      token.value = storedToken
    }
    if (storedUser) {
      try {
        user.value = JSON.parse(storedUser)
      } catch (e) {
        console.error('Failed to parse stored user:', e)
        localStorage.removeItem('user')
      }
    }
  }

  // Actions
  async function login(username, password) {
    loading.value = true
    error.value = null

    try {
      const response = await authService.login(username, password)

      if (response.success) {
        token.value = response.data.token
        user.value = response.data.user

        // Persist to localStorage
        localStorage.setItem('token', response.data.token)
        localStorage.setItem('user', JSON.stringify(response.data.user))

        return { success: true }
      } else {
        error.value = response.message
        return { success: false, message: response.message }
      }
    } catch (err) {
      const message = err.response?.data?.message || 'Login failed. Please try again.'
      error.value = message
      return { success: false, message }
    } finally {
      loading.value = false
    }
  }

  async function register(userData) {
    loading.value = true
    error.value = null

    try {
      const response = await authService.register(userData)

      if (response.success) {
        return { success: true, data: response.data }
      } else {
        error.value = response.message
        return { success: false, message: response.message }
      }
    } catch (err) {
      const message = err.response?.data?.message || 'Registration failed. Please try again.'
      error.value = message
      return { success: false, message }
    } finally {
      loading.value = false
    }
  }

  async function logout() {
    try {
      await authService.logout()
    } catch (err) {
      console.error('Logout API call failed:', err)
    } finally {
      // Clear state regardless of API call result
      user.value = null
      token.value = null
      localStorage.removeItem('token')
      localStorage.removeItem('user')
    }
  }

  async function fetchUser() {
    if (!token.value) return

    try {
      const response = await authService.getMe()
      if (response.success) {
        user.value = response.data
        localStorage.setItem('user', JSON.stringify(response.data))
      }
    } catch (err) {
      console.error('Failed to fetch user:', err)
      // If fetching user fails, the interceptor will handle 401
    }
  }

  /**
   * Check if user has one of the required roles
   * @param {string[]} roles - Array of allowed roles
   * @returns {boolean}
   */
  function hasRole(roles) {
    if (!user.value || !user.value.role) return false
    return roles.includes(user.value.role)
  }

  return {
    // State
    user,
    token,
    loading,
    error,
    // Getters
    isAuthenticated,
    userRole,
    isAdmin,
    isSuperAdmin,
    canAccessAdmin,
    // Actions
    initialize,
    login,
    register,
    logout,
    fetchUser,
    hasRole,
  }
})
