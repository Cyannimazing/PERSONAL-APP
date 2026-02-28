<template>
  <div class="min-h-screen flex flex-col bg-white text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    <AppHeader />
    <main class="mx-auto w-full max-w-7xl flex-1 min-h-0 px-6 pt-6 pb-10 overflow-hidden">
      <slot />
    </main>
  </div>
</template>
