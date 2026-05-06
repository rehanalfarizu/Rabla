<script setup>
import { ref, computed } from 'vue'
import AdminSidebar from '../layouts/AdminSidebar.vue'

// Modal State
const showProductModal = ref(false)

const createEmptyProduct = () => ({
  name: '', brand: '', category: 'Sneakers', price: '', oldPrice: '',
  sku: '', description: '', tags: '',
  image: '', imagePreview: null,
  gallery: [null, null, null, null],
  galleryPreviews: [null, null, null, null],
  colors: [], newColor: '',
  sizes: [], newSize: '',
  stock: '', status: 'Active'
})

const productForms = ref([createEmptyProduct()])

const addProductForm = () => productForms.value.push(createEmptyProduct())
const removeProductForm = (i) => { if (productForms.value.length > 1) productForms.value.splice(i, 1) }

const openProductModal = () => {
  productForms.value = [createEmptyProduct()]
  showProductModal.value = true
}
const closeProductModal = () => { showProductModal.value = false }

// Image upload handlers
const handleMainImage = (event, form) => {
  const file = event.target.files[0]
  if (file) {
    form.image = file.name
    form.imagePreview = URL.createObjectURL(file)
  }
}

const handleGalleryImage = (event, form, index) => {
  const file = event.target.files[0]
  if (file) {
    form.gallery[index] = file.name
    form.galleryPreviews[index] = URL.createObjectURL(file)
  }
}

const clearMainImage = (form) => { form.image = ''; form.imagePreview = null }
const clearGalleryImage = (form, i) => { form.gallery[i] = null; form.galleryPreviews[i] = null }

// Color tag helpers
const addColor = (form) => {
  const c = form.newColor.trim()
  if (c && !form.colors.includes(c)) { form.colors.push(c) }
  form.newColor = ''
}
const removeColor = (form, i) => form.colors.splice(i, 1)

// Size tag helpers
const addSize = (form) => {
  const s = form.newSize.trim()
  if (s && !form.sizes.includes(s)) { form.sizes.push(s) }
  form.newSize = ''
}
const removeSize = (form, i) => form.sizes.splice(i, 1)

const submitProducts = () => {
  const newProds = productForms.value.map((f, idx) => ({
    id: products.value.length + idx + 1,
    name: f.name, brand: f.brand, category: f.category,
    price: Number(f.price), oldPrice: Number(f.oldPrice),
    sku: f.sku, description: f.description,
    tags: f.tags.split(',').map(t => t.trim()).filter(Boolean),
    image: f.imagePreview || 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=80',
    gallery: f.galleryPreviews.filter(Boolean),
    colors: f.colors, sizes: f.sizes,
    stock: Number(f.stock), status: f.status, createdAt: new Date().toISOString().split('T')[0]
  }))
  products.value.push(...newProds)
  closeProductModal()
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

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString('id-ID', options)
}

// Dummy Product Data
const products = ref([
  { id: 1, name: 'Nike Dunk Low Retro', category: 'Sneakers', price: 1549000, stock: 45, status: 'Active', image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=80', createdAt: '2023-11-01' },
  { id: 2, name: 'Adidas Samba Classic', category: 'Sneakers', price: 1700000, stock: 2, status: 'Active', image: 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=200&q=80', createdAt: '2023-12-10' },
  { id: 3, name: 'Converse Chuck Taylor', category: 'Sneakers', price: 899000, stock: 0, status: 'Out of Stock', image: 'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=200&q=80', createdAt: '2023-10-15' },
  { id: 4, name: 'Basic V-Neck T-Shirt', category: 'Apparel', price: 150000, stock: 120, status: 'Active', image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=200&q=80', createdAt: '2024-01-05' },
  { id: 5, name: 'Minimalist Hoodie', category: 'Apparel', price: 450000, stock: 3, status: 'Active', image: 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=200&q=80', createdAt: '2024-02-12' },
  { id: 6, name: 'Fleece Fall Jacket', category: 'Outerwear', price: 1200000, stock: 8, status: 'Draft', image: 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=200&q=80', createdAt: '2024-02-28' },
  { id: 7, name: 'Winter Beanie Hat', category: 'Accessories', price: 150000, stock: 40, status: 'Active', image: 'https://images.unsplash.com/photo-1576871337622-98d48d1cf531?w=200&q=80', createdAt: '2023-11-20' },
  { id: 8, name: 'Leather Crossbody Bag', category: 'Accessories', price: 2100000, stock: 0, status: 'Out of Stock', image: 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=200&q=80', createdAt: '2023-09-10' },
  { id: 9, name: 'Slim Fit Denim Jeans', category: 'Pants', price: 850000, stock: 4, status: 'Active', image: 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=200&q=80', createdAt: '2024-01-18' },
  { id: 10, name: 'Running Elite Shorts', category: 'Pants', price: 350000, stock: 65, status: 'Active', image: 'https://images.unsplash.com/photo-1618354691438-25bc04584c23?w=200&q=80', createdAt: '2024-03-01' },
  { id: 11, name: 'Yeezy Slide Pure', category: 'Sneakers', price: 2200000, stock: 15, status: 'Active', image: 'https://images.unsplash.com/photo-1595950653106-6c9ebd614c3a?w=200&q=80', createdAt: '2023-12-05' },
  { id: 12, name: 'Graphic Printed Skateboard', category: 'Equipment', price: 1100000, stock: 20, status: 'Draft', image: 'https://images.unsplash.com/photo-1564982752979-3f7bc974d29a?w=200&q=80', createdAt: '2024-02-20' }
])

// Categories extraction
const availableCategories = computed(() => ['All Categories', ...new Set(products.value.map(p => p.category))])

// Filter & Search State
const searchQuery = ref('')
const selectedCategory = ref('All Categories')
const selectedStatus = ref('All Status')

// Metrics Calculations
const totalProducts = computed(() => products.value.length)
const activeProducts = computed(() => products.value.filter(p => p.status === 'Active').length)
const outOfStockProducts = computed(() => products.value.filter(p => p.stock === 0 || p.status === 'Out of Stock').length)
const lowStockProducts = computed(() => products.value.filter(p => p.stock > 0 && p.stock < 5).length)

// Pagination State
const currentPage = ref(1)
const itemsPerPage = 8

// Computed Filtered Data
const filteredProducts = computed(() => {
  return products.value.filter(product => {
    const matchSearch = product.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    const matchCategory = selectedCategory.value === 'All Categories' || product.category === selectedCategory.value
    const matchStatus = selectedStatus.value === 'All Status' || product.status === selectedStatus.value
    return matchSearch && matchCategory && matchStatus
  })
})

const totalPages = computed(() => Math.ceil(filteredProducts.value.length / itemsPerPage))

const paginatedProducts = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredProducts.value.slice(start, end)
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

    <main class="flex-1 transition-all duration-300 transform" :style="{ marginLeft: sidebarOpen ? '250px' : '80px' }">
      <div class="p-6 lg:p-8">
        
        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Products</h1>
            <p class="text-sm text-gray-500 mt-1">Manage your catalog, stock, and pricing here.</p>
          </div>
          <button @click="openProductModal" class="inline-flex items-center justify-center bg-gray-900 hover:bg-gray-800 text-white rounded-xl px-5 py-2.5 text-sm font-medium transition-colors shadow-sm whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Product
          </button>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-500">Total Products</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ totalProducts }}</h3>
              </div>
              <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-500">Active</p>
                <h3 class="text-3xl font-bold text-green-600 mt-2">{{ activeProducts }}</h3>
              </div>
              <div class="p-2 bg-green-50 text-green-600 rounded-lg">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-500">Out of Stock</p>
                <h3 class="text-3xl font-bold text-red-600 mt-2">{{ outOfStockProducts }}</h3>
              </div>
              <div class="p-2 bg-red-50 text-red-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-500">Low Stock</p>
                <h3 class="text-3xl font-bold text-yellow-500 mt-2">{{ lowStockProducts }}</h3>
              </div>
              <div class="p-2 bg-yellow-50 text-yellow-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" />
                </svg>
              </div>
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
                placeholder="Search products by name" 
              />
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
              <select v-model="selectedCategory" class="block w-full sm:w-40 pl-3 pr-8 py-2 text-base border-gray-200 bg-gray-50 focus:outline-none focus:ring-gray-300 focus:border-gray-300 sm:text-sm rounded-lg transition-colors border">
                <option v-for="cat in availableCategories" :key="cat" :value="cat">{{ cat }}</option>
              </select>

              <select v-model="selectedStatus" class="block w-full sm:w-40 pl-3 pr-8 py-2 text-base border-gray-200 bg-gray-50 focus:outline-none focus:ring-gray-300 focus:border-gray-300 sm:text-sm rounded-lg transition-colors border">
                <option value="All Status">All Status</option>
                <option value="Active">Active</option>
                <option value="Draft">Draft</option>
                <option value="Out of Stock">Out of Stock</option>
              </select>
            </div>
          </div>

          <!-- Table -->
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                  <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="product in paginatedProducts" :key="product.id" class="hover:bg-gray-50 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-12 w-12 border border-gray-100 rounded-lg overflow-hidden bg-white">
                        <img :src="product.image" :alt="product.name" class="h-12 w-12 object-cover object-center" />
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900 truncate max-w-[200px]" :title="product.name">{{ product.name }}</div>
                        <div class="text-sm text-gray-500">ID: #{{ product.id.toString().padStart(4, '0') }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                      {{ product.category }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                    {{ formatCurrency(product.price) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center gap-1.5">
                      <span 
                        class="text-sm font-bold"
                        :class="[
                          product.stock > 10 ? 'text-gray-900' : 
                          product.stock > 0 ? 'text-yellow-600' : 'text-red-600'
                        ]"
                      >
                        {{ product.stock }}
                      </span>
                      <span v-if="product.stock > 0 && product.stock <= 5" class="px-1.5 py-0.5 text-[10px] font-bold bg-yellow-100 text-yellow-800 rounded uppercase">Low</span>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span 
                      class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                      :class="{
                        'bg-green-100 text-green-800': product.status === 'Active',
                        'bg-gray-100 text-gray-600': product.status === 'Draft',
                        'bg-red-100 text-red-800': product.status === 'Out of Stock'
                      }"
                    >
                      <span class="w-1.5 h-1.5 rounded-full mr-1.5 self-center" :class="{
                        'bg-green-500': product.status === 'Active',
                        'bg-gray-400': product.status === 'Draft',
                        'bg-red-500': product.status === 'Out of Stock'
                      }"></span>
                      {{ product.status }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ formatDate(product.createdAt) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end gap-2">
                       <button class="text-gray-500 hover:text-blue-600 p-1.5 rounded-lg transition-colors hover:bg-blue-50" title="View">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                      </button>
                      <button class="text-gray-500 hover:text-green-600 p-1.5 rounded-lg transition-colors hover:bg-green-50" title="Edit">
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
                <tr v-if="paginatedProducts.length === 0">
                  <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    No products found matching your criteria.
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
                  <span class="font-medium">{{ filteredProducts.length > 0 ? (currentPage - 1) * itemsPerPage + 1 : 0 }}</span>
                  to
                  <span class="font-medium">{{ Math.min(currentPage * itemsPerPage, filteredProducts.length) }}</span>
                  of
                  <span class="font-medium">{{ filteredProducts.length }}</span>
                  products
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

    <!-- Add Product Modal -->
    <Teleport to="body">
      <Transition name="modal">
        <div v-if="showProductModal" class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto py-8 px-4" style="background:rgba(0,0,0,0.5);backdrop-filter:blur(4px)">
          <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white rounded-t-2xl z-10">
              <div>
                <h2 class="text-lg font-bold text-gray-900">Add Products</h2>
                <p class="text-xs text-gray-500 mt-0.5">Fill in the details below. Add multiple products at once.</p>
              </div>
              <button @click="closeProductModal" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 text-gray-500 hover:text-gray-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
              </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4 space-y-6 max-h-[70vh] overflow-y-auto">
              <div v-for="(form, idx) in productForms" :key="idx" class="border border-gray-200 rounded-xl p-5 relative bg-gray-50/50">
                <!-- Form Header -->
                <div class="flex items-center justify-between mb-4">
                  <span class="text-sm font-semibold text-gray-700 bg-gray-900 text-white px-3 py-1 rounded-full">Product #{{ idx + 1 }}</span>
                  <button v-if="productForms.length > 1" @click="removeProductForm(idx)" class="text-red-500 hover:text-red-700 text-xs font-medium flex items-center gap-1 hover:bg-red-50 px-2 py-1 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                    Remove
                  </button>
                </div>

                <!-- Row 1: Name & Brand -->
                <div class="grid grid-cols-2 gap-3 mb-3">
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Product Name *</label>
                    <input v-model="form.name" type="text" placeholder="e.g. Nike Dunk Low" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Brand *</label>
                    <input v-model="form.brand" type="text" placeholder="e.g. Nike" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                </div>

                <!-- Row 2: Price, Old Price, SKU -->
                <div class="grid grid-cols-3 gap-3 mb-3">
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Price (Rp) *</label>
                    <input v-model="form.price" type="number" min="0" placeholder="1500000" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Original Price (Rp)</label>
                    <input v-model="form.oldPrice" type="number" min="0" placeholder="2000000" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">SKU</label>
                    <input v-model="form.sku" type="text" placeholder="2,51,594" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                </div>

                <!-- Row 3: Category, Stock, Status -->
                <div class="grid grid-cols-3 gap-3 mb-3">
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Category *</label>
                    <select v-model="form.category" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white">
                      <option>Sneakers</option><option>Apparel</option><option>Outerwear</option>
                      <option>Accessories</option><option>Pants</option><option>Equipment</option>
                      <option>Bags</option><option>Dresses</option>
                    </select>
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Stock *</label>
                    <input v-model="form.stock" type="number" min="0" placeholder="50" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                    <select v-model="form.status" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white">
                      <option>Active</option><option>Draft</option><option>Out of Stock</option>
                    </select>
                  </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                  <label class="block text-xs font-medium text-gray-700 mb-1">Description</label>
                  <textarea v-model="form.description" rows="2" placeholder="Product description..." class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white resize-none"></textarea>
                </div>

                <!-- Tags -->
                <div class="mb-3">
                  <label class="block text-xs font-medium text-gray-700 mb-1">Tags <span class="text-gray-400">(comma-separated)</span></label>
                  <input v-model="form.tags" type="text" placeholder="Sneakers, Sports, Casual" class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                </div>

                <!-- Main Image Upload -->
                <div class="mb-3">
                  <label class="block text-xs font-medium text-gray-700 mb-1">Main Image *</label>
                  <div v-if="!form.imagePreview" class="relative">
                    <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer hover:border-gray-400 hover:bg-gray-50 transition-all group">
                      <input type="file" accept="image/*" class="sr-only" @change="handleMainImage($event, form)" />
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-gray-300 group-hover:text-gray-500 mb-1 transition-colors"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                      <span class="text-xs text-gray-400 group-hover:text-gray-600">Click to upload main image</span>
                      <span class="text-[10px] text-gray-300 mt-0.5">PNG, JPG, WEBP</span>
                    </label>
                  </div>
                  <div v-else class="relative inline-block">
                    <img :src="form.imagePreview" class="h-24 w-24 object-cover rounded-xl border border-gray-200" />
                    <button @click="clearMainImage(form)" type="button" class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-xs transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </button>
                  </div>
                </div>

                <!-- Gallery Upload -->
                <div class="mb-3">
                  <label class="block text-xs font-medium text-gray-700 mb-2">Gallery Images <span class="text-gray-400">(up to 4)</span></label>
                  <div class="grid grid-cols-4 gap-2">
                    <div v-for="(_, gi) in form.gallery" :key="gi">
                      <div v-if="!form.galleryPreviews[gi]">
                        <label class="flex flex-col items-center justify-center w-full aspect-square border-2 border-dashed border-gray-200 rounded-lg cursor-pointer hover:border-gray-400 hover:bg-gray-50 transition-all group">
                          <input type="file" accept="image/*" class="sr-only" @change="handleGalleryImage($event, form, gi)" />
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-300 group-hover:text-gray-500 mb-0.5 transition-colors"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                          <span class="text-[10px] text-gray-300">{{ gi + 1 }}</span>
                        </label>
                      </div>
                      <div v-else class="relative">
                        <img :src="form.galleryPreviews[gi]" class="w-full aspect-square object-cover rounded-lg border border-gray-200" />
                        <button @click="clearGalleryImage(form, gi)" type="button" class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Colors Tag Input -->
                <div class="mb-3">
                  <label class="block text-xs font-medium text-gray-700 mb-1.5">Available Colors</label>
                  <div class="flex flex-wrap gap-1.5 mb-2" v-if="form.colors.length">
                    <span v-for="(c, ci) in form.colors" :key="ci" class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-xs font-medium transition-colors">
                      {{ c }}
                      <button @click="removeColor(form, ci)" type="button" class="text-gray-400 hover:text-red-500 ml-0.5 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                      </button>
                    </span>
                  </div>
                  <div class="flex gap-2">
                    <input v-model="form.newColor" @keyup.enter="addColor(form)" type="text" placeholder="e.g. Merah, Kuning, Navy..." class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                    <button @click="addColor(form)" type="button" class="px-3 py-2 bg-gray-900 hover:bg-gray-700 text-white rounded-lg text-sm font-medium transition-colors">+ Add</button>
                  </div>
                </div>

                <!-- Sizes Tag Input -->
                <div>
                  <label class="block text-xs font-medium text-gray-700 mb-1.5">Available Sizes</label>
                  <div class="flex flex-wrap gap-1.5 mb-2" v-if="form.sizes.length">
                    <span v-for="(s, si) in form.sizes" :key="si" class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-900 text-white rounded-full text-xs font-medium">
                      {{ s }}
                      <button @click="removeSize(form, si)" type="button" class="text-gray-400 hover:text-red-400 ml-0.5 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                      </button>
                    </span>
                  </div>
                  <div class="flex gap-2">
                    <input v-model="form.newSize" @keyup.enter="addSize(form)" type="text" placeholder="e.g. S, M, L, XL, 42, 43..." class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white" />
                    <button @click="addSize(form)" type="button" class="px-3 py-2 bg-gray-900 hover:bg-gray-700 text-white rounded-lg text-sm font-medium transition-colors">+ Add</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl flex items-center justify-between">
              <button @click="addProductForm" class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-gray-900 border border-gray-300 hover:border-gray-400 bg-white px-4 py-2 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Another Product
              </button>
              <div class="flex gap-3">
                <button @click="closeProductModal" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 border border-gray-200 hover:border-gray-300 rounded-lg bg-white transition-colors">Cancel</button>
                <button @click="submitProducts" class="px-5 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 rounded-lg transition-colors shadow-sm">
                  Save {{ productForms.length > 1 ? `${productForms.length} Products` : 'Product' }}
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
