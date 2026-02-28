<script setup lang="ts">
import { useDashboard } from '../../composables/useDashboard'
import { useAuthStore } from '../../stores/auth'
import { useSeo } from '../../composables/useSeo'
import { 
  LayoutGrid, 
  Package, 
  ArrowUpRight, 
  Settings,
  Rocket,
  Crown,
  ShoppingBag
} from 'lucide-vue-next'

import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Button } from '@/components/ui/button'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import { Skeleton } from '@/components/ui/skeleton'

const { applicationsStore, load, handlePurchase, isLoading } = useDashboard()
const authStore = useAuthStore()
const activeView = ref<string>('browse')

useSeo({ title: 'Dashboard', description: 'Manage your rented apps.', path: '/dashboard' })
definePageMeta({ middleware: 'auth' as any })

onMounted(load)
</script>

<template>
  <div class="w-full space-y-6">
    <!-- Header -->
    <Card>
      <CardHeader>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <CardTitle class="text-2xl">Dashboard</CardTitle>
            <CardDescription>Quick access to your apps and new rentals</CardDescription>
          </div>
          <Button 
            v-if="authStore.user?.role === 'admin'" 
            variant="outline"
            as-child
            class="cursor-pointer"
          >
            <NuxtLink to="/admin" class="flex items-center gap-2">
              <Settings class="h-4 w-4" />
              Admin Panel
            </NuxtLink>
          </Button>
        </div>
      </CardHeader>
    </Card>

    <!-- Stats Cards -->
    <div class="grid gap-4 sm:grid-cols-2">
      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">My Apps</CardTitle>
          <div class="rounded-lg bg-emerald-500/10 p-2 text-emerald-600 dark:text-emerald-400">
            <Crown class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ applicationsStore.mine.length }}</div>
          <p class="mt-1 text-xs text-muted-foreground">Apps you own</p>
        </CardContent>
      </Card>

      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Available</CardTitle>
          <div class="rounded-lg bg-blue-500/10 p-2 text-blue-600 dark:text-blue-400">
            <ShoppingBag class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ applicationsStore.available.length }}</div>
          <p class="mt-1 text-xs text-muted-foreground">Apps to explore</p>
        </CardContent>
      </Card>

      <!-- Quick Launch card removed -->
    </div>

    <!-- Main Content with Tabs -->
    <Card>
      <CardHeader>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <CardTitle class="text-lg font-semibold">App Catalog</CardTitle>
            <CardDescription>Browse available apps or manage your collection</CardDescription>
          </div>
        </div>
      </CardHeader>
      <CardContent>
        <Tabs v-model="activeView" class="w-full">
          <TabsList class="mb-6 grid w-full max-w-md grid-cols-2">
            <TabsTrigger value="browse" class="cursor-pointer">
              Browse Apps
            </TabsTrigger>
            <TabsTrigger value="mine" class="cursor-pointer">
              My Apps
            </TabsTrigger>
          </TabsList>

          <TabsContent value="browse" class="mt-0">
            <div class="mb-4 flex items-center justify-between">
              <p class="text-sm text-muted-foreground">
                {{ applicationsStore.available.length }} apps available for purchase
              </p>
            </div>
            
            <div v-if="isLoading" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
              <Skeleton v-for="n in 6" :key="n" class="h-40 rounded-xl" />
            </div>
            
            <div v-else-if="applicationsStore.available.length === 0" class="flex flex-col items-center justify-center rounded-lg border border-dashed py-12">
              <Package class="h-12 w-12 text-muted-foreground" />
              <h3 class="mt-4 text-lg font-semibold">No apps available</h3>
              <p class="mt-2 text-sm text-muted-foreground">Check back later for new apps</p>
            </div>
            
            <div v-else class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
              <Card 
                v-for="app in applicationsStore.available" 
                :key="app.id"
                class="group relative overflow-hidden transition-all hover:shadow-lg"
              >
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100" />
                <CardHeader class="pb-3">
                  <div class="flex items-start justify-between">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                      <Package class="h-5 w-5 text-primary" />
                    </div>
                    <Badge variant="secondary" class="text-xs">
                      ${{ Number(app.price).toFixed(2) }}
                    </Badge>
                  </div>
                  <CardTitle class="mt-3 text-lg">{{ app.name }}</CardTitle>
                  <CardDescription class="line-clamp-2">
                    {{ app.description || 'No description available' }}
                  </CardDescription>
                </CardHeader>
                <CardContent class="pt-0">
                  <Button 
                    class="w-full cursor-pointer z-10 relative" 
                    @click="handlePurchase(app.id)"
                    :variant="Number(app.price) === 0 ? 'default' : 'secondary'"
                  >
                    {{ Number(app.price) === 0 ? 'Get Free Access' : 'Purchase' }}
                    <ArrowUpRight class="ml-2 h-4 w-4" />
                  </Button>
                </CardContent>
              </Card>
            </div>
          </TabsContent>

          <TabsContent value="mine" class="mt-0">
            <div class="mb-4 flex items-center justify-between">
              <p class="text-sm text-muted-foreground">
                {{ applicationsStore.mine.length }} apps in your collection
              </p>
            </div>
            
            <div v-if="isLoading" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
              <Skeleton v-for="n in 3" :key="n" class="h-40 rounded-xl" />
            </div>
            
            <div v-else-if="applicationsStore.mine.length === 0" class="flex flex-col items-center justify-center rounded-lg border border-dashed py-12">
              <Crown class="h-12 w-12 text-muted-foreground" />
              <h3 class="mt-4 text-lg font-semibold">No apps yet</h3>
              <p class="mt-2 text-sm text-muted-foreground">Browse available apps and get started</p>
              <Button class="mt-4 cursor-pointer" @click="activeView = 'browse'">
                Browse Apps
              </Button>
            </div>
            
            <div v-else class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
              <Card 
                v-for="app in applicationsStore.mine" 
                :key="app.id"
                class="group relative overflow-hidden border-emerald-200 bg-emerald-50/50 transition-all hover:shadow-lg dark:border-emerald-900 dark:bg-emerald-950/20"
              >
                <div class="absolute right-2 top-2">
                  <Badge class="bg-emerald-500 text-white">Owned</Badge>
                </div>
                <CardHeader class="pb-3">
                  <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-500/10">
                    <Crown class="h-5 w-5 text-emerald-600 dark:text-emerald-400" />
                  </div>
                  <CardTitle class="mt-3 text-lg">{{ app.name }}</CardTitle>
                  <CardDescription class="line-clamp-2">
                    {{ app.description || 'No description available' }}
                  </CardDescription>
                </CardHeader>
                <CardContent class="pt-0">
                  <Button 
                    v-if="app.slug === 'hello-world'" 
                    class="w-full cursor-pointer bg-emerald-600 hover:bg-emerald-700"
                    as-child
                  >
                    <NuxtLink :to="`/apps/${app.slug}`" class="flex items-center justify-center gap-2">
                      <Rocket class="h-4 w-4" />
                      Launch App
                    </NuxtLink>
                  </Button>
                  <Button v-else variant="outline" class="w-full" disabled>
                    Coming Soon
                  </Button>
                </CardContent>
              </Card>
            </div>
          </TabsContent>
        </Tabs>
      </CardContent>
    </Card>
  </div>
</template>
