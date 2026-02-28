import { defineStore } from 'pinia'

export interface ApplicationItem {
  id: number
  name: string
  slug: string
  description: string
  icon: string | null
  price: number
}

export const useApplicationsStore = defineStore('applications', {
  state: () => ({
    available: [] as ApplicationItem[],
    mine: [] as ApplicationItem[]
  }),
  actions: {
    setAvailable(apps: ApplicationItem[]) {
      this.available = apps
    },
    setMine(apps: ApplicationItem[]) {
      this.mine = apps
    }
  }
})
