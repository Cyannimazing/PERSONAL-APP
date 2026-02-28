import { useAuthStore } from '../stores/auth'
import { useAuth } from '../composables/useAuth'

export default defineNuxtPlugin(() => {
  const authStore = useAuthStore()
  const { fetchMe } = useAuth()

  if (process.client) {
    const savedToken = localStorage.getItem('_token')
    const savedUser = localStorage.getItem('_user')

    if (savedToken && savedUser) {
      authStore.user = JSON.parse(savedUser)
      authStore.token = savedToken
    } else if (savedToken) {
      authStore.token = savedToken
      fetchMe().catch(() => {
        authStore.user = null
        authStore.token = ''
      })
    }

    watch(
      () => ({ token: authStore.token, user: authStore.user }),
      (value) => {
        if (value.token && value.user) {
          localStorage.setItem('_token', value.token)
          localStorage.setItem('_user', JSON.stringify(value.user))
        } else {
          localStorage.removeItem('_token')
          localStorage.removeItem('_user')
        }
      },
      { deep: true }
    )
  }
})
