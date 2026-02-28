import APIError from "./APIError"
import BaseAPIService from "./BaseAPIService"

class ApplicationService extends BaseAPIService {
  async available() {
    try {
      return await this.request("/api/user/apps/available", "GET")
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Failed to load apps" })
      }
    }
  }

  async mine() {
    try {
      return await this.request("/api/user/apps/my", "GET")
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Failed to load my apps" })
      }
    }
  }

  async purchase(applicationId: number) {
    try {
      return await this.request("/api/user/apps/purchase", "POST", { application_id: applicationId })
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Purchase failed" })
      }
    }
  }

  async adminUsers() {
    try {
      return await this.request("/api/admin/users", "GET")
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Failed to load users" })
      }
    }
  }

  async adminApps() {
    try {
      return await this.request("/api/admin/apps", "GET")
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Failed to load apps" })
      }
    }
  }

  async grant(userId: number, applicationId: number, expiresAt?: string) {
    try {
      return await this.request("/api/admin/grant", "POST", {
        user_id: userId,
        application_id: applicationId,
        expires_at: expiresAt
      })
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Grant failed" })
      }
    }
  }

  async revoke(userId: number, applicationId: number) {
    try {
      return await this.request("/api/admin/revoke", "POST", {
        user_id: userId,
        application_id: applicationId
      })
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Revoke failed" })
      }
    }
  }
}

export default new ApplicationService()
