<template>
  <Card>
    <CardHeader>
      <CardTitle>Grant Access</CardTitle>
      <CardDescription>Grant application access to a user. You can optionally set an expiration date.</CardDescription>
    </CardHeader>
    <CardContent class="grid gap-6">
      <div class="grid gap-2">
        <Label>Select User</Label>
        <Select v-model="selectedUserId">
          <SelectTrigger>
            <SelectValue placeholder="Select a user" />
          </SelectTrigger>
          <SelectContent>
            <SelectItem v-for="user in users" :key="user.id" :value="String(user.id)">
              {{ user.name }} ({{ user.email }})
            </SelectItem>
          </SelectContent>
        </Select>
      </div>

      <div class="grid gap-2">
        <Label>Select App</Label>
        <Select v-model="selectedAppId">
          <SelectTrigger>
            <SelectValue placeholder="Select an app" />
          </SelectTrigger>
          <SelectContent>
            <SelectItem v-for="app in apps" :key="app.id" :value="String(app.id)">
              {{ app.name }}
            </SelectItem>
          </SelectContent>
        </Select>
      </div>

      <div class="grid gap-2">
        <Label>Expires At (Optional)</Label>
        <Input v-model="expiresAt" type="date" />
      </div>

      <Alert v-if="errorMessage" variant="destructive">
        <AlertCircle class="h-4 w-4" />
        <AlertDescription>{{ errorMessage }}</AlertDescription>
      </Alert>

      <div class="flex flex-col gap-3 pt-2 sm:flex-row">
        <Button @click="grant" class="flex-1 cursor-pointer">
          <CheckCircle2 class="mr-2 h-4 w-4" />
          Grant Access
        </Button>
        <Button variant="outline" @click="revoke" class="flex-1 text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-950/20 cursor-pointer">
          <XCircle class="mr-2 h-4 w-4" />
          Revoke Access
        </Button>
      </div>
    </CardContent>
  </Card>
</template>

<script setup lang="ts">
import { CheckCircle2, XCircle, AlertCircle } from 'lucide-vue-next'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Button } from '@/components/ui/button'
import { Alert, AlertDescription } from '@/components/ui/alert'

defineProps<{
  users: any[]
  apps: any[]
  errorMessage: string
  grant: () => void
  revoke: () => void
}>()

const selectedUserId = defineModel<string>('selectedUserId')
const selectedAppId = defineModel<string>('selectedAppId')
const expiresAt = defineModel<string>('expiresAt')
</script>
