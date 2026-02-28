export const useSeo = (options: {
  title: string
  description: string
  path?: string
  image?: string
}) => {
  const config = useRuntimeConfig()
  const siteUrl = config.public.siteUrl
  const url = `${siteUrl}${options.path || ''}`

  useSeoMeta({
    title: options.title,
    ogTitle: options.title,
    description: options.description,
    ogDescription: options.description,
    ogType: 'website',
    ogUrl: url,
    twitterCard: 'summary_large_image',
    twitterTitle: options.title,
    twitterDescription: options.description,
    ogImage: options.image || `${siteUrl}/og.png`
  })

  useHead({
    link: [{ rel: 'canonical', href: url }]
  })
}
