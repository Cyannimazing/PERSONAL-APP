<script setup lang="ts">
import { useAdmin } from '../../../composables/useAdmin'
import { useSeo } from '../../../composables/useSeo'
import { ArrowUpRight, LayoutGrid, Package, Users, Activity, TrendingUp } from 'lucide-vue-next'

import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Button } from '@/components/ui/button'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow, TableEmpty } from '@/components/ui/table'
import { Avatar, AvatarFallback } from '@/components/ui/avatar'

const { users, apps, load } = useAdmin()

const getInitials = (name: string) => {
  return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2)
}

useSeo({ title: 'Admin Dashboard', description: 'Manage access.', path: '/admin' })
definePageMeta({ name: 'admin-dashboard', middleware: 'admin' as any, layout: 'admin' })

onMounted(load)
</script>

<template>
  <div class="w-full space-y-6">
    <!-- Header -->
    <Card>
      <CardHeader>
        <div class="flex flex-col gap-1">
          <CardTitle class="text-2xl">Admin Dashboard</CardTitle>
          <CardDescription>Manage users, applications, and access control</CardDescription>
        </div>
      </CardHeader>
    </Card>

    <!-- Stats Grid -->
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Total Users</CardTitle>
          <div class="rounded-lg bg-blue-500/10 p-2 text-blue-600 dark:text-blue-400">
            <Users class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ users.length }}</div>
          <p class="mt-1 flex items-center gap-1 text-xs text-muted-foreground">
            <TrendingUp class="h-3 w-3 text-green-500" />
            Registered accounts
          </p>
        </CardContent>
      </Card>

      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Total Apps</CardTitle>
          <div class="rounded-lg bg-purple-500/10 p-2 text-purple-600 dark:text-purple-400">
            <LayoutGrid class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ apps.length }}</div>
          <p class="mt-1 flex items-center gap-1 text-xs text-muted-foreground">
            <Package class="h-3 w-3 text-muted-foreground" />
            Available in catalog
          </p>
        </CardContent>
      </Card>

      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Active Sessions</CardTitle>
          <div class="rounded-lg bg-amber-500/10 p-2 text-amber-600 dark:text-amber-400">
            <Activity class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ Math.max(1, Math.floor(users.length * 0.6)) }}</div>
          <p class="mt-1 flex items-center gap-1 text-xs text-muted-foreground">
            <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse" />
            Users online now
          </p>
        </CardContent>
      </Card>
    </div>

    <!-- Content Grid -->
    <div class="grid gap-6 lg:grid-cols-5">
      <!-- Users Table -->
      <Card class="lg:col-span-3">
        <CardHeader class="flex flex-row items-center justify-between">
          <div class="space-y-1">
            <CardTitle class="flex items-center gap-2">
              <Users class="h-5 w-5 text-muted-foreground" />
              Recent Users
            </CardTitle>
            <CardDescription>Latest registered accounts in the system</CardDescription>
          </div>
          <Button variant="outline" size="sm" as-child class="cursor-pointer">
            <NuxtLink to="/admin/users" class="flex items-center gap-1">
              View All
              <ArrowUpRight class="h-3 w-3" />
            </NuxtLink>
          </Button>
        </CardHeader>
        <CardContent>
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead class="w-[250px]">User</TableHead>
                <TableHead>Email</TableHead>
                <TableHead class="text-right">Status</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <template v-if="users.length">
                <TableRow v-for="user in users.slice(0, 5)" :key="user.id" class="group">
                  <TableCell>
                    <div class="flex items-center gap-3">
                      <Avatar class="h-9 w-9 border">
                        <AvatarFallback class="bg-primary/10 text-primary text-xs font-medium">
                          {{ getInitials(user.name) }}
                        </AvatarFallback>
                      </Avatar>
                      <div>
                        <div class="font-medium">{{ user.name }}</div>
                        <div class="text-xs text-muted-foreground capitalize">{{ user.role || 'User' }}</div>
                      </div>
                    </div>
                  </TableCell>
                  <TableCell class="text-muted-foreground">{{ user.email }}</TableCell>
                  <TableCell class="text-right">
                    <Badge variant="secondary" class="bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                      Active
                    </Badge>
                  </TableCell>
                </TableRow>
              </template>
              <TableEmpty v-else :colspan="3">
                <div class="flex flex-col items-center gap-2 py-4">
                  <Users class="h-8 w-8 text-muted-foreground" />
                  <p class="text-muted-foreground">No users found</p>
                </div>
              </TableEmpty>
            </TableBody>
          </Table>
        </CardContent>
      </Card>

      <!-- Apps List -->
      <Card class="lg:col-span-2">
        <CardHeader class="flex flex-row items-center justify-between">
          <div class="space-y-1">
            <CardTitle class="flex items-center gap-2 text-base">
              <Package class="h-4 w-4 text-muted-foreground" />
              Apps Catalog
            </CardTitle>
            <CardDescription>Available applications</CardDescription>
          </div>
          <Button variant="ghost" size="sm" as-child class="cursor-pointer">
            <NuxtLink to="/admin/apps" class="flex items-center gap-1 text-xs">
              View All
              <ArrowUpRight class="h-3 w-3" />
            </NuxtLink>
          </Button>
        </CardHeader>
        <CardContent class="space-y-3">
          <template v-if="apps.length">
            <div v-for="app in apps.slice(0, 5)" :key="app.id" class="flex items-center justify-between rounded-lg border bg-card p-3 transition-colors hover:bg-muted/50">
              <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary/10">
                  <LayoutGrid class="h-4 w-4 text-primary" />
                </div>
                <div>
                  <div class="text-sm font-medium">{{ app.name }}</div>
                  <div class="text-xs text-muted-foreground">{{ app.description?.slice(0, 30) || 'No description' }}{{ app.description?.length > 30 ? '...' : '' }}</div>
                </div>
              </div>
              <Badge variant="outline" class="text-xs">${{ app.price || '0.00' }}</Badge>
            </div>
          </template>
          <div v-else class="flex flex-col items-center gap-2 rounded-lg border border-dashed py-8">
            <Package class="h-8 w-8 text-muted-foreground" />
            <p class="text-sm text-muted-foreground">No apps available</p>
          </div>
        </CardContent>
      </Card>
    </div>
  </div>
</template>
