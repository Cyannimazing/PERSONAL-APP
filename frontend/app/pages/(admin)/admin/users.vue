<script setup lang="ts">
import { useAdmin } from '../../../composables/useAdmin'
import { useSeo } from '../../../composables/useSeo'
import { Users, Mail, Shield, Search } from 'lucide-vue-next'

import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow, TableEmpty } from '@/components/ui/table'
import { Avatar, AvatarFallback } from '@/components/ui/avatar'
import { Input } from '@/components/ui/input'

const { users, load } = useAdmin()
const searchQuery = ref('')

const filteredUsers = computed(() => {
  if (!searchQuery.value) return users.value
  const query = searchQuery.value.toLowerCase()
  return users.value.filter(user => 
    user.name.toLowerCase().includes(query) || 
    user.email.toLowerCase().includes(query)
  )
})

const getInitials = (name: string) => {
  return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2)
}

useSeo({ title: 'Admin Users', description: 'Manage users.', path: '/admin/users' })
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
            <CardTitle class="text-2xl">Users</CardTitle>
            <CardDescription>Manage all registered users and their roles</CardDescription>
          </div>
          <Badge variant="secondary">{{ users.length }} total</Badge>
        </div>
      </CardHeader>
    </Card>

    <!-- Stats -->
    <div class="grid gap-4 sm:grid-cols-3">
      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Total Users</CardTitle>
          <div class="rounded-lg bg-blue-500/10 p-2 text-blue-600 dark:text-blue-400">
            <Users class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ users.length }}</div>
        </CardContent>
      </Card>

      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Admins</CardTitle>
          <div class="rounded-lg bg-purple-500/10 p-2 text-purple-600 dark:text-purple-400">
            <Shield class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ users.filter(u => u.role === 'admin').length }}</div>
        </CardContent>
      </Card>

      <Card class="group transition-all hover:shadow-md">
        <CardHeader class="flex flex-row items-center justify-between pb-2">
          <CardTitle class="text-sm font-medium text-muted-foreground">Regular Users</CardTitle>
          <div class="rounded-lg bg-emerald-500/10 p-2 text-emerald-600 dark:text-emerald-400">
            <Users class="h-4 w-4" />
          </div>
        </CardHeader>
        <CardContent>
          <div class="text-3xl font-bold">{{ users.filter(u => u.role !== 'admin').length }}</div>
        </CardContent>
      </Card>
    </div>

    <!-- Users Table -->
    <Card>
      <CardHeader>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <CardTitle class="flex items-center gap-2">
              <Users class="h-5 w-5 text-muted-foreground" />
              All Users
            </CardTitle>
            <CardDescription>Complete list of registered accounts</CardDescription>
          </div>
          <div class="relative w-full max-w-sm">
            <Search class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
            <Input 
              v-model="searchQuery" 
              placeholder="Search users..." 
              class="pl-9"
            />
          </div>
        </div>
      </CardHeader>
      <CardContent>
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead class="w-[300px]">User</TableHead>
              <TableHead>Email</TableHead>
              <TableHead>Role</TableHead>
              <TableHead class="text-right">Status</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <template v-if="filteredUsers.length">
              <TableRow v-for="user in filteredUsers" :key="user.id" class="group">
                <TableCell>
                  <div class="flex items-center gap-3">
                    <Avatar class="h-10 w-10 border">
                      <AvatarFallback 
                        :class="user.role === 'admin' 
                          ? 'bg-purple-500/10 text-purple-600 dark:text-purple-400' 
                          : 'bg-primary/10 text-primary'"
                        class="text-xs font-medium"
                      >
                        {{ getInitials(user.name) }}
                      </AvatarFallback>
                    </Avatar>
                    <div>
                      <div class="font-medium">{{ user.name }}</div>
                      <div class="text-xs text-muted-foreground">ID: {{ user.id }}</div>
                    </div>
                  </div>
                </TableCell>
                <TableCell>
                  <div class="flex items-center gap-2 text-muted-foreground">
                    <Mail class="h-4 w-4" />
                    {{ user.email }}
                  </div>
                </TableCell>
                <TableCell>
                  <Badge 
                    :variant="user.role === 'admin' ? 'default' : 'secondary'"
                    :class="user.role === 'admin' ? 'bg-purple-600' : ''"
                  >
                    <Shield v-if="user.role === 'admin'" class="mr-1 h-3 w-3" />
                    {{ user.role || 'user' }}
                  </Badge>
                </TableCell>
                <TableCell class="text-right">
                  <Badge variant="secondary" class="bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                    Active
                  </Badge>
                </TableCell>
              </TableRow>
            </template>
            <TableEmpty v-else :colspan="4">
              <div class="flex flex-col items-center gap-2 py-8">
                <Users class="h-10 w-10 text-muted-foreground" />
                <p class="font-medium">No users found</p>
                <p class="text-sm text-muted-foreground">
                  {{ searchQuery ? 'Try a different search term' : 'No users have registered yet' }}
                </p>
              </div>
            </TableEmpty>
          </TableBody>
        </Table>
      </CardContent>
    </Card>
  </div>
</template>
