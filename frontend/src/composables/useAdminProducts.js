import { ref } from 'vue'
import {
  fetchProducts,
  fetchProductStats,
  createProduct,
  updateProduct,
  deleteProduct,
  uploadProductImage
} from '../services/adminApi'

export function useAdminProducts() {
  const products = ref([])
  const loading = ref(false)
  const error = ref(null)
  const stats = ref({
    total: 0,
    active: 0,
    out_of_stock: 0,
    low_stock: 0
  })
  const pagination = ref({
    current_page: 1,
    per_page: 8,
    total: 0,
    last_page: 1
  })

  const fetchProductsData = async (params = {}) => {
    loading.value = true
    error.value = null
    try {
      const data = await fetchProducts({
        ...params,
        page: pagination.value.current_page,
        per_page: pagination.value.per_page
      })
      products.value = data.data
      pagination.value = data.meta
    } catch (e) {
      error.value = e.message || 'Failed to fetch products'
      console.error('Error fetching products:', e)
    } finally {
      loading.value = false
    }
  }

  const fetchStats = async () => {
    try {
      const data = await fetchProductStats()
      stats.value = data
    } catch (e) {
      console.error('Error fetching stats:', e)
    }
  }

  const create = async (productData) => {
    loading.value = true
    error.value = null
    try {
      const result = await createProduct(productData)
      await fetchProductsData()
      await fetchStats()
      return result
    } catch (e) {
      error.value = e.response?.data?.message || e.message || 'Failed to create product'
      throw e
    } finally {
      loading.value = false
    }
  }

  const update = async (id, productData) => {
    loading.value = true
    error.value = null
    try {
      const result = await updateProduct(id, productData)
      await fetchProductsData()
      await fetchStats()
      return result
    } catch (e) {
      error.value = e.response?.data?.message || e.message || 'Failed to update product'
      throw e
    } finally {
      loading.value = false
    }
  }

  const remove = async (id) => {
    loading.value = true
    error.value = null
    try {
      await deleteProduct(id)
      await fetchProductsData()
      await fetchStats()
    } catch (e) {
      error.value = e.response?.data?.message || e.message || 'Failed to delete product'
      throw e
    } finally {
      loading.value = false
    }
  }

  const uploadImage = async (file) => {
    try {
      return await uploadProductImage(file)
    } catch (e) {
      console.error('Error uploading image:', e)
      throw e
    }
  }

  const setPage = (page) => {
    pagination.value.current_page = page
  }

  return {
    products,
    loading,
    error,
    stats,
    pagination,
    fetchProductsData,
    fetchStats,
    create,
    update,
    remove,
    uploadImage,
    setPage
  }
}