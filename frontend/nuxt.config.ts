export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: ['@pinia/nuxt', '@nuxtjs/tailwindcss'],
  tailwindcss: {
    config: {
      darkMode: 'class'
    }
  },
  app: {
    head: {
      link: [
        { rel: 'icon', type: 'image/png', href: '/LOGO/general-logo.png' },
        { rel: 'apple-touch-icon', href: '/LOGO/general-logo.png' }
      ]
    }
  },

  runtimeConfig: {
    public: {
      apiBaseURL: process.env.NUXT_PUBLIC_API_BASE_URL,
      appName: "PersonaHub",
      siteUrl: process.env.NUXT_PUBLIC_SITE_URL || 'http://localhost:3000'
    }
  },
  imports: { dirs: ["app/composables"] },
  css: ['~/assets/css/tailwind.css']
})
