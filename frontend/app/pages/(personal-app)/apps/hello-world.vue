<template>
  <Card class="max-w-xl p-6">
    <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Hello World</h1>
    <p class="mb-6 text-sm text-slate-600 dark:text-slate-300">Sample app template.</p>
    <Button @click="handleClick">Click me</Button>
  </Card>
</template>

<script setup lang="ts">
import { useSeo } from '../../../composables/useSeo'

useSeo({ title: 'Hello World', description: 'Sample Hello World app.', path: '/apps/hello-world' })
definePageMeta({ middleware: 'auth' as any })

useHead({
  script: [
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'SoftwareApplication',
        name: 'Hello World',
        applicationCategory: 'BusinessApplication',
        operatingSystem: 'Web',
        offers: {
          '@type': 'Offer',
          price: '0.00',
          priceCurrency: 'USD'
        }
      })
    }
  ]
})

const handleClick = () => {
  alert('Hello World!')
}
</script>
