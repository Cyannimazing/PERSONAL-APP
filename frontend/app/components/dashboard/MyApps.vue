<template>
  <section class="w-full min-w-0 h-full rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">My Apps</h2>
        <p class="text-sm text-slate-600 dark:text-slate-300">Apps you already have access to.</p>
      </div>
      <Badge variant="secondary">{{ apps.length }}</Badge>
    </div>

    <div v-if="loading" class="mt-4 grid gap-5 sm:grid-cols-2">
      <div v-for="n in 4" :key="n" class="h-32 rounded-xl border border-slate-200 bg-slate-50 animate-pulse dark:border-slate-800 dark:bg-slate-800/40" />
    </div>
    <div v-else class="mt-4 grid gap-5 sm:grid-cols-2">
      <DashboardAppCard v-for="app in apps" :key="app.id" :app="app">
        <NuxtLink v-if="app.slug === 'hello-world'" to="/apps/hello-world">
          <Button size="sm">Launch</Button>
        </NuxtLink>
      </DashboardAppCard>
      <Card v-if="apps.length === 0" class="p-4">
        <p class="text-sm text-slate-600 dark:text-slate-300">No apps yet. Browse below.</p>
      </Card>
    </div>
  </section>
</template>

<script setup lang="ts">
import type { ApplicationItem } from '../../stores/applications'

defineProps<{ apps: ApplicationItem[]; loading: boolean }>()
</script>
