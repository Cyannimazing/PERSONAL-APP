import APIError from "./APIError"
import BaseAPIService from "./BaseAPIService"

class AuthService extends BaseAPIService {
  async login(email: string, password: string) {
    try {
      return await this.request("/api/auth/login", "POST", { email, password })
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Login failed" })
      }
    }
  }

  async register(name: string, email: string, password: string) {
    try {
      return await this.request("/api/auth/register", "POST", { name, email, password })
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Registration failed" })
      }
    }
  }

  async logout() {
    try {
      return await this.request("/api/auth/logout", "POST")
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Logout failed" })
      }
    }
  }

  async me() {
    try {
      return await this.request("/api/auth/me", "GET")
    } catch (error: any) {
      if (error instanceof APIError) {
        throw new APIError({ message: "Failed to fetch user" })
      }
    }
  }
}

export default new AuthService()
