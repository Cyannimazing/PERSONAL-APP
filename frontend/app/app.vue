<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>

<script setup lang="ts">
const config = useRuntimeConfig()

useSeoMeta({
  title: config.public.appName,
  ogTitle: config.public.appName,
  description: 'PersonaHub personal app template with auth, access control, and apps.',
  ogDescription: 'PersonaHub personal app template with auth, access control, and apps.',
  ogType: 'website',
  twitterCard: 'summary_large_image'
})
</script>

<style scoped></style>
