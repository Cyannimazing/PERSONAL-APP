<template>
  <section class="w-full min-w-0 rounded-xl border border-slate-200/60 bg-white/80 p-6 shadow-sm dark:border-slate-800/70 dark:bg-slate-900/80">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Browse</p>
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Browse Apps</h2>
        <p class="text-sm text-slate-600 dark:text-slate-300">Purchase or request access.</p>
      </div>
      <div class="flex items-center gap-2">
        <Badge variant="secondary">{{ apps.length }}</Badge>
        <NuxtLink to="/apps" class="text-xs font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">
          View all
        </NuxtLink>
      </div>
    </div>

    <div v-if="loading" class="mt-4 grid gap-5 sm:grid-cols-2">
      <Skeleton v-for="n in 4" :key="n" class="h-32 rounded-xl" />
    </div>
    <div v-else class="mt-4 grid gap-5 sm:grid-cols-2">
        <DashboardAppCard v-for="app in apps" :key="app.id" :app="app">
          <Button size="sm" @click="purchase(app.id)">
            {{ Number(app.price) === 0 ? 'Get access' : 'Purchase' }}
          </Button>
        </DashboardAppCard>
    </div>
  </section>
</template>

<script setup lang="ts">
import { Skeleton } from '@/components/ui/skeleton'
import type { ApplicationItem } from '../../stores/applications'

defineProps<{ apps: ApplicationItem[]; purchase: (id: number) => void; loading: boolean }>()
</script>
