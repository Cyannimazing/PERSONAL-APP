<template>
  <div class="flex min-h-[calc(100vh-120px)] items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
      <!-- Header -->
      <div class="mb-8 text-center">
        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-primary text-primary-foreground shadow-lg">
          <UserPlus class="h-8 w-8" />
        </div>
        <h1 class="text-3xl font-bold tracking-tight">Create an account</h1>
        <p class="mt-3 text-base text-muted-foreground">Get started with your free account</p>
      </div>
      
      <!-- Form Card -->
      <div class="rounded-2xl border border-border bg-card p-8 shadow-sm">
        <form class="space-y-5" @submit.prevent="handleSubmit">
          <div class="space-y-2">
            <Label for="name" class="text-sm font-medium">Full name</Label>
            <input 
              id="name"
              v-model="name" 
              placeholder="John Doe" 
              class="flex h-12 w-full rounded-lg border border-border bg-background px-4 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
            />
          </div>
          
          <div class="space-y-2">
            <Label for="email" class="text-sm font-medium">Email</Label>
            <input 
              id="email"
              v-model="email" 
              type="email" 
              placeholder="you@example.com" 
              class="flex h-12 w-full rounded-lg border border-border bg-background px-4 py-2 text-base ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
            />
          </div>
          
          <div class="space-y-2">
            <Label for="password" class="text-sm font-medium">Password</Label>
            <div class="relative">
              <input 
                id="password"
                v-model="password" 
                :type="showPassword ? 'text' : 'password'" 
                placeholder="••••••••" 
                class="flex h-12 w-full rounded-lg border border-border bg-background px-4 py-2 pr-12 text-base ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
              />
              <button 
                type="button" 
                class="absolute right-4 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground cursor-pointer transition-colors"
                @click="showPassword = !showPassword"
              >
                <EyeOff v-if="showPassword" class="h-5 w-5" />
                <Eye v-else class="h-5 w-5" />
              </button>
            </div>
          </div>
          
          <div class="space-y-2">
            <Label for="confirmPassword" class="text-sm font-medium">Confirm password</Label>
            <div class="relative">
              <input 
                id="confirmPassword"
                v-model="confirmPassword" 
                :type="showConfirmPassword ? 'text' : 'password'" 
                placeholder="••••••••" 
                class="flex h-12 w-full rounded-lg border border-border bg-background px-4 py-2 pr-12 text-base ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
              />
              <button 
                type="button" 
                class="absolute right-4 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground cursor-pointer transition-colors"
                @click="showConfirmPassword = !showConfirmPassword"
              >
                <EyeOff v-if="showConfirmPassword" class="h-5 w-5" />
                <Eye v-else class="h-5 w-5" />
              </button>
            </div>
          </div>
          
          <Alert v-if="errorMessage" variant="destructive">
            <AlertCircle class="h-4 w-4" />
            <AlertDescription>{{ errorMessage }}</AlertDescription>
          </Alert>
        
          <button 
            type="submit" 
            class="flex h-12 w-full items-center justify-center gap-2 rounded-lg bg-primary text-base font-semibold text-primary-foreground shadow-sm transition-colors hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 cursor-pointer"
            :disabled="isLoading"
          >
            <span class="flex items-center gap-2">
              <Loader2 v-if="isLoading" class="h-5 w-5 animate-spin" />
              <span>{{ isLoading ? 'Creating account...' : 'Create account' }}</span>
            </span>
          </button>
        </form>
      </div>
      
      <!-- Footer -->
      <p class="mt-8 text-center text-base text-muted-foreground">
        Already have an account? 
        <NuxtLink to="/login" class="font-semibold text-primary hover:underline cursor-pointer">
          Sign in
        </NuxtLink>
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { UserPlus, Eye, EyeOff, AlertCircle, Loader2 } from 'lucide-vue-next'
import { useAuth } from '../../composables/useAuth'
import { useSeo } from '../../composables/useSeo'
import { isEmail, isMinLength } from '../../utils/validators'
const name = ref('')
const email = ref('')
const password = ref('')
const errorMessage = ref('')
const confirmPassword = ref('')
const showPassword = ref(false)
const showConfirmPassword = ref(false)
const isLoading = ref(false)
const { register } = useAuth()

definePageMeta({ middleware: 'guest' as any })
useSeo({ title: 'Register', description: 'Create an account to rent apps.', path: '/register' })

const handleSubmit = async () => {
  errorMessage.value = ''
  if (!name.value.trim()) {
    errorMessage.value = 'Name is required.'
    return
  }
  if (!isEmail(email.value)) {
    errorMessage.value = 'Enter a valid email.'
    return
  }
  if (!isMinLength(password.value, 6)) {
    errorMessage.value = 'Password must be at least 6 characters.'
    return
  }
  if (password.value !== confirmPassword.value) {
    errorMessage.value = 'Passwords do not match.'
    return
  }
  isLoading.value = true
  try {
    await register(name.value, email.value, password.value)
    await navigateTo('/dashboard')
  } catch (error: any) {
    errorMessage.value = error?.message || 'Registration failed'
  } finally {
    isLoading.value = false
  }
}
</script>
