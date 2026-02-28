<template>
  <Card class="p-4">
    <div class="flex h-full flex-col justify-between gap-4">
      <div>
        <h3 class="font-semibold text-slate-900 dark:text-white">{{ app.name }}</h3>
        <p class="text-sm text-slate-600 dark:text-slate-300">{{ app.description }}</p>
      </div>
      <div class="flex items-center justify-between">
        <Badge variant="secondary">{{ formatCurrency(app.price) }}</Badge>
        <slot />
      </div>
    </div>
  </Card>
</template>

<script setup lang="ts">
import type { ApplicationItem } from '../../stores/applications'
import { formatCurrency } from '../../utils/formatters'

defineProps<{ app: ApplicationItem }>()
</script>
