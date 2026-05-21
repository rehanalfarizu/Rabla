<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import AdminSidebar from '../layouts/AdminSidebar.vue'
import { useAdminPromotions } from '../composables/useAdminPromotions'

const {
  promotions,
  loading,
  pagination,
  fetchPromotionsData,
  create,
  update,
  remove,
  setPage
} = useAdminPromotions()

// Modal State
const showPromoModal = ref(false)
const editingPromo = ref(null)

const createEmptyPromo = () => ({
  name: '', type: 'discount', code: '', discount_type: 'fixed',
  discount_value: '', max_discount: '', min_purchase: '',
  max_uses: '', end_date: '', is_active: true, description: ''
})

const promoForms = ref([createEmptyPromo()])

const addPromoForm = () => promoForms.value.push(createEmptyPromo())
const removePromoForm = (i) => { if (promoForms.value.length > 1) promoForms.value.splice(i, 1) }

const openPromoModal = (promo = null) => {
  if (promo) {
    editingPromo.value = promo
    promoForms.value = [{
      name: promo.name,
      type: promo.type,
      code: promo.code || '',
      discount_type: promo.discount_type || 'fixed',
      discount_value: promo.discount_value || '',
      max_discount: promo.max_discount || '',
      min_purchase: promo.min_purchase || '',
      max_uses: promo.max_uses || '',
      end_date: promo.end_date ? promo.end_date.split('T')[0] : '',
      is_active: promo.is_active ?? true,
      description: promo.description || ''
    }]
  } else {
    editingPromo.value = null
    promoForms.value = [createEmptyPromo()]
  }
  showPromoModal.value = true
}

const closePromoModal = () => {
  showPromoModal.value = false
  editingPromo.value = null
}

const submitPromos = async () => {
  try {
    for (const form of promoForms.value) {
      const promoData = {
        name: form.name,
        type: form.type,
        code: form.code || null,
        discount_type: form.discount_type,
        discount_value: Number(form.discount_value) || 0,
        max_discount: form.max_discount ? Number(form.max_discount) : null,
        min_purchase: form.min_purchase ? Number(form.min_purchase) : 0,
        max_uses: form.max_uses ? Number(form.max_uses) : null,
        end_date: form.end_date || null,
        is_active: form.is_active,
        description: form.description
      }

      if (editingPromo.value) {
        await update(editingPromo.value.id, promoData)
      } else {
        await create(promoData)
      }
    }
    closePromoModal()
  } catch (e) {
    console.error('Failed to save promotion:', e)
    alert('Failed to save promotion. Please try again.')
  }
}

const deletePromo = async (promo) => {
  if (confirm(`Are you sure you want to delete "${promo.name}"?`)) {
    try {
      await remove(promo.id)
    } catch (e) {
      alert('Failed to delete promotion.')
    }
  }
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
  return promo.value_display || promo.value || 'Free Shipping'
}

const formatDate = (dateString) => {
  if (!dateString) return '-'
  const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }
  return new Date(dateString).toLocaleDateString('id-ID', options)
}

// Filter & Search State
const searchQuery = ref('')
const selectedType = ref('All Types')
const selectedStatus = ref('All Status')

// Load data
onMounted(async () => {
  await fetchPromotionsData()
})

// Watch for search/filter changes
watch([searchQuery, selectedType, selectedStatus], () => {
  setPage(1)
  fetchPromotionsData({
    search: searchQuery.value,
    type: selectedType.value !== 'All Types' ? selectedType.value.toLowerCase().replace(' ', '_') : undefined,
    status: selectedStatus.value !== 'All Status' ? selectedStatus.value : undefined
  })
})

// Computed
const totalPromotions = computed(() => pagination.value.total || promotions.value.length)
const activePromotions = computed(() => promotions.value.filter(p => p.status === 'Active').length)
const scheduledPromotions = computed(() => promotions.value.filter(p => p.status === 'Scheduled').length)
const expiredPromotions = computed(() => promotions.value.filter(p => p.status === 'Expired' || p.status === 'Inactive').length)

const totalPages = computed(() => pagination.value.last_page)

const prevPage = () => {
  if (pagination.value.current_page > 1) {
    setPage(pagination.value.current_page - 1)
    fetchPromotionsData({
      search: searchQuery.value,
      type: selectedType.value !== 'All Types' ? selectedType.value.toLowerCase().replace(' ', '_') : undefined,
      status: selectedStatus.value !== 'All Status' ? selectedStatus.value : undefined
    })
  }
}

const nextPage = () => {
  if (pagination.value.current_page < totalPages.value) {
    setPage(pagination.value.current_page + 1)
    fetchPromotionsData({
      search: searchQuery.value,
      type: selectedType.value !== 'All Types' ? selectedType.value.toLowerCase().replace(' ', '_') : undefined,
      status: selectedStatus.value !== 'All Status' ? selectedStatus.value : undefined
    })
  }
}

