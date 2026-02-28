import { useAuthStore } from '../stores/auth'

export default defineNuxtRouteMiddleware(() => {
  if (!process.client) return
  const authStore = useAuthStore()
  if (authStore.token) {
    return navigateTo('/dashboard')
  }
})
