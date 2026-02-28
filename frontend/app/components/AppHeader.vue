<template>
  <header class="flex items-center justify-between border-b border-slate-200 px-6 py-4 dark:border-slate-800">
    <NuxtLink to="/" class="flex items-center gap-1">
      <img
        src="/LOGO/general-logo.png"
        alt="PersonaHub logo"
        class="h-9 w-9 shrink-0"
        loading="eager"
      />
      <span class="text-lg font-semibold">{{ appName }}</span>
    </NuxtLink>
    <nav class="flex items-center gap-3 text-sm">
      <button
        type="button"
        class="rounded-md border border-slate-200 px-3 py-2 text-xs font-medium text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800"
        @click="toggleTheme"
        :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'"
      >
        {{ isDark ? 'Light' : 'Dark' }}
      </button>
      <NuxtLink to="/dashboard" class="rounded-md px-3 py-2 text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Dashboard</NuxtLink>
      <NuxtLink to="/admin" v-if="authStore.isAdmin" class="rounded-md px-3 py-2 text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Admin</NuxtLink>
      <NuxtLink to="/login" v-if="!authStore.isAuthenticated" class="rounded-md px-3 py-2 text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Login</NuxtLink>
      <button
        v-if="authStore.isAuthenticated"
        class="rounded-md border border-slate-200 px-3 py-2 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800"
        @click="handleLogout"
      >
        Logout
      </button>
    </nav>
  </header>
</template>

<script setup lang="ts">
import { useAuth } from '../composables/useAuth'
import { useAuthStore } from '../stores/auth'

const config = useRuntimeConfig()
const { logout } = useAuth()
const authStore = useAuthStore()
const appName = config.public.appName
const isDark = ref(false)

const applyTheme = (value: boolean) => {
  if (process.client) {
    document.documentElement.classList.toggle('dark', value)
    document.documentElement.style.colorScheme = value ? 'dark' : 'light'
  }
}

const toggleTheme = () => {
  isDark.value = !isDark.value
  if (process.client) {
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light')
  }
  applyTheme(isDark.value)
}

onMounted(() => {
  if (!process.client) return
  const saved = localStorage.getItem('theme')
  if (saved === 'dark') {
    isDark.value = true
  } else if (saved === 'light') {
    isDark.value = false
  } else {
    isDark.value = window.matchMedia('(prefers-color-scheme: dark)').matches
  }
  applyTheme(isDark.value)
})

const handleLogout = async () => {
  await logout()
  await navigateTo('/login')
}
</script>

<style scoped></style>
