import { ref } from 'vue'
import {
  fetchPromotions,
  createPromotion,
  updatePromotion,
  deletePromotion
} from '../services/adminApi'

export function useAdminPromotions() {
  const promotions = ref([])
  const loading = ref(false)
  const error = ref(null)
  const pagination = ref({
    current_page: 1,
    per_page: 10,
    total: 0,
    last_page: 1
  })

  const fetchPromotionsData = async (params = {}) => {
    loading.value = true
    error.value = null
    try {
      const data = await fetchPromotions({
        ...params,
        page: pagination.value.current_page,
        per_page: pagination.value.per_page
      })
      promotions.value = data.data
      pagination.value = data.meta
    } catch (e) {
      error.value = e.message || 'Failed to fetch promotions'
      console.error('Error fetching promotions:', e)
    } finally {
      loading.value = false
    }
  }

  const create = async (promotionData) => {
    loading.value = true
    error.value = null
    try {
      const result = await createPromotion(promotionData)
      await fetchPromotionsData()
      return result
    } catch (e) {
      error.value = e.response?.data?.message || e.message || 'Failed to create promotion'
      throw e
    } finally {
      loading.value = false
    }
  }

  const update = async (id, promotionData) => {
    loading.value = true
    error.value = null
    try {
      const result = await updatePromotion(id, promotionData)
      await fetchPromotionsData()
      return result
    } catch (e) {
      error.value = e.response?.data?.message || e.message || 'Failed to update promotion'
      throw e
    } finally {
      loading.value = false
    }
  }

  const remove = async (id) => {
    loading.value = true
    error.value = null
    try {
      await deletePromotion(id)
      await fetchPromotionsData()
    } catch (e) {
      error.value = e.response?.data?.message || e.message || 'Failed to delete promotion'
      throw e
    } finally {
      loading.value = false
    }
  }

  const setPage = (page) => {
    pagination.value.current_page = page
  }

  return {
    promotions,
    loading,
    error,
    pagination,
    fetchPromotionsData,
    create,
    update,
    remove,
    setPage
  }
}