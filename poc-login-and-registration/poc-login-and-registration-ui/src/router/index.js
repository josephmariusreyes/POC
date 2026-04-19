import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

// Import pages
import HomePage from '@/pages/HomePage.vue'
import LoginPage from '@/pages/LoginPage.vue'
import RegisterPage from '@/pages/RegisterPage.vue'
import AdminPage from '@/pages/AdminPage.vue'
import SuperAdminPage from '@/pages/SuperAdminPage.vue'

/**
 * Route Definitions
 * 
 * Route meta properties:
 * - requiresAuth: boolean - Route requires authentication
 * - roles: string[] - Allowed roles for the route
 * - guest: boolean - Route is only for guests (unauthenticated users)
 */
const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,
    meta: {
      title: 'Home',
      requiresAuth: false,
    },
  },
  {
    path: '/login',
    name: 'login',
    component: LoginPage,
    meta: {
      title: 'Login',
      requiresAuth: false,
      guest: true, // Redirect to home if already logged in
    },
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterPage,
    meta: {
      title: 'Register User',
      requiresAuth: true,
      roles: ['admin', 'superAdmin'], // Only admin and superAdmin can access
    },
  },
  {
    path: '/admin',
    name: 'admin',
    component: AdminPage,
    meta: {
      title: 'Admin Dashboard',
      requiresAuth: true,
      roles: ['admin'], // Only admin role can access
    },
  },
  {
    path: '/superadmin',
    name: 'superadmin',
    component: SuperAdminPage,
    meta: {
      title: 'Super Admin Dashboard',
      requiresAuth: true,
      roles: ['superAdmin'], // Only superAdmin role can access
    },
  },
  // Catch-all route for 404
  {
    path: '/:pathMatch(.*)*',
    redirect: '/',
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

/**
 * Navigation Guard
 * Protects routes based on authentication and role requirements
 */
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()

  // Update page title
  document.title = to.meta.title ? `${to.meta.title} | POC Login & Registration` : 'POC Login & Registration'

  // Check if route requires authentication
  if (to.meta.requiresAuth) {
    if (!authStore.isAuthenticated) {
      // Not authenticated, redirect to login
      return next({
        name: 'login',
        query: { redirect: to.fullPath },
      })
    }

    // Check role requirements
    if (to.meta.roles && to.meta.roles.length > 0) {
      if (!authStore.hasRole(to.meta.roles)) {
        // User doesn't have required role, redirect to home
        return next({ name: 'home' })
      }
    }
  }

  // Guest-only routes (redirect authenticated users)
  if (to.meta.guest && authStore.isAuthenticated) {
    return next({ name: 'home' })
  }

  next()
})

export default router
