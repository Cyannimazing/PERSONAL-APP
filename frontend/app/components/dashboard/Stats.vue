<template>
  <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2">
    <Card class="w-full rounded-xl">
      <CardHeader class="flex flex-row items-center justify-between pb-2">
        <div>
          <CardDescription>My Apps</CardDescription>
          <CardTitle class="text-2xl">{{ mineCount }}</CardTitle>
        </div>
        <Badge>Owned</Badge>
      </CardHeader>
    </Card>
    <Card class="w-full rounded-xl">
      <CardHeader class="flex flex-row items-center justify-between pb-2">
        <div>
          <CardDescription>Available Apps</CardDescription>
          <CardTitle class="text-2xl">{{ availableCount }}</CardTitle>
        </div>
        <Badge variant="secondary">Browse</Badge>
      </CardHeader>
    </Card>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{ mineCount: number; availableCount: number }>()
</script>
