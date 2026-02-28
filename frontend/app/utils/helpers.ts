export const safeText = (value: string, fallback = '-') => (value?.trim() ? value : fallback)