// Badge coloring helpers
const getStatusBadgeClass = (status) => {
  switch (status) {
    case 'Active': return 'bg-green-100 text-green-800'
    case 'Scheduled': return 'bg-yellow-100 text-yellow-800'
    case 'Expired':
    case 'Inactive':
    case 'Maxed Out': return 'bg-red-100 text-red-800'
    default: return 'bg-gray-100 text-gray-800'
  }
}

const getTypeBadgeClass = (type) => {
  switch (type) {
    case 'Discount':
    case 'discount': return 'bg-purple-50 text-purple-700 border-purple-200'
    case 'Coupon':
    case 'cashback': return 'bg-blue-50 text-blue-700 border-blue-200'
    case 'Free Shipping':
    case 'free_shipping': return 'bg-cyan-50 text-cyan-700 border-cyan-200'
    default: return 'bg-gray-50 text-gray-700 border-gray-200'
  }
}

const getTypeDisplay = (type) => {
  const map = {
    'discount': 'Discount',
    'cashback': 'Cashback',
    'bundle': 'Bundle',
    'free_shipping': 'Free Shipping',
    'bogo': 'Buy One Get One'
  }
  return map[type] || type || 'Unknown'
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
            <h1 class="text-2xl font-bold text-gray-900">Promotions</h1>
            <p class="text-sm text-gray-500 mt-1">Create and manage discounts, coupons, and special offers.</p>
          </div>
          <button @click="openPromoModal()" class="inline-flex items-center justify-center bg-gray-900 hover:bg-gray-800 text-white rounded-xl px-5 py-2.5 text-sm font-medium transition-colors shadow-sm whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Promotion
          </button>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500">Total Promotions</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ totalPromotions }}</h3>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500">Active</p>
            <h3 class="text-3xl font-bold text-green-600 mt-2">{{ activePromotions }}</h3>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500">Scheduled</p>
            <h3 class="text-3xl font-bold text-yellow-600 mt-2">{{ scheduledPromotions }}</h3>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500">Expired</p>
            <h3 class="text-3xl font-bold text-red-600 mt-2">{{ expiredPromotions }}</h3>
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
                placeholder="Search by name or code"
              />
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
              <select v-model="selectedType" class="block w-full sm:w-40 pl-3 pr-8 py-2 text-base border-gray-200 bg-gray-50 focus:outline-none focus:ring-gray-300 focus:border-gray-300 sm:text-sm rounded-lg transition-colors border">
                <option value="All Types">All Types</option>
                <option value="Discount">Discount</option>
                <option value="Coupon">Coupon</option>
                <option value="Free Shipping">Free Shipping</option>
              </select>

              <select v-model="selectedStatus" class="block w-full sm:w-40 pl-3 pr-8 py-2 text-base border-gray-200 bg-gray-50 focus:outline-none focus:ring-gray-300 focus:border-gray-300 sm:text-sm rounded-lg transition-colors border">
                <option value="All Status">All Status</option>
                <option value="Active">Active</option>
                <option value="Scheduled">Scheduled</option>
                <option value="Expired">Expired</option>
              </select>
            </div>
          </div>

          <!-- Loading State -->
          <div v-if="loading" class="p-8 text-center text-gray-500">
            <svg class="animate-spin h-8 w-8 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="mt-2">Loading promotions...</p>
          </div>

          <!-- Table -->
          <div v-else class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Promotion</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usage</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="promo in promotions" :key="promo.id" class="hover:bg-gray-50 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ promo.name }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-medium rounded-full border" :class="getTypeBadgeClass(promo.type)">
                      {{ getTypeDisplay(promo.type) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span v-if="promo.code" class="px-2.5 py-1 text-xs font-mono font-semibold bg-gray-100 text-gray-700 rounded">
                      {{ promo.code }}
                    </span>
                    <span v-else class="text-sm text-gray-400">—</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                    {{ formatDiscountValue(promo) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ promo.used_count }}
                    <span v-if="promo.max_uses" class="text-gray-400"> / {{ promo.max_uses }}</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ formatDate(promo.end_date) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full" :class="getStatusBadgeClass(promo.status)">
                      {{ promo.status }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end gap-2">
                      <button @click="openPromoModal(promo)" class="text-gray-500 hover:text-green-600 p-1.5 rounded-lg transition-colors hover:bg-green-50" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.89.11l-3.152-.788a.375.375 0 0 1-.282-.282l.788-3.152a4.5 4.5 0 0 1 1.11-1.89l12.3-12.3Z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 5.25 18.75 7.5" />
                        </svg>
                      </button>
                      <button @click="deletePromo(promo)" class="text-gray-500 hover:text-red-600 p-1.5 rounded-lg transition-colors hover:bg-red-50" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr v-if="promotions.length === 0">
                  <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                    No promotions found.
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
                  promotions
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

    <!-- Add/Edit Promotion Modal -->
    <Teleport to="body">
      <Transition name="modal">
        <div v-if="showPromoModal" class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto py-8 px-4" style="background:rgba(0,0,0,0.5);backdrop-filter:blur(4px)">
          <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white rounded-t-2xl z-10">
              <div>
                <h2 class="text-lg font-bold text-gray-900">{{ editingPromo ? 'Edit Promotion' : 'Add Promotion' }}</h2>
                <p class="text-xs text-gray-500 mt-0.5">{{ editingPromo ? 'Update promotion details' : 'Create a new discount or promotion' }}</p>
              </div>
              <button @click="closePromoModal" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
              </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4 space-y-4 max-h-[70vh] overflow-y-auto">
              <div v-for="(form, idx) in promoForms" :key="idx" class="border border-gray-200 rounded-xl p-5 bg-gray-50/50">
                <!-- Form Header -->
                <div class="flex items-center justify-between mb-4">
                  <span class="text-sm font-semibold text-gray-700 bg-gray-900 text-white px-3 py-1 rounded-full">Promotion #{{ idx + 1 }}</span>
                  <button v-if="promoForms.length > 1" @click="removePromoForm(idx)" class="text-red-500 hover:text-red-700 text-xs font-medium flex items-center gap-1 hover:bg-red-50 px-2 py-1 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                    Remove
                  </button>
                </div>

                <!-- Name -->
                <div class="mb-4">
                  <label class="block text-xs font-medium text-gray-700 mb-1">Promotion Name *</label>
                  <input v-model="form.name" type="text" placeholder="e.g. Summer Sale" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                </div>

                <!-- Type & Code -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Type *</label>
                    <select v-model="form.type" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white">
                      <option value="discount">Discount</option>
                      <option value="cashback">Cashback</option>
                      <option value="bundle">Bundle</option>
                      <option value="free_shipping">Free Shipping</option>
                      <option value="bogo">Buy One Get One</option>
                    </select>
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Promo Code</label>
                    <input v-model="form.code" type="text" placeholder="e.g. SUMMER20" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                </div>

                <!-- Value & Discount Type -->
                <div v-if="form.type !== 'free_shipping'" class="grid grid-cols-2 gap-3 mb-4">
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Value *</label>
                    <input v-model="form.discount_value" type="number" min="0" placeholder="e.g. 20" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Discount Type</label>
                    <select v-model="form.discount_type" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white">
                      <option value="fixed">Fixed (Rp)</option>
                      <option value="percentage">Percentage (%)</option>
                    </select>
                  </div>
                </div>

                <!-- Max Discount (for percentage) -->
                <div v-if="form.type !== 'free_shipping' && form.discount_type === 'percentage'" class="mb-4">
                  <label class="block text-xs font-medium text-gray-700 mb-1">Max Discount (Rp)</label>
                  <input v-model="form.max_discount" type="number" min="0" placeholder="e.g. 50000" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                </div>

                <!-- Min Purchase -->
                <div v-if="form.type !== 'free_shipping'" class="mb-4">
                  <label class="block text-xs font-medium text-gray-700 mb-1">Min Purchase (Rp)</label>
                  <input v-model="form.min_purchase" type="number" min="0" placeholder="e.g. 100000" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                </div>

                <!-- Max Uses & Expiry -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Max Uses</label>
                    <input v-model="form.max_uses" type="number" min="0" placeholder="e.g. 1000" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Expiry Date</label>
                    <input v-model="form.end_date" type="date" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                  <label class="block text-xs font-medium text-gray-700 mb-1">Description</label>
                  <textarea v-model="form.description" rows="2" placeholder="Promotion description..." class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white resize-none"></textarea>
                </div>

                <!-- Active Status -->
                <div class="flex items-center gap-2">
                  <input v-model="form.is_active" type="checkbox" id="is_active" class="w-4 h-4 rounded border-gray-300 text-gray-900 focus:ring-gray-500" />
                  <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                </div>
              </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl flex items-center justify-between">
              <button v-if="!editingPromo" @click="addPromoForm" class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-gray-900 border border-gray-300 hover:border-gray-400 bg-white px-4 py-2 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Another Promotion
              </button>
              <div v-else></div>
              <div class="flex gap-3">
                <button @click="closePromoModal" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 border border-gray-200 hover:border-gray-300 rounded-lg bg-white transition-colors">Cancel</button>
                <button @click="submitPromos" :disabled="loading" class="px-5 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 rounded-lg transition-colors shadow-sm disabled:opacity-50">
                  {{ loading ? 'Saving...' : (editingPromo ? 'Update Promotion' : 'Save Promotion') }}
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
.modal-enter-from .bg-white, .modal-leave-to .bg-white { transform: scale(0.95); }
</style>