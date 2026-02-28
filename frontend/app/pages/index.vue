<template>
  <section class="relative overflow-hidden rounded-2xl border border-slate-200 bg-gradient-to-br from-slate-50 via-white to-slate-100 px-6 py-12 dark:border-slate-800 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 sm:px-10">
    <div class="absolute right-[-120px] top-[-120px] h-64 w-64 rounded-full bg-slate-200/50 blur-3xl dark:bg-slate-800/60" aria-hidden="true"></div>
    <div class="absolute bottom-[-140px] left-[-140px] h-72 w-72 rounded-full bg-indigo-200/40 blur-3xl dark:bg-indigo-500/20" aria-hidden="true"></div>

    <div class="relative grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
      <div class="space-y-6">
        <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-medium text-slate-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300">
          <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
          Live guest access
        </div>
        <h1 class="text-4xl font-semibold tracking-tight text-slate-900 dark:text-white sm:text-5xl">
          PersonaHub keeps your apps and access in one clean space.
        </h1>
        <p class="max-w-2xl text-base text-slate-600 dark:text-slate-300 sm:text-lg">
          Launch, manage, and personalize app rentals in minutes with a fast, secure, and modern experience.
        </p>
        <div class="flex flex-wrap gap-3">
          <NuxtLink to="/register">
            <Button>Get Started</Button>
          </NuxtLink>
          <NuxtLink to="/login">
            <Button variant="outline">Login</Button>
          </NuxtLink>
        </div>
        <div class="grid gap-4 pt-4 sm:grid-cols-3">
          <div class="rounded-lg border border-slate-200 bg-white/80 p-4 dark:border-slate-800 dark:bg-slate-900/70">
            <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Users onboarded</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white">1.2k+</p>
          </div>
          <div class="rounded-lg border border-slate-200 bg-white/80 p-4 dark:border-slate-800 dark:bg-slate-900/70">
            <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Apps ready</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white">24</p>
          </div>
          <div class="rounded-lg border border-slate-200 bg-white/80 p-4 dark:border-slate-800 dark:bg-slate-900/70">
            <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Avg setup</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white">6 min</p>
          </div>
        </div>
      </div>

      <div class="grid gap-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Today</p>
              <p class="text-lg font-semibold text-slate-900 dark:text-white">Active rentals</p>
            </div>
            <span class="rounded-full bg-emerald-100 px-2 py-1 text-xs font-medium text-emerald-700">+12%</span>
          </div>
          <div class="mt-4 grid gap-3">
            <div class="flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2 dark:border-slate-800">
              <div>
                <p class="text-sm font-medium text-slate-900 dark:text-white">CRM Suite</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">Access ends in 6 days</p>
              </div>
              <span class="text-sm font-semibold text-slate-900 dark:text-white">$29</span>
            </div>
            <div class="flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2 dark:border-slate-800">
              <div>
                <p class="text-sm font-medium text-slate-900 dark:text-white">Invoice AI</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">Access ends in 12 days</p>
              </div>
              <span class="text-sm font-semibold text-slate-900 dark:text-white">$19</span>
            </div>
          </div>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
          <p class="text-sm font-semibold text-slate-900 dark:text-white">Why teams pick PersonaHub</p>
          <ul class="mt-3 space-y-2 text-sm text-slate-600 dark:text-slate-300">
            <li class="flex items-start gap-2">
              <span class="mt-1 h-2 w-2 rounded-full bg-indigo-500"></span>
              Instant provisioning with secure roles.
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-1 h-2 w-2 rounded-full bg-indigo-500"></span>
              Admin controls built for growing teams.
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-1 h-2 w-2 rounded-full bg-indigo-500"></span>
              SEO-ready landing and marketing tooling.
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    <div class="rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900">
      <h3 class="font-semibold">Admin Control</h3>
      <p class="text-sm text-slate-600 dark:text-slate-300">Grant or revoke access for any user without payments.</p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900">
      <h3 class="font-semibold">Instant Access</h3>
      <p class="text-sm text-slate-600 dark:text-slate-300">Users purchase apps in one click and launch instantly.</p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900">
      <h3 class="font-semibold">SEO Ready</h3>
      <p class="text-sm text-slate-600 dark:text-slate-300">Structured data, meta tags, and sitemap support.</p>
    </div>
  </section>
</template>

<script setup lang="ts">
useSeo({
  title: 'PersonaHub',
  description: 'Personal app template with auth, payments, and access control.',
  path: '/'
})

definePageMeta({ name: 'guest-home', middleware: [] as any })
</script>