<script setup>
import { computed, ref } from 'vue'
import AdminSidebar from '../layouts/AdminSidebar.vue'

const sidebarOpen = ref(true)
const search = ref('')
const showAddProductForm = ref(false)
const selectedFileName = ref('Belum ada file dipilih')
const newProduct = ref({
  name: '',
  category: '',
  stock: '',
  price: ''
})

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value
}

const handleFileChange = (event) => {
  const file = event.target.files?.[0]
  selectedFileName.value = file ? file.name : 'Belum ada file dipilih'
}

const openAddProductForm = () => {
  showAddProductForm.value = true
}

const closeAddProductForm = () => {
  showAddProductForm.value = false
  selectedFileName.value = 'Belum ada file dipilih'
  newProduct.value = {
    name: '',
    category: '',
    stock: '',
    price: ''
  }
}

const submitAddProduct = () => {
  if (!newProduct.value.name || !newProduct.value.category || !newProduct.value.stock || !newProduct.value.price) {
    return
  }

  const nextId = `PRD-${String(products.value.length + 1).padStart(3, '0')}`
  products.value.unshift({
    id: nextId,
    name: newProduct.value.name,
    category: newProduct.value.category,
    stock: Number(newProduct.value.stock),
    price: `Rp${newProduct.value.price}`,
    status: Number(newProduct.value.stock) === 0 ? 'Out of Stock' : 'Active'
  })

  closeAddProductForm()
}

const products = ref([
  { id: 'PRD-001', name: 'Classic Black Hoodie', category: 'Hoodie', stock: 84, price: 'Rp499.000', status: 'Active' },
  { id: 'PRD-002', name: 'Minimal White Tee', category: 'T-Shirt', stock: 210, price: 'Rp199.000', status: 'Active' },
  { id: 'PRD-003', name: 'Cargo Urban Pants', category: 'Pants', stock: 0, price: 'Rp429.000', status: 'Out of Stock' },
  { id: 'PRD-004', name: 'Oversized Denim Jacket', category: 'Jacket', stock: 19, price: 'Rp699.000', status: 'Low Stock' },
  { id: 'PRD-005', name: 'Streetwear Cap', category: 'Accessories', stock: 62, price: 'Rp149.000', status: 'Active' }
])

const filteredProducts = computed(() => {
  const query = search.value.trim().toLowerCase()
  if (!query) return products.value

  return products.value.filter((item) => {
    return (
      item.name.toLowerCase().includes(query) ||
      item.category.toLowerCase().includes(query) ||
      item.id.toLowerCase().includes(query)
    )
  })
})

const statusClass = (status) => {
  if (status === 'Active') return 'bg-green-100 text-green-700'
  if (status === 'Low Stock') return 'bg-amber-100 text-amber-700'
  return 'bg-red-100 text-red-700'
}
</script>

<template>
  <div class="min-h-screen bg-slate-50">
    <AdminSidebar :sidebar-open="sidebarOpen" @toggle="toggleSidebar" />

    <main :style="{ paddingLeft: sidebarOpen ? '250px' : '80px' }">
      <div class="p-6 lg:p-8">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          <div>
            <h1 class="text-3xl font-bold text-slate-900">Admin Products</h1>
            <p class="mt-2 text-slate-500">Kelola katalog produk, stok, dan status publikasi.</p>
          </div>
          <button type="button" @click="openAddProductForm" class="rounded-xl bg-slate-900 px-4 py-3 text-sm font-medium text-white hover:bg-slate-800">
            + Add New Product
          </button>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
          <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Products</p>
            <h2 class="mt-3 text-2xl font-bold text-slate-900">1,204</h2>
          </div>
          <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Low Stock</p>
            <h2 class="mt-3 text-2xl font-bold text-amber-600">43</h2>
          </div>
          <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Out of Stock</p>
            <h2 class="mt-3 text-2xl font-bold text-red-600">12</h2>
          </div>
        </div>

        <div v-if="showAddProductForm" class="mt-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
          <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-900">Add New Product</h2>
            <span class="text-xs text-slate-500">{{ selectedFileName }}</span>
          </div>

          <div class="mb-4 grid gap-3 md:grid-cols-2">
            <input
              v-model="newProduct.name"
              type="text"
              placeholder="Product name"
              class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm text-slate-700 outline-none focus:border-blue-500"
            />
            <input
              v-model="newProduct.category"
              type="text"
              placeholder="Category"
              class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm text-slate-700 outline-none focus:border-blue-500"
            />
            <input
              v-model="newProduct.stock"
              type="number"
              min="0"
              placeholder="Stock"
              class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm text-slate-700 outline-none focus:border-blue-500"
            />
            <input
              v-model="newProduct.price"
              type="text"
              placeholder="Price (contoh: 299.000)"
              class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm text-slate-700 outline-none focus:border-blue-500"
            />
          </div>

          <label
            for="uploadFile1"
            class="mx-auto flex min-h-44 w-full max-w-sm cursor-pointer flex-col items-center justify-center rounded border-2 border-gray-300 bg-white px-4 py-4 text-center"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="mb-6 w-10 fill-slate-400" viewBox="0 0 24 24">
              <path
                d="M22 13a1 1 0 0 0-1 1v4.213A2.79 2.79 0 0 1 18.213 21H5.787A2.79 2.79 0 0 1 3 18.213V14a1 1 0 0 0-2 0v4.213A4.792 4.792 0 0 0 5.787 23h12.426A4.792 4.792 0 0 0 23 18.213V14a1 1 0 0 0-1-1Z"
              />
              <path
                d="M6.707 8.707 11 4.414V17a1 1 0 0 0 2 0V4.414l4.293 4.293a1 1 0 0 0 1.414-1.414l-6-6a1 1 0 0 0-1.414 0l-6 6a1 1 0 0 0 1.414 1.414Z"
              />
            </svg>
            <p class="text-sm font-semibold text-slate-400">
              Drag & Drop or <span class="text-[#007bff]">Choose file</span> to upload
            </p>
            <input id="uploadFile1" type="file" class="hidden" @change="handleFileChange" />
            <p class="mt-2 text-xs text-slate-400">PNG, JPG, SVG, WEBP, and GIF are Allowed.</p>
          </label>

          <div class="mt-5 flex justify-end gap-2">
            <button type="button" @click="closeAddProductForm" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-gray-100">
              Cancel
            </button>
            <button type="button" @click="submitAddProduct" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
              Save Product
            </button>
          </div>
        </div>

        <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
          <div class="mb-4 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-slate-900">Product List</h2>
            <input
              v-model="search"
              type="text"
              placeholder="Cari produk..."
              class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm text-slate-700 outline-none focus:border-blue-500 md:w-72"
            />
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-slate-50">
                <tr>
                  <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">ID</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Product Name</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Category</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Stock</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Price</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Status</th>
                  <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100 bg-white">
                <tr v-for="item in filteredProducts" :key="item.id">
                  <td class="px-4 py-4 text-sm font-medium text-slate-900">{{ item.id }}</td>
                  <td class="px-4 py-4 text-sm text-slate-700">{{ item.name }}</td>
                  <td class="px-4 py-4 text-sm text-slate-600">{{ item.category }}</td>
                  <td class="px-4 py-4 text-sm text-slate-600">{{ item.stock }}</td>
                  <td class="px-4 py-4 text-sm text-slate-600">{{ item.price }}</td>
                  <td class="px-4 py-4">
                    <span class="rounded-full px-3 py-1 text-xs font-semibold" :class="statusClass(item.status)">
                      {{ item.status }}
                    </span>
                  </td>
                  <td class="px-4 py-4 text-sm">
                    <div class="flex gap-2">
                      <button type="button" class="rounded-lg bg-blue-50 px-3 py-1 font-medium text-blue-600 hover:bg-blue-100">Edit</button>
                      <button type="button" class="rounded-lg bg-red-50 px-3 py-1 font-medium text-red-600 hover:bg-red-100">Delete</button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
