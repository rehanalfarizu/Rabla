<script setup>
import { ref, computed } from 'vue'
import AdminSidebar from '../layouts/AdminSidebar.vue'

// Modal State
const showPromoModal = ref(false)

const createEmptyPromo = () => ({
  name: '', type: 'Discount', code: '', value: '', valueType: 'fixed',
  expiryDate: '', status: 'Active', usageLimit: ''
})

const promoForms = ref([createEmptyPromo()])

const addPromoForm = () => promoForms.value.push(createEmptyPromo())
const removePromoForm = (i) => { if (promoForms.value.length > 1) promoForms.value.splice(i, 1) }

const openPromoModal = () => {
  promoForms.value = [createEmptyPromo()]
  showPromoModal.value = true
}
const closePromoModal = () => { showPromoModal.value = false }

const submitPromos = () => {
  const newPromos = promoForms.value.map((f, idx) => ({
    id: promotions.value.length + idx + 1,
    name: f.name, type: f.type,
    code: f.code || null,
    value: f.type === 'Free Shipping' ? 0 : f.valueType === 'percent' ? `${f.value}%` : Number(f.value),
    usage: 0,
    expiryDate: f.expiryDate,
    status: f.status
  }))
  promotions.value.push(...newPromos)
  closePromoModal()
}

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

const formatDiscountValue = (promo) => {
  if (promo.type === 'Free Shipping') return 'Gratis Ongkir'
  if (typeof promo.value === 'string' && promo.value.includes('%')) return promo.value
  return formatCurrency(promo.value) // If it's pure number, assume Rp
}

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }
  return new Date(dateString).toLocaleDateString('id-ID', options)
}

// Dummy Promotion Data
const promotions = ref([
  { id: 1, name: 'Ramadhan Mega Sale', type: 'Discount', code: null, value: 50000, usage: 1450, expiryDate: '2024-04-15T23:59:00', status: 'Active' },
  { id: 2, name: 'Welcome Bonus', type: 'Coupon', code: 'NEWUSER24', value: '10%', usage: 342, expiryDate: '2024-12-31T23:59:00', status: 'Active' },
  { id: 3, name: 'Flash Sale Elektronik', type: 'Discount', code: 'FLASHX', value: 100000, usage: 0, expiryDate: '2024-05-01T12:00:00', status: 'Scheduled' },
  { id: 4, name: 'Gratis Ongkir Lebaran', type: 'Free Shipping', code: 'ONGKIRFREE', value: 0, usage: 2100, expiryDate: '2024-04-20T23:59:00', status: 'Active' },
  { id: 5, name: 'Harbolnas 11.11', type: 'Discount', code: 'HARBOLNAS', value: '50%', usage: 5000, expiryDate: '2023-11-12T00:00:00', status: 'Expired' },
  { id: 6, name: 'Birthday Treat', type: 'Coupon', code: 'BDAYVIP', value: 25000, usage: 12, expiryDate: '2024-12-31T23:59:00', status: 'Active' },
  { id: 7, name: 'Weekend Gateway', type: 'Free Shipping', code: null, value: 0, usage: 89, expiryDate: '2023-12-30T23:59:00', status: 'Expired' },
  { id: 8, name: 'Payday Promo', type: 'Discount', code: 'PAYDAY24', value: '15%', usage: 0, expiryDate: '2024-04-25T00:00:00', status: 'Scheduled' },
  { id: 9, name: 'Clearance Sale', type: 'Discount', code: null, value: '70%', usage: 843, expiryDate: '2024-03-01T23:59:00', status: 'Expired' },
  { id: 10, name: 'Cashback OVO', type: 'Coupon', code: 'OVOXMARKHUB', value: 20000, usage: 125, expiryDate: '2024-05-15T23:59:00', status: 'Active' },
  { id: 11, name: 'Gopay Extra', type: 'Coupon', code: 'GOPAY15', value: 15000, usage: 0, expiryDate: '2024-06-01T00:00:00', status: 'Scheduled' }
])

// Filter & Search State
const searchQuery = ref('')
const selectedType = ref('All Types')
const selectedStatus = ref('All Status')

// Metrics Calculations
const totalPromotions = computed(() => promotions.value.length)
const activePromotions = computed(() => promotions.value.filter(p => p.status === 'Active').length)
const scheduledPromotions = computed(() => promotions.value.filter(p => p.status === 'Scheduled').length)
const expiredPromotions = computed(() => promotions.value.filter(p => p.status === 'Expired').length)

// Pagination State
const currentPage = ref(1)
const itemsPerPage = 6

// Computed Filtered Data
const filteredPromotions = computed(() => {
  return promotions.value.filter(promo => {
    // Search by Name or Code
    const searchLower = searchQuery.value.toLowerCase()
    const codeMatch = promo.code ? promo.code.toLowerCase().includes(searchLower) : false
    const nameMatch = promo.name.toLowerCase().includes(searchLower)
    const matchSearch = searchLower === '' || nameMatch || codeMatch
    
    // Type Filter
    const matchType = selectedType.value === 'All Types' || promo.type === selectedType.value

    // Status Filter
    const matchStatus = selectedStatus.value === 'All Status' || promo.status === selectedStatus.value
    
    return matchSearch && matchType && matchStatus
  })
})

const totalPages = computed(() => Math.ceil(filteredPromotions.value.length / itemsPerPage))

const paginatedPromotions = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredPromotions.value.slice(start, end)
})

const prevPage = () => {
  if (currentPage.value > 1) currentPage.value--
}

const nextPage = () => {
  if (currentPage.value < totalPages.value) currentPage.value++
}

// Badge coloring helpers
const getStatusBadgeClass = (status) => {
  switch (status) {
    case 'Active': return 'bg-green-100 text-green-800'
    case 'Scheduled': return 'bg-yellow-100 text-yellow-800'
    case 'Expired': return 'bg-red-100 text-red-800'
    default: return 'bg-gray-100 text-gray-800'
  }
}

