import { ref } from 'vue'
import { fetchCustomers, fetchCustomer } from '../services/adminApi'

export function useAdminCustomers() {
  const customers = ref([])
  const loading = ref(false)
  const error = ref(null)
  const pagination = ref({
    current_page: 1,
    per_page: 10,
    total: 0,
    last_page: 1
  })

  const fetchCustomersData = async (params = {}) => {
    loading.value = true
    error.value = null
    try {
      const data = await fetchCustomers({
        ...params,
        page: pagination.value.current_page,
        per_page: pagination.value.per_page
      })
      customers.value = data.data
      pagination.value = data.meta
    } catch (e) {
      error.value = e.message || 'Failed to fetch customers'
      console.error('Error fetching customers:', e)
    } finally {
      loading.value = false
    }
  }

  const getCustomer = async (id) => {
    loading.value = true
    error.value = null
    try {
      const data = await fetchCustomer(id)
      return data.data
    } catch (e) {
      error.value = e.message || 'Failed to fetch customer'
      throw e
    } finally {
      loading.value = false
    }
  }

  const setPage = (page) => {
    pagination.value.current_page = page
  }

  return {
    customers,
    loading,
    error,
    pagination,
    fetchCustomersData,
    getCustomer,
    setPage
  }
}