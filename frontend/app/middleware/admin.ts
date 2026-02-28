import { useAuthStore } from '../stores/auth'
import AuthService from '../components/api/AuthService'

export default defineNuxtRouteMiddleware(async (to) => {
  if (!process.client) return
  if (to.path === '/' || to.name === 'guest-home') {
    return
  }
  const authStore = useAuthStore()
  if (!authStore.token) {
    return navigateTo('/login')
  }

  if (!authStore.user) {
    try {
      const user = await AuthService.me()
      if (user) {
        authStore.user = user
      }
    } catch {
      authStore.user = null
      authStore.token = ''
      localStorage.removeItem('_token')
      localStorage.removeItem('_user')
      return navigateTo('/login')
    }
  }

  if (authStore.user?.role !== 'admin') {
    return navigateTo('/dashboard')
  }
})
