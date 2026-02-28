import { useApplicationsStore } from '../stores/applications'
import ApplicationService from '../components/api/ApplicationService'

export const useApplications = () => {
  const appStore = useApplicationsStore()

  const fetchAvailable = async () => {
    const apps = await ApplicationService.available()
    appStore.setAvailable(apps)
    return apps
  }

  const fetchMine = async () => {
    const apps = await ApplicationService.mine()
    appStore.setMine(apps)
    return apps
  }

  const purchase = async (applicationId: number) => {
    return await ApplicationService.purchase(applicationId)
  }

  const adminUsers = async () => {
    return await ApplicationService.adminUsers()
  }

  const adminApps = async () => {
    return await ApplicationService.adminApps()
  }

  const grantAccess = async (userId: number, applicationId: number, expiresAt?: string) => {
    return await ApplicationService.grant(userId, applicationId, expiresAt)
  }

  const revokeAccess = async (userId: number, applicationId: number) => {
    return await ApplicationService.revoke(userId, applicationId)
  }

  return {
    fetchAvailable,
    fetchMine,
    purchase,
    adminUsers,
    adminApps,
    grantAccess,
    revokeAccess
  }
}
