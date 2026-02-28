<template>
  <div class="grid gap-6 md:grid-cols-2">
    <!-- Users Card -->
    <Card>
      <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
        <CardTitle class="text-sm font-medium">Users</CardTitle>
        <Users class="h-4 w-4 text-muted-foreground" />
      </CardHeader>
      <CardContent>
        <div class="text-2xl font-bold">{{ users.length }}</div>
        <p class="text-xs text-muted-foreground mb-4">Registered active users</p>
        
        <div class="space-y-4">
          <div v-for="user in users" :key="user.id" class="flex items-center gap-4">
            <Avatar class="h-9 w-9">
              <AvatarFallback>{{ user.name.substring(0, 2).toUpperCase() }}</AvatarFallback>
            </Avatar>
            <div class="space-y-1">
              <p class="text-sm font-medium leading-none">{{ user.name }}</p>
              <p class="text-xs text-muted-foreground">{{ user.email }}</p>
            </div>
          </div>
        </div>
      </CardContent>
    </Card>

    <!-- Apps Card -->
    <Card>
      <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
        <CardTitle class="text-sm font-medium">Apps</CardTitle>
        <Package class="h-4 w-4 text-muted-foreground" />
      </CardHeader>
      <CardContent>
        <div class="text-2xl font-bold">{{ apps.length }}</div>
        <p class="text-xs text-muted-foreground mb-4">Available applications</p>

        <div class="space-y-4">
          <div v-for="app in apps" :key="app.id" class="flex items-center gap-4">
            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-secondary">
              <Component class="h-5 w-5 text-foreground" />
            </div>
            <div class="space-y-1">
              <p class="text-sm font-medium leading-none">{{ app.name }}</p>
              <p class="text-xs text-muted-foreground">App ID: {{ app.id }}</p>
            </div>
          </div>
        </div>
      </CardContent>
    </Card>
  </div>
</template>

<script setup lang="ts">
import { Users, Package, Component } from 'lucide-vue-next'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Avatar, AvatarFallback } from '@/components/ui/avatar'

defineProps<{ users: any[]; apps: any[] }>()
</script>
