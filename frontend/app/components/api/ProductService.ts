import APIError from "./APIError"
import BaseAPIService from "./BaseAPIService"

class ProductService extends BaseAPIService {
    // ✅ Get all products
    async getAllProduct() {
        try {
            return await this.request("/api/products", "GET")
        } catch (error: any) {
            if (error instanceof APIError) {
                throw new APIError({ message: "Failed to fetch products" })
            }
        }
    }

    // ✅ View single product
    async getProduct(id: number) {
        try {
            return await this.request(`/api/products/${id}`, "GET")
        } catch (error: any) {
            if (error instanceof APIError) {
                throw new APIError({ message: "Failed to fetch product" })
            }
        }
    }

    // ✅ Create product
    async createProduct(data: object) {
        try {
            return await this.request("/api/products", "POST", data)
        } catch (error: any) {
            if (error instanceof APIError) {
                throw new APIError({ message: "Failed to create product" })
            }
        }
    }

    // ✅ Update product
    async updateProduct(id: number, data: object) {
        try {
            return await this.request(`/api/products/${id}`, "PUT", data)
        } catch (error: any) {
            if (error instanceof APIError) {
                throw new APIError({ message: "Failed to update product" })
            }
        }
    }

    // ✅ Delete product
    async deleteProduct(id: number) {
        try {
            return await this.request(`/api/products/${id}`, "DELETE")
        } catch (error: any) {
            if (error instanceof APIError) {
                throw new APIError({ message: "Failed to delete product" })
            }
        }
    }
}

export default new ProductService()
