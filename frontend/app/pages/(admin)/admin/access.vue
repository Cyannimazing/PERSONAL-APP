<script setup lang="ts">
import { useAdmin } from '../../../composables/useAdmin'
import { useSeo } from '../../../composables/useSeo'
import { ShieldCheck, Users, Package } from 'lucide-vue-next'

import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'

const { users, apps, selectedUserId, selectedAppId, expiresAt, errorMessage, load, grant, revoke } = useAdmin()

useSeo({ title: 'Admin Access', description: 'Manage user access.', path: '/admin/access' })
definePageMeta({ middleware: 'admin' as any, layout: 'admin' })

onMounted(load)
</script>

<template>
  <div class="w-full space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-3xl font-bold tracking-tight">Access Control</h1>
        <p class="text-muted-foreground mt-2">Manage user permissions and application access.</p>
      </div>
    </div>

    <!-- Main Content -->
    <div class="grid gap-6 lg:grid-cols-12">
      <!-- Access Form Column -->
      <div class="lg:col-span-4">
        <AdminAccessForm
          v-model:selectedUserId="selectedUserId"
          v-model:selectedAppId="selectedAppId"
          v-model:expiresAt="expiresAt"
          :users="users"
          :apps="apps"
          :errorMessage="errorMessage"
          :grant="grant"
          :revoke="revoke"
        />
      </div>
      
      <!-- Summary Column -->
      <div class="lg:col-span-8">
        <AdminSummary :users="users" :apps="apps" />
      </div>
    </div>
  </div>
</template>
