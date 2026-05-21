import { ref } from 'vue'
import api from '../api'

export function useProducts() {
  const products = ref([])
  const product = ref(null)
  const loading = ref(false)
  const error = ref(null)

  async function fetchProducts(params = {}) {
    loading.value = true
    error.value = null
    try {
      const response = await api.get('/api/products', { params })
      products.value = response.data.data || response.data
      return products.value
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to fetch products'
      throw err
    } finally {
      loading.value = false
    }
  }

  async function fetchProduct(id) {
    loading.value = true
    error.value = null
    try {
      const response = await api.get(`/api/products/${id}`)
      product.value = response.data
      return product.value
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to fetch product'
      throw err
    } finally {
      loading.value = false
    }
  }

  async function fetchFeatured() {
    loading.value = true
    error.value = null
    try {
      const response = await api.get('/api/products/featured')
      products.value = response.data.data || response.data
      return products.value
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to fetch featured products'
      throw err
    } finally {
      loading.value = false
    }
  }

  return {
    products,
    product,
    loading,
    error,
    fetchProducts,
    fetchProduct,
    fetchFeatured,
  }
}
