export const useDashboard = () => {
  const { fetchAvailable, fetchMine, purchase } = useApplications()
  const applicationsStore = useApplicationsStore()
  const isLoading = ref(true)

  const load = async () => {
    isLoading.value = true
    await Promise.all([fetchMine(), fetchAvailable()])
    isLoading.value = false
  }

  const handlePurchase = async (id: number) => {
    await purchase(id)
    await load()
  }

  return { applicationsStore, load, handlePurchase, isLoading }
}