const getTypeBadgeClass = (type) => {
  switch (type) {
    case 'Discount': return 'bg-purple-50 text-purple-700 border-purple-200'
    case 'Coupon': return 'bg-blue-50 text-blue-700 border-blue-200'
    case 'Free Shipping': return 'bg-cyan-50 text-cyan-700 border-cyan-200'
    default: return 'bg-gray-50 text-gray-700 border-gray-200'
  }
}
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex">
    <AdminSidebar :sidebar-open="sidebarOpen" @toggle="toggleSidebar" />

    <main class="flex-1 transition-all duration-300 transform" :style="{ marginLeft: sidebarOpen ? '250px' : '80px' }">
      <div class="p-6 lg:p-8">
        
        <!-- Header & Action -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Promotions</h1>
            <p class="text-sm text-gray-500 mt-1">Manage discounts, coupons, and seasonal sales.</p>
          </div>
          <button @click="openPromoModal" class="inline-flex items-center justify-center bg-gray-900 hover:bg-gray-800 text-white rounded-xl px-5 py-2.5 text-sm font-medium transition-colors shadow-sm whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Create Promotion
          </button>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center">
            <p class="text-sm font-medium text-gray-500">Total Promotions</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ totalPromotions }}</h3>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center">
            <p class="text-sm font-medium text-gray-500">Active</p>
            <h3 class="text-3xl font-bold text-green-600 mt-2">{{ activePromotions }}</h3>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center">
            <p class="text-sm font-medium text-gray-500">Scheduled</p>
            <h3 class="text-3xl font-bold text-yellow-500 mt-2">{{ scheduledPromotions }}</h3>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center">
            <p class="text-sm font-medium text-gray-500">Expired</p>
            <h3 class="text-3xl font-bold text-red-600 mt-2">{{ expiredPromotions }}</h3>
          </div>
        </div>

        <!-- Main Content Area -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          
          <!-- Filters & Search Header -->
          <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
            <div class="relative max-w-sm w-full">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>
              <input 
                v-model="searchQuery" 
                type="text" 
                class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300 sm:text-sm transition-colors shadow-sm" 
                placeholder="Search promo name or code..." 
              />
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
              <!-- Type Filter -->
              <select v-model="selectedType" class="block w-full sm:w-44 pl-3 pr-8 py-2.5 text-base border-gray-200 bg-white shadow-sm focus:outline-none focus:ring-gray-300 focus:border-gray-300 sm:text-sm rounded-lg transition-colors border">
                <option value="All Types">All Types</option>
                <option value="Discount">Discount</option>
                <option value="Coupon">Coupon</option>
                <option value="Free Shipping">Free Shipping</option>
              </select>

              <!-- Status Filter -->
              <select v-model="selectedStatus" class="block w-full sm:w-40 pl-3 pr-8 py-2.5 text-base border-gray-200 bg-white shadow-sm focus:outline-none focus:ring-gray-300 focus:border-gray-300 sm:text-sm rounded-lg transition-colors border">
                <option value="All Status">All Status</option>
                <option value="Active">Active</option>
                <option value="Scheduled">Scheduled</option>
                <option value="Expired">Expired</option>
              </select>
            </div>
          </div>

          <!-- Table -->
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50/80">
                <tr>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Promotion Name</th>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type & Code</th>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Value</th>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Usage</th>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Expiry</th>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-100">
                <tr v-for="promo in paginatedPromotions" :key="promo.id" class="hover:bg-gray-50/50 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="text-sm font-medium text-gray-900">{{ promo.name }}</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex flex-col items-start gap-1">
                      <span class="px-2 py-0.5 border text-[11px] font-semibold rounded-md uppercase tracking-wider" :class="getTypeBadgeClass(promo.type)">
                        {{ promo.type }}
                      </span>
                      <span class="text-sm text-gray-600 ml-1 font-mono">
                        {{ promo.code ? promo.code : '-' }}
                      </span>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                    {{ formatDiscountValue(promo) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                    {{ promo.usage }} used
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ formatDate(promo.expiryDate) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border border-transparent" :class="getStatusBadgeClass(promo.status)">
                      {{ promo.status }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end gap-2">
                      <button class="text-gray-500 hover:text-blue-600 p-1.5 rounded-lg transition-colors hover:bg-blue-50" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.89.11l-3.152-.788a.375.375 0 0 1-.282-.282l.788-3.152a4.5 4.5 0 0 1 1.11-1.89l12.3-12.3Z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 5.25 18.75 7.5" />
                        </svg>
                      </button>
                      <button class="text-gray-500 hover:text-red-600 p-1.5 rounded-lg transition-colors hover:bg-red-50" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr v-if="paginatedPromotions.length === 0">
                  <td colspan="7" class="px-6 py-8 text-center text-gray-500 bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" />
                    </svg>
                    No promotions found matching your search or filters.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="bg-gray-50/50 px-4 py-3 border-t border-gray-100 flex items-center justify-between sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
              <div>
                <p class="text-sm text-gray-700">
                  Showing
                  <span class="font-medium">{{ filteredPromotions.length > 0 ? (currentPage - 1) * itemsPerPage + 1 : 0 }}</span>
                  to
                  <span class="font-medium">{{ Math.min(currentPage * itemsPerPage, filteredPromotions.length) }}</span>
                  of
                  <span class="font-medium">{{ filteredPromotions.length }}</span>
                  promotions
                </p>
              </div>
              <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                  <button 
                    @click="prevPage" 
                    :disabled="currentPage === 1"
                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-200 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                  >
                    <span class="sr-only">Previous</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <span class="relative inline-flex items-center px-4 py-2 border border-gray-200 bg-white text-sm font-medium text-gray-700">
                    Page {{ currentPage }} of {{ totalPages || 1 }}
                  </span>
                  <button 
                    @click="nextPage"
                    :disabled="currentPage === totalPages || totalPages === 0"
                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-200 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
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
              <button @click="prevPage" :disabled="currentPage === 1" class="relative inline-flex items-center px-4 py-2 border border-gray-200 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 transition-colors">
                Previous
              </button>
              <span class="text-sm text-gray-700">Page {{ currentPage }} of {{ totalPages || 1 }}</span>
              <button @click="nextPage" :disabled="currentPage === totalPages || totalPages === 0" class="relative inline-flex items-center px-4 py-2 border border-gray-200 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 transition-colors">
                Next
              </button>
            </div>
          </div>

        </div>
      </div>
    </main>

    <!-- Create Promotion Modal -->
    <Teleport to="body">
      <Transition name="modal">
        <div v-if="showPromoModal" class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto py-8 px-4" style="background:rgba(0,0,0,0.5);backdrop-filter:blur(4px)">
          <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white rounded-t-2xl z-10">
              <div>
                <h2 class="text-lg font-bold text-gray-900">Create Promotions</h2>
                <p class="text-xs text-gray-500 mt-0.5">Configure discounts, coupons, or free shipping offers.</p>
              </div>
              <button @click="closePromoModal" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
              </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4 space-y-5 max-h-[70vh] overflow-y-auto">
              <div v-for="(form, idx) in promoForms" :key="idx" class="border border-gray-200 rounded-xl p-5 bg-gray-50/50">
                <!-- Form Header -->
                <div class="flex items-center justify-between mb-4">
                  <span class="text-sm font-semibold bg-gray-900 text-white px-3 py-1 rounded-full">Promotion #{{ idx + 1 }}</span>
                  <button v-if="promoForms.length > 1" @click="removePromoForm(idx)" class="text-red-500 hover:text-red-700 text-xs font-medium flex items-center gap-1 hover:bg-red-50 px-2 py-1 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                    Remove
                  </button>
                </div>

                <!-- Name & Type -->
                <div class="grid grid-cols-2 gap-3 mb-3">
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Promotion Name *</label>
                    <input v-model="form.name" type="text" placeholder="e.g. Ramadhan Mega Sale" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Type *</label>
                    <select v-model="form.type" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white">
                      <option>Discount</option><option>Coupon</option><option>Free Shipping</option>
                    </select>
                  </div>
                </div>

                <!-- Code & Status -->
                <div class="grid grid-cols-2 gap-3 mb-3">
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Promo Code <span class="text-gray-400">(optional)</span></label>
                    <input v-model="form.code" type="text" placeholder="e.g. NEWUSER24" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white font-mono uppercase" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                    <select v-model="form.status" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white">
                      <option>Active</option><option>Scheduled</option><option>Expired</option>
                    </select>
                  </div>
                </div>

                <!-- Value (hidden for Free Shipping) -->
                <div v-if="form.type !== 'Free Shipping'" class="mb-3">
                  <label class="block text-xs font-medium text-gray-700 mb-1">Discount Value *</label>
                  <div class="flex gap-2">
                    <select v-model="form.valueType" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white">
                      <option value="fixed">Rp (Fixed)</option>
                      <option value="percent">% (Percent)</option>
                    </select>
                    <input v-model="form.value" type="number" min="0" :placeholder="form.valueType === 'percent' ? 'e.g. 10' : 'e.g. 50000'" class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                  <p class="text-[11px] text-gray-400 mt-1">
                    Preview: <span class="font-medium text-gray-600">{{ form.valueType === 'percent' ? `${form.value || 0}% off` : `Rp${Number(form.value || 0).toLocaleString('id-ID')} off` }}</span>
                  </p>
                </div>
                <div v-else class="mb-3 bg-cyan-50 border border-cyan-200 rounded-lg px-3 py-2 text-sm text-cyan-700 flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                  Free Shipping — no value required
                </div>

                <!-- Expiry Date & Usage Limit -->
                <div class="grid grid-cols-2 gap-3">
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Expiry Date & Time *</label>
                    <input v-model="form.expiryDate" type="datetime-local" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Usage Limit <span class="text-gray-400">(optional)</span></label>
                    <input v-model="form.usageLimit" type="number" min="0" placeholder="e.g. 1000" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl flex items-center justify-between">
              <button @click="addPromoForm" class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-gray-900 border border-gray-300 hover:border-gray-400 bg-white px-4 py-2 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Another Promotion
              </button>
              <div class="flex gap-3">
                <button @click="closePromoModal" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 border border-gray-200 hover:border-gray-300 rounded-lg bg-white transition-colors">Cancel</button>
                <button @click="submitPromos" class="px-5 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 rounded-lg transition-colors shadow-sm">
                  Save {{ promoForms.length > 1 ? `${promoForms.length} Promotions` : 'Promotion' }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </Transition>
    </Teleport>
  </div>
</template>

<style scoped>
.modal-enter-active, .modal-leave-active { transition: all 0.2s ease; }
.modal-enter-from, .modal-leave-to { opacity: 0; }
</style>
