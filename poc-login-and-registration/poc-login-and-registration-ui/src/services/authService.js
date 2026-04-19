import api from './api'

/**
 * Authentication Service
 * Handles all authentication-related API calls
 */
export const authService = {
  /**
   * Login user with credentials
   * @param {string} username
   * @param {string} password
   * @returns {Promise}
   */
  async login(username, password) {
    const response = await api.post('/login', { username, password })
    return response.data
  },

  /**
   * Register a new user (requires admin/superAdmin role)
   * @param {Object} userData
   * @returns {Promise}
   */
  async register(userData) {
    const response = await api.post('/register', userData)
    return response.data
  },

  /**
   * Get current authenticated user
   * @returns {Promise}
   */
  async getMe() {
    const response = await api.get('/me')
    return response.data
  },

  /**
   * Logout current user
   * @returns {Promise}
   */
  async logout() {
    const response = await api.post('/logout')
    return response.data
  },
}

export default authService
