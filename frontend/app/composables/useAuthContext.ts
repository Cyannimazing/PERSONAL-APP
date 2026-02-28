import { useAuthStore } from '../stores/auth'
import { useAuth } from './useAuth'

export const useAuthContext = () => {
  const authStore = useAuthStore()
  const { fetchMe } = useAuth()

  const getUser = async () => {
    if (!authStore.token) return null
    if (!authStore.user) {
      await fetchMe()
    }
    return authStore.user
  }

  return { authStore, getUser }
}
