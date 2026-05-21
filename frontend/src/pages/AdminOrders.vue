<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import AdminSidebar from '../layouts/AdminSidebar.vue'
import { useAdminOrders } from '../composables/useAdminOrders'

const {
  orders,
  loading,
  stats,
  pagination,
  fetchOrdersData,
  fetchStats,
  updateStatus,
  setPage
} = useAdminOrders()

const sidebarOpen = ref(true)
const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value
}

// Formatters
const formatCurrency = (value) => {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
  }).format(value)
}

const formatDate = (dateString) => {
  if (!dateString) return '-'
  const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }
  return new Date(dateString).toLocaleDateString('id-ID', options)
}

// Filter & Search State
const activeTab = ref('All')
const tabs = ['All', 'Processing', 'Shipped', 'Completed', 'Cancelled']

const searchQuery = ref('')
const selectedPayment = ref('All Payment Status')

// Map API status to display status
const mapStatus = (status) => {
  const statusMap = {
    'pending': 'Processing',
    'confirmed': 'Processing',
    'processing': 'Processing',
    'shipped': 'Shipped',
    'delivered': 'Completed',
    'cancelled': 'Cancelled',
    'returned': 'Cancelled'
  }
  return statusMap[status?.toLowerCase()] || status || 'Processing'
}

const mapPaymentStatus = (status) => {
  const statusMap = {
    'pending': 'Pending',
    'paid': 'Paid',
    'failed': 'Failed',
    'refunded': 'Failed'
  }
  return statusMap[status?.toLowerCase()] || status || 'Pending'
}

// Load data
onMounted(async () => {
  await Promise.all([fetchOrdersData(), fetchStats()])
})

// Watch for search/filter changes
watch([searchQuery, activeTab, selectedPayment], () => {
  setPage(1)
  fetchOrdersData({
    search: searchQuery.value,
    status: activeTab.value !== 'All' ? activeTab.value : undefined,
    payment_status: selectedPayment.value !== 'All Payment Status' ? selectedPayment.value : undefined
  })
})

// Metrics from API
const totalOrdersCount = computed(() => stats.value.total || 0)
const pendingOrdersCount = computed(() => stats.value.pending + stats.value.processing || 0)
const completedOrdersCount = computed(() => stats.value.completed || 0)
const totalRevenue = computed(() => stats.value.total_revenue || 0)

const totalPages = computed(() => pagination.value.last_page)

const prevPage = () => {
  if (pagination.value.current_page > 1) {
    setPage(pagination.value.current_page - 1)
    fetchOrdersData({
      search: searchQuery.value,
      status: activeTab.value !== 'All' ? activeTab.value : undefined,
      payment_status: selectedPayment.value !== 'All Payment Status' ? selectedPayment.value : undefined
    })
  }
}

const nextPage = () => {
  if (pagination.value.current_page < totalPages.value) {
    setPage(pagination.value.current_page + 1)
    fetchOrdersData({
      search: searchQuery.value,
      status: activeTab.value !== 'All' ? activeTab.value : undefined,
      payment_status: selectedPayment.value !== 'All Payment Status' ? selectedPayment.value : undefined
    })
  }
}

// Badge coloring helpers
const getPaymentBadgeClass = (status) => {
  switch (status) {
    case 'Paid': return 'bg-green-100 text-green-800'
    case 'Pending': return 'bg-yellow-100 text-yellow-800'
    case 'Failed': return 'bg-red-100 text-red-800'
    default: return 'bg-gray-100 text-gray-800'
  }
}

const getOrderBadgeClass = (status) => {
  switch (status) {
    case 'Processing': return 'bg-blue-100 text-blue-800'
    case 'Shipped': return 'bg-purple-100 text-purple-800'
    case 'Completed': return 'bg-green-100 text-green-800'
    case 'Cancelled': return 'bg-red-100 text-red-800'
    default: return 'bg-gray-100 text-gray-800'
  }
}

const updateOrderStatusHandler = async (order, newStatus) => {
  try {
    const apiStatus = newStatus.toLowerCase()
    await updateStatus(order.id, { status: apiStatus })
    order.status = newStatus
  } catch (e) {
    alert('Failed to update order status')
    // Revert on failure
    fetchOrdersData()
  }
}

