import api from '../api'

// Products
export const fetchProducts = async (params = {}) => {
  const response = await api.get('/api/admin/products', { params })
  return response.data
}

export const fetchProductStats = async () => {
  const response = await api.get('/api/admin/products/stats')
  return response.data
}

export const createProduct = async (data) => {
  const response = await api.post('/api/admin/products', data)
  return response.data
}

export const updateProduct = async (id, data) => {
  const response = await api.put(`/api/admin/products/${id}`, data)
  return response.data
}

export const deleteProduct = async (id) => {
  const response = await api.delete(`/api/admin/products/${id}`)
  return response.data
}

export const uploadProductImage = async (file) => {
  const formData = new FormData()
  formData.append('image', file)
  const response = await api.post('/api/admin/products/upload-image', formData, {
    headers: { 'Content-Type': 'multipart/form-data' }
  })
  return response.data
}

// Orders
export const fetchOrders = async (params = {}) => {
  const response = await api.get('/api/admin/orders', { params })
  return response.data
}

export const fetchOrderStats = async () => {
  const response = await api.get('/api/admin/orders/stats')
  return response.data
}

export const fetchOrder = async (id) => {
  const response = await api.get(`/api/admin/orders/${id}`)
  return response.data
}

export const updateOrderStatus = async (id, data) => {
  const response = await api.patch(`/api/admin/orders/${id}/status`, data)
  return response.data
}

// Customers
export const fetchCustomers = async (params = {}) => {
  const response = await api.get('/api/admin/customers', { params })
  return response.data
}

export const fetchCustomer = async (id) => {
  const response = await api.get(`/api/admin/customers/${id}`)
  return response.data
}

// Promotions
export const fetchPromotions = async (params = {}) => {
  const response = await api.get('/api/admin/promotions', { params })
  return response.data
}

export const createPromotion = async (data) => {
  const response = await api.post('/api/admin/promotions', data)
  return response.data
}

export const updatePromotion = async (id, data) => {
  const response = await api.put(`/api/admin/promotions/${id}`, data)
  return response.data
}

export const deletePromotion = async (id) => {
  const response = await api.delete(`/api/admin/promotions/${id}`)
  return response.data
}