<script setup>
import { ref, computed, onMounted } from 'vue'
import AdminSidebar from '../layouts/AdminSidebar.vue'

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
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString('id-ID', options)
}

// Summary Metrics Data
const summaryCards = [
  { title: 'Total Customers', value: '1,284', change: '+12.5%', isUp: true },
  { title: 'New Customers', value: '142', change: '+8.2%', isUp: true },
  { title: 'Active Customers', value: '986', change: '-2.4%', isUp: false },
  { title: 'Returning Customers', value: '64%', change: '+4.1%', isUp: true }
]

// Dynamic Data from LocalStorage
const customers = ref([])

onMounted(() => {
  const allProfiles = JSON.parse(localStorage.getItem('user_profiles') || '{}')
  const profilesArray = Object.values(allProfiles)
  
  customers.value = profilesArray.map((user, index) => {
    // Defaulting missing fields for demonstration purposes
    return {
      id: index + 1,
      name: user.name || user.fullName || 'Unknown User',
      email: user.email || 'No Email',
      phone: user.phone || 'No Phone',
      totalOrders: user.totalOrders || Math.floor(Math.random() * 10), // random if not exist
      totalSpend: user.totalSpend || Math.floor(Math.random() * 2000000), // random if not exist
      status: 'Active',
      segment: 'New',
      joinedAt: user.createdAt || new Date().toISOString()
    }
  })
})

// Filter & Search State
const searchQuery = ref('')
const selectedStatus = ref('All')
const selectedSegment = ref('All')

// Pagination State
const currentPage = ref(1)
const itemsPerPage = 8

// Computed Filtered Data
const filteredCustomers = computed(() => {
  return customers.value.filter(customer => {
    const matchSearch = customer.name.toLowerCase().includes(searchQuery.value.toLowerCase()) || 
                        customer.email.toLowerCase().includes(searchQuery.value.toLowerCase())
    const matchStatus = selectedStatus.value === 'All' || customer.status === selectedStatus.value
    const matchSegment = selectedSegment.value === 'All' || customer.segment === selectedSegment.value
    return matchSearch && matchStatus && matchSegment
  })
})

const totalPages = computed(() => Math.ceil(filteredCustomers.value.length / itemsPerPage))

const paginatedCustomers = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredCustomers.value.slice(start, end)
})

const prevPage = () => {
  if (currentPage.value > 1) currentPage.value--
}

const nextPage = () => {
  if (currentPage.value < totalPages.value) currentPage.value++
}
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex">
    <AdminSidebar :sidebar-open="sidebarOpen" @toggle="toggleSidebar" />

    <main class="flex-1 transition-all duration-300" :style="{ marginLeft: sidebarOpen ? '250px' : '80px' }">
      <div class="p-6 lg:p-8">
        
        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-gray-900">Customers</h1>
          <p class="text-sm text-gray-500 mt-1">Manage your store's customers and their activity.</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div v-for="(card, index) in summaryCards" :key="index" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-medium text-gray-500">{{ card.title }}</h3>
            <div class="mt-2 flex items-baseline gap-2">
              <span class="text-3xl font-bold text-gray-900">{{ card.value }}</span>
              <span class="text-sm font-medium" :class="card.isUp ? 'text-green-600' : 'text-red-600'">
                {{ card.change }}
              </span>
            </div>
          </div>
        </div>

        <!-- Main Content Area -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          
          <!-- Search & Filter Bar -->
          <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
            <div class="relative max-w-sm w-full">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>
              <input 
                v-model="searchQuery" 
                type="text" 
                class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-gray-300 focus:ring-1 focus:ring-gray-300 sm:text-sm transition-colors" 
                placeholder="Search by name or email" 
              />
            </div>

            <div class="flex items-center gap-3">
              <select v-model="selectedStatus" class="block w-full pl-3 pr-10 py-2 text-base border-gray-200 bg-gray-50 focus:outline-none focus:ring-gray-300 focus:border-gray-300 sm:text-sm rounded-lg transition-colors border">
                <option value="All">All Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>

              <select v-model="selectedSegment" class="block w-full pl-3 pr-10 py-2 text-base border-gray-200 bg-gray-50 focus:outline-none focus:ring-gray-300 focus:border-gray-300 sm:text-sm rounded-lg transition-colors border">
                <option value="All">All Segments</option>
                <option value="New">New</option>
                <option value="Returning">Returning</option>
                <option value="Loyal">Loyal</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
          </div>

          <!-- Table -->
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orders</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Spend</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined Date</th>
                  <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="customer in paginatedCustomers" :key="customer.id" class="hover:bg-gray-50 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 font-bold uppercase">
                          {{ customer.name.charAt(0) }}
                        </div>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">{{ customer.name }}</div>
                        <div class="text-sm text-gray-500">{{ customer.segment }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ customer.email }}</div>
                    <div class="text-sm text-gray-500">{{ customer.phone }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ customer.totalOrders }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ formatCurrency(customer.totalSpend) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span 
                      class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                      :class="customer.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600'"
                    >
                      {{ customer.status }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ formatDate(customer.joinedAt) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-gray-900 hover:text-gray-700 hover:bg-gray-100 border border-gray-200 px-4 py-1.5 rounded-lg transition-colors">
                      View
                    </button>
                  </td>
                </tr>
                <tr v-if="paginatedCustomers.length === 0">
                  <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    No customers found matching your criteria.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="bg-white px-4 py-3 border-t border-gray-200 flex items-center justify-between sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
              <div>
                <p class="text-sm text-gray-700">
                  Showing
                  <span class="font-medium">{{ filteredCustomers.length > 0 ? (currentPage - 1) * itemsPerPage + 1 : 0 }}</span>
                  to
                  <span class="font-medium">{{ Math.min(currentPage * itemsPerPage, filteredCustomers.length) }}</span>
                  of
                  <span class="font-medium">{{ filteredCustomers.length }}</span>
                  results
                </p>
              </div>
              <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                  <button 
                    @click="prevPage" 
                    :disabled="currentPage === 1"
                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                  >
                    <span class="sr-only">Previous</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                    Page {{ currentPage }} of {{ totalPages || 1 }}
                  </span>
                  <button 
                    @click="nextPage"
                    :disabled="currentPage === totalPages || totalPages === 0"
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
            <!-- Mobile Pagination -->
            <div class="flex items-center justify-between sm:hidden w-full">
              <button @click="prevPage" :disabled="currentPage === 1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 transition-colors">
                Previous
              </button>
              <span class="text-sm text-gray-700">Page {{ currentPage }} of {{ totalPages || 1 }}</span>
              <button @click="nextPage" :disabled="currentPage === totalPages || totalPages === 0" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 transition-colors">
                Next
              </button>
            </div>
          </div>

        </div>
      </div>
    </main>
  </div>
</template>
