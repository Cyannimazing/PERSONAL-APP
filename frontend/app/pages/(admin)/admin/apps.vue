<script setup lang="ts">
import { useAdmin } from '../../../composables/useAdmin'
import { useSeo } from '../../../composables/useSeo'
import { Package, LayoutGrid, Search, DollarSign } from 'lucide-vue-next'

import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow, TableEmpty } from '@/components/ui/table'
import { Input } from '@/components/ui/input'

const { apps, load } = useAdmin()
const searchQuery = ref('')

const filteredApps = computed(() => {
  if (!searchQuery.value) return apps.value
  const query = searchQuery.value.toLowerCase()
  return apps.value.filter(app => 
    app.name.toLowerCase().includes(query) || 
    app.description?.toLowerCase().includes(query)
  )
})

useSeo({ title: 'Admin Apps', description: 'Manage apps.', path: '/admin/apps' })
definePageMeta({ middleware: 'admin' as any, layout: 'admin' })

onMounted(load)
</script>

<template>
  <div class="w-full space-y-6">
    <!-- Header -->
    <Card>
      <CardHeader>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <CardTitle class="text-2xl">Apps</CardTitle>
            <CardDescription>Manage application catalog</CardDescription>
          </div>
          <Badge variant="secondary">{{ apps.length }} total</Badge>
        </div>
      </CardHeader>
    </Card>

    <!-- Stats -->
    <div class="grid gap-4 sm:grid-cols-3">
      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Total Apps</CardTitle>
          <div class="rounded-lg bg-purple-500/10 p-2 text-purple-600 dark:text-purple-400">
            <LayoutGrid class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ apps.length }}</div>
        </CardContent>
      </Card>

      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Free Apps</CardTitle>
          <div class="rounded-lg bg-emerald-500/10 p-2 text-emerald-600 dark:text-emerald-400">
            <Package class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ apps.filter(a => Number(a.price) === 0).length }}</div>
        </CardContent>
      </Card>

      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Paid Apps</CardTitle>
          <div class="rounded-lg bg-amber-500/10 p-2 text-amber-600 dark:text-amber-400">
            <DollarSign class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ apps.filter(a => Number(a.price) > 0).length }}</div>
        </CardContent>
      </Card>
    </div>

    <!-- Apps Table -->
    <Card>
      <CardHeader>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <CardTitle class="flex items-center gap-2">
              <Package class="h-5 w-5 text-muted-foreground" />
              All Apps
            </CardTitle>
            <CardDescription>Complete list of applications in catalog</CardDescription>
          </div>
          <div class="relative w-full max-w-sm">
            <Search class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
            <Input 
              v-model="searchQuery" 
              placeholder="Search apps..." 
              class="pl-9"
            />
          </div>
        </div>
      </CardHeader>
      <CardContent>
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead class="w-[300px]">App</TableHead>
              <TableHead>Description</TableHead>
              <TableHead class="text-right">Price</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <template v-if="filteredApps.length">
              <TableRow v-for="app in filteredApps" :key="app.id" class="group">
                <TableCell>
                  <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                      <LayoutGrid class="h-5 w-5 text-primary" />
                    </div>
                    <div>
                      <div class="font-medium">{{ app.name }}</div>
                      <div class="text-xs text-muted-foreground">ID: {{ app.id }}</div>
                    </div>
                  </div>
                </TableCell>
                <TableCell class="max-w-xs truncate text-muted-foreground">
                  {{ app.description || 'No description' }}
                </TableCell>
                <TableCell class="text-right">
                  <Badge 
                    :variant="Number(app.price) === 0 ? 'secondary' : 'default'"
                    :class="Number(app.price) === 0 ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : ''"
                  >
                    {{ Number(app.price) === 0 ? 'Free' : `$${Number(app.price).toFixed(2)}` }}
                  </Badge>
                </TableCell>
              </TableRow>
            </template>
            <TableEmpty v-else :colspan="3">
              <div class="flex flex-col items-center gap-2 py-8">
                <Package class="h-10 w-10 text-muted-foreground" />
                <p class="font-medium">No apps found</p>
                <p class="text-sm text-muted-foreground">
                  {{ searchQuery ? 'Try a different search term' : 'No apps in catalog yet' }}
                </p>
              </div>
            </TableEmpty>
          </TableBody>
        </Table>
      </CardContent>
    </Card>
  </div>
</template>
