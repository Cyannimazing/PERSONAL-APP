export const useAdmin = () => {
  const { adminUsers, adminApps, grantAccess, revokeAccess } = useApplications()

  const users = ref<any[]>([])
  const apps = ref<any[]>([])
  const selectedUserId = ref('')
  const selectedAppId = ref('')
  const expiresAt = ref('')
  const errorMessage = ref('')

  const load = async () => {
    users.value = await adminUsers()
    apps.value = await adminApps()
  }

  const grant = async () => {
    errorMessage.value = ''
    if (!selectedUserId.value || !selectedAppId.value) {
      errorMessage.value = 'Select user and app'
      return
    }
    await grantAccess(Number(selectedUserId.value), Number(selectedAppId.value), expiresAt.value || undefined)
  }

  const revoke = async () => {
    errorMessage.value = ''
    if (!selectedUserId.value || !selectedAppId.value) {
      errorMessage.value = 'Select user and app'
      return
    }
    await revokeAccess(Number(selectedUserId.value), Number(selectedAppId.value))
  }

  return {
    users,
    apps,
    selectedUserId,
    selectedAppId,
    expiresAt,
    errorMessage,
    load,
    grant,
    revoke
  }
}