const getCustomerName = (order) => {
  return order.customer?.name || order.customer_name || order.user?.name || 'Unknown'
}
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex">
    <AdminSidebar :sidebar-open="sidebarOpen" @toggle="toggleSidebar" />

    <main class="flex-1 transition-all duration-300 transform" :style="{ marginLeft: sidebarOpen ? '250px' : '80px' }">
      <div class="p-6 lg:p-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Orders</h1>
            <p class="text-sm text-gray-500 mt-1">Check and manage recent customer orders.</p>
          </div>
          <button class="inline-flex items-center justify-center bg-gray-900 hover:bg-gray-800 text-white rounded-xl px-5 py-2.5 text-sm font-medium transition-colors shadow-sm whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
            Export CSV
          </button>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500">Total Orders</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ totalOrdersCount }}</h3>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500">Pending Orders</p>
            <h3 class="text-3xl font-bold text-yellow-600 mt-2">{{ pendingOrdersCount }}</h3>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500">Completed Orders</p>
            <h3 class="text-3xl font-bold text-green-600 mt-2">{{ completedOrdersCount }}</h3>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500">Total Revenue</p>
            <h3 class="text-3xl font-bold text-blue-600 mt-2">{{ formatCurrency(totalRevenue) }}</h3>
          </div>
        </div>

        <!-- Main Content Area -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

          <!-- Filters & Search Header -->
          <div class="border-b border-gray-100">

            <!-- Tabs -->
            <div class="px-6 pt-4">
              <nav class="flex space-x-4 border-b border-gray-100 overflow-x-auto pb-px" aria-label="Tabs">
                <button
                  v-for="tab in tabs"
                  :key="tab"
                  @click="activeTab = tab; currentPage = 1"
                  :class="[
                    activeTab === tab
                      ? 'border-gray-900 text-gray-900 bg-gray-50 font-semibold'
                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                    'whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm rounded-t-lg transition-colors'
                  ]"
                >
                  {{ tab }}
                </button>
              </nav>
            </div>

            <!-- Inputs -->
            <div class="p-6 flex flex-col sm:flex-row sm:items-center gap-4 justify-between bg-gray-50">
              <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </div>
                <input
                  v-model="searchQuery"
                  type="text"
                  class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-1 focus:ring-gray-300 sm:text-sm transition-colors"
                  placeholder="Search order ID or customer"
                />
              </div>

              <div class="flex items-center gap-3 w-full sm:w-auto">
                <select v-model="selectedPayment" class="block w-full sm:w-48 pl-3 pr-8 py-2 text-base border-gray-200 bg-white focus:outline-none focus:ring-gray-300 focus:border-gray-300 sm:text-sm rounded-lg transition-colors border">
                  <option value="All Payment Status">All Payment Status</option>
                  <option value="Paid">Paid</option>
                  <option value="Pending">Pending</option>
                  <option value="Failed">Failed</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Loading State -->
          <div v-if="loading" class="p-8 text-center text-gray-500">
            <svg class="animate-spin h-8 w-8 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="mt-2">Loading orders...</p>
          </div>

          <!-- Table -->
          <div v-else class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="order in orders" :key="order.id" class="hover:bg-gray-50 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="text-sm font-semibold text-gray-900 border-b border-gray-900">#{{ order.order_number }}</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ getCustomerName(order) }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ formatDate(order.created_at) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                    {{ formatCurrency(order.total) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full" :class="getPaymentBadgeClass(mapPaymentStatus(order.payment_status))">
                      {{ mapPaymentStatus(order.payment_status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full" :class="getOrderBadgeClass(mapStatus(order.status))">
                      {{ mapStatus(order.status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex items-center justify-end gap-3">
                      <!-- Dropdown to Update Status -->
                      <select
                        :value="mapStatus(order.status)"
                        @change="updateOrderStatusHandler(order, $event.target.value)"
                        class="text-xs bg-white border border-gray-200 rounded-md py-1 pl-2 pr-6 text-gray-700 outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300"
                        title="Update Status"
                      >
                        <option value="Processing">Processing</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                      </select>

                      <!-- View Button -->
                      <button class="text-gray-500 hover:text-blue-600 p-1.5 rounded-lg transition-colors hover:bg-blue-50" title="View Details">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr v-if="orders.length === 0">
                  <td colspan="7" class="px-6 py-8 text-center text-gray-500 bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    No orders found matching your search or filters.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div v-if="!loading" class="bg-white px-4 py-3 border-t border-gray-200 flex items-center justify-between sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
              <div>
                <p class="text-sm text-gray-700">
                  Showing
                  <span class="font-medium">{{ pagination.total > 0 ? (pagination.current_page - 1) * pagination.per_page + 1 : 0 }}</span>
                  to
                  <span class="font-medium">{{ Math.min(pagination.current_page * pagination.per_page, pagination.total) }}</span>
                  of
                  <span class="font-medium">{{ pagination.total }}</span>
                  orders
                </p>
              </div>
              <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                  <button
                    @click="prevPage"
                    :disabled="pagination.current_page === 1"
                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                  >
                    <span class="sr-only">Previous</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                    Page {{ pagination.current_page }} of {{ totalPages || 1 }}
                  </span>
                  <button
                    @click="nextPage"
                    :disabled="pagination.current_page === totalPages || totalPages === 0"
                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                  >
                    <span class="sr-only">Next</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </nav>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>
  </div>
</template>