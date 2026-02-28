import { useAuthStore } from '../stores/auth'
import AuthService from '../components/api/AuthService'

export const useAuth = () => {
  const authStore = useAuthStore()

  const login = async (email: string, password: string) => {
    const result = await AuthService.login(email, password)
    if (result?.user && result?.token) {
      authStore.user = result.user
      authStore.token = result.token
      localStorage.setItem('_token', result.token)
      localStorage.setItem('_user', JSON.stringify(result.user))
    }
    return result
  }

  const register = async (name: string, email: string, password: string) => {
    const result = await AuthService.register(name, email, password)
    if (result?.user && result?.token) {
      authStore.user = result.user
      authStore.token = result.token
      localStorage.setItem('_token', result.token)
      localStorage.setItem('_user', JSON.stringify(result.user))
    }
    return result
  }

  const logout = async () => {
    await AuthService.logout()
    authStore.user = null
    authStore.token = ''
    localStorage.removeItem('_token')
    localStorage.removeItem('_user')
  }

  const fetchMe = async () => {
    const user = await AuthService.me()
    if (user) {
      authStore.user = user
      localStorage.setItem('_user', JSON.stringify(user))
    }
  }

  return { login, register, logout, fetchMe }
}
