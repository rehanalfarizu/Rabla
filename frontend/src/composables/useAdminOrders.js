import { ref } from 'vue'
import {
  fetchOrders,
  fetchOrderStats,
  updateOrderStatus
} from '../services/adminApi'

export function useAdminOrders() {
  const orders = ref([])
  const loading = ref(false)
  const error = ref(null)
  const stats = ref({
    total: 0,
    pending: 0,
    processing: 0,
    completed: 0,
    total_revenue: 0
  })
  const pagination = ref({
    current_page: 1,
    per_page: 10,
    total: 0,
    last_page: 1
  })

  const fetchOrdersData = async (params = {}) => {
    loading.value = true
    error.value = null
    try {
      const data = await fetchOrders({
        ...params,
        page: pagination.value.current_page,
        per_page: pagination.value.per_page
      })
      orders.value = data.data
      pagination.value = data.meta
    } catch (e) {
      error.value = e.message || 'Failed to fetch orders'
      console.error('Error fetching orders:', e)
    } finally {
      loading.value = false
    }
  }

  const fetchStats = async () => {
    try {
      const data = await fetchOrderStats()
      stats.value = data
    } catch (e) {
      console.error('Error fetching stats:', e)
    }
  }

  const updateStatus = async (id, statusData) => {
    loading.value = true
    error.value = null
    try {
      const result = await updateOrderStatus(id, statusData)
      await fetchOrdersData()
      await fetchStats()
      return result
    } catch (e) {
      error.value = e.response?.data?.message || e.message || 'Failed to update order status'
      throw e
    } finally {
      loading.value = false
    }
  }

  const setPage = (page) => {
    pagination.value.current_page = page
  }

  return {
    orders,
    loading,
    error,
    stats,
    pagination,
    fetchOrdersData,
    fetchStats,
    updateStatus,
    setPage
  }
}