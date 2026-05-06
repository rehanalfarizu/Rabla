<script setup>
import { ref, watch, onBeforeUnmount, computed } from 'vue'
import ProductDetail from './ProductDetail.vue'

// ─── Modal ────────────────────────────────────────────────────────────────────
const selectedProductId = ref(null)
const openProductModal = (id) => { selectedProductId.value = id }
const closeProductModal = () => { selectedProductId.value = null }
watch(selectedProductId, (v) => { document.body.style.overflow = v ? 'hidden' : '' })
onBeforeUnmount(() => { document.body.style.overflow = '' })

// ─── Mock product data (ganti dengan API call nanti) ─────────────────────────
const products = [
  { id: 1,  name: 'New Balance 530',    brand: 'New Balance', category: 'Sneakers',    price: 1490000, oldPrice: 1990000, rating: 4.5, stock: true,  colors: ['blue','gray'],       sizes: ['40','41','42','43'], image: 'https://via.placeholder.com/300x300?text=NB+530' }, 
  { id: 2,  name: 'Puffer Jacket',       brand: 'Uniqlo',      category: 'Jacket',      price: 899000,  oldPrice: 1200000, rating: 4.0, stock: true,  colors: ['black','orange'],    sizes: ['S','M','L','XL'], image: 'https://images.unsplash.com/photo-1551028719-00167b16eac5?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' },
  { id: 3,  name: 'Floral Dress',        brand: 'Zara',        category: 'Dress',       price: 750000,  oldPrice: 950000,  rating: 3.5, stock: false, colors: ['pink','white'],      sizes: ['XS','S','M'], image: 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' },
  { id: 4,  name: 'Classic Watch',       brand: 'Adidas',      category: 'Watch',       price: 2500000, oldPrice: 3000000, rating: 5.0, stock: true,  colors: ['black'],             sizes: [], image: 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' },
  { id: 5,  name: 'Aviator Sunglasses',  brand: 'Zara',        category: 'Sunglasses',  price: 450000,  oldPrice: 600000,  rating: 4.2, stock: true,  colors: ['black','yellow'],    sizes: [], image: 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' },
  { id: 6,  name: 'Canvas Backpack',     brand: 'Nike',        category: 'Backpack',    price: 690000,  oldPrice: 890000,  rating: 3.8, stock: false, colors: ['gray','blue'],       sizes: [], image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' },
  { id: 7,  name: 'Slim Chinos',         brand: "Levi's",      category: 'Pants',       price: 580000,  oldPrice: 750000,  rating: 4.1, stock: true,  colors: ['black','orange'],    sizes: ['S','M','L','XL','XXL'], image: 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' },
  { id: 8,  name: 'Polo Shirt',          brand: 'H&M',         category: 'Tops',        price: 320000,  oldPrice: 420000,  rating: 3.0, stock: true,  colors: ['white','blue','red'], sizes: ['S','M','L'], image: 'https://images.unsplash.com/photo-1581655353564-df123a1eb820?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' },
]

// ─── Filter State ─────────────────────────────────────────────────────────────
const searchQuery     = ref('')
const selectedCategory = ref('all')
const priceMin        = ref(0)
const priceMax        = ref(3000000)
const minRating       = ref(0)           // 0 = semua rating
const stockOnly       = ref(false)
const selectedBrands  = ref([])          // array brand yang dipilih
const selectedColors  = ref([])          // array warna yang dipilih
const selectedSizes   = ref([])          // array ukuran yang dipilih
const sortBy          = ref('default')
const brandSearch     = ref('')

// ─── Static option lists ──────────────────────────────────────────────────────
const allBrands  = [...new Set(products.map(p => p.brand))].sort()
const allColors  = [
  { value: 'red',    label: 'Merah',  hex: '#dc2626' },
  { value: 'blue',   label: 'Biru',   hex: '#1d4ed8' },
  { value: 'black',  label: 'Hitam',  hex: '#111827' },
  { value: 'white',  label: 'Putih',  hex: '#f3f4f6', border: true },
  { value: 'gray',   label: 'Abu',    hex: '#6b7280' },
  { value: 'pink',   label: 'Pink',   hex: '#db2777' },
  { value: 'orange', label: 'Orange', hex: '#ea580c' },
  { value: 'yellow', label: 'Kuning', hex: '#ca8a04' },
  { value: 'purple', label: 'Ungu',   hex: '#7c3aed' },
]
const allSizes   = ['XS','S','M','L','XL','XXL','XXXL','38','39','40','41','42','43']
const allCategories = computed(() => ['all', ...new Set(products.map(p => p.category))])
const filteredBrands = computed(() =>
  allBrands.filter(b => b.toLowerCase().includes(brandSearch.value.toLowerCase()))
)

// ─── Filtered Products ────────────────────────────────────────────────────────
const filteredProducts = computed(() => {
  const kw = searchQuery.value.trim().toLowerCase()

  let result = products.filter(p => {
    const matchCat    = selectedCategory.value === 'all' || p.category === selectedCategory.value
    const matchKw     = !kw || p.name.toLowerCase().includes(kw) || p.brand.toLowerCase().includes(kw)
    const matchPrice  = p.price >= priceMin.value && p.price <= priceMax.value
    const matchRating = p.rating >= minRating.value
    const matchStock  = !stockOnly.value || p.stock
    const matchBrand  = selectedBrands.value.length === 0 || selectedBrands.value.includes(p.brand)
    const matchColor  = selectedColors.value.length === 0 || p.colors.some(c => selectedColors.value.includes(c))
    const matchSize   = selectedSizes.value.length === 0 || p.sizes.some(s => selectedSizes.value.includes(s))
    return matchCat && matchKw && matchPrice && matchRating && matchStock && matchBrand && matchColor && matchSize
  })

  if (sortBy.value === 'price-low')    result = [...result].sort((a, b) => a.price - b.price)
  if (sortBy.value === 'price-high')   result = [...result].sort((a, b) => b.price - a.price)
  if (sortBy.value === 'rating-high')  result = [...result].sort((a, b) => b.rating - a.rating)
  if (sortBy.value === 'newest')       result = [...result].sort((a, b) => b.id - a.id)

  return result
})

// ─── Active filter count (badge) ─────────────────────────────────────────────
const activeFilterCount = computed(() => {
  let n = 0
  if (selectedCategory.value !== 'all') n++
  if (priceMin.value > 0 || priceMax.value < 3000000) n++
  if (minRating.value > 0) n++
  if (stockOnly.value) n++
  if (selectedBrands.value.length) n += selectedBrands.value.length
  if (selectedColors.value.length) n += selectedColors.value.length
  if (selectedSizes.value.length) n += selectedSizes.value.length
  return n
})

// ─── Helpers ──────────────────────────────────────────────────────────────────
const toggleArr = (arr, val) => {
  const i = arr.indexOf(val)
  i === -1 ? arr.push(val) : arr.splice(i, 1)
}
const fmtPrice = (v) => 'Rp' + v.toLocaleString('id-ID')

const resetFilter = () => {
  searchQuery.value     = ''
  selectedCategory.value = 'all'
  priceMin.value        = 0
  priceMax.value        = 3000000
  minRating.value       = 0
  stockOnly.value       = false
  selectedBrands.value  = []
  selectedColors.value  = []
  selectedSizes.value   = []
  sortBy.value          = 'default'
  brandSearch.value     = ''
}

// Mobile sidebar toggle
const sidebarOpen = ref(false)
</script>

<template>
  <div class="bg-gray-50 min-h-screen">
    <section class="py-22">
      <div class="w-full px-4 py-10">

        <!-- Topbar: search + sort + mobile filter toggle -->
        <div class="flex flex-wrap items-center gap-3 mb-6 max-w-screen-xl mx-auto">
          <!-- Search -->
          <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-4 py-2 flex-1 min-w-48 shadow-sm">
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input v-model="searchQuery" type="text" placeholder="Cari produk atau brand..." class="w-full text-sm outline-none text-gray-800 bg-transparent" />
          </div>

          <!-- Sort -->
          <select v-model="sortBy" class="bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 shadow-sm outline-none cursor-pointer">
            <option value="default">Urutkan: Default</option>
            <option value="price-low">Harga: Terendah</option>
            <option value="price-high">Harga: Tertinggi</option>
            <option value="rating-high">Rating Tertinggi</option>
            <option value="newest">Terbaru</option>
          </select>

          <!-- Mobile filter toggle -->
          <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm font-medium text-gray-700 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="16" y2="12"/><line x1="4" y1="18" x2="12" y2="18"/></svg>
            Filter
            <span v-if="activeFilterCount > 0" class="bg-orange-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ activeFilterCount }}</span>
          </button>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 max-w-screen-xl mx-auto">

          <!-- ─── SIDEBAR ──────────────────────────────────────────────────── -->
          <aside :class="['w-full lg:max-w-72 shrink-0 shadow-md px-6 py-6 bg-white rounded-xl self-start sticky top-24 transition-all duration-300',
                          sidebarOpen ? 'block' : 'hidden lg:block']">

            <!-- Header -->
            <div class="flex items-center border-b border-gray-200 pb-3 mb-5">
              <h3 class="text-slate-900 text-base font-bold">Filter Produk</h3>
              <button v-if="activeFilterCount > 0" @click="resetFilter"
                class="ml-auto text-xs text-red-500 font-semibold hover:text-red-700 transition-colors cursor-pointer">
                Reset ({{ activeFilterCount }})
              </button>
            </div>

            <!-- ① Kategori -->
            <div class="mb-5">
              <h6 class="text-slate-800 text-sm font-semibold mb-3">Kategori</h6>
              <div class="flex flex-wrap gap-2">
                <button
                  v-for="cat in allCategories" :key="cat"
                  @click="selectedCategory = cat"
                  :class="['px-3 py-1 rounded-full text-xs font-medium border transition-all cursor-pointer',
                           selectedCategory === cat
                             ? 'bg-slate-900 text-white border-slate-900'
                             : 'bg-white text-slate-600 border-gray-300 hover:border-slate-500']">
                  {{ cat === 'all' ? 'Semua' : cat }}
                </button>
              </div>
            </div>

            <hr class="my-4 border-gray-200" />

            <!-- ② Harga -->
            <div class="mb-5">
              <h6 class="text-slate-800 text-sm font-semibold mb-3">Rentang Harga</h6>
              <div class="flex justify-between text-xs text-slate-500 mb-2">
                <span>{{ fmtPrice(priceMin) }}</span>
                <span>{{ fmtPrice(priceMax) }}</span>
              </div>
              <div class="space-y-2">
                <div class="flex items-center gap-2">
                  <span class="text-xs text-gray-400 w-6">Min</span>
                  <input type="range" v-model.number="priceMin" min="0" max="3000000" step="50000"
                    class="flex-1 accent-orange-500 cursor-pointer" />
                </div>
                <div class="flex items-center gap-2">
                  <span class="text-xs text-gray-400 w-6">Max</span>
                  <input type="range" v-model.number="priceMax" min="0" max="3000000" step="50000"
                    class="flex-1 accent-orange-500 cursor-pointer" />
                </div>
              </div>
            </div>

            <hr class="my-4 border-gray-200" />

            <!-- ③ Rating -->
            <div class="mb-5">
              <h6 class="text-slate-800 text-sm font-semibold mb-3">Rating Minimum</h6>
              <div class="space-y-2">
                <label v-for="r in [0,3,3.5,4,4.5,5]" :key="r"
                  class="flex items-center gap-2 cursor-pointer group">
                  <input type="radio" :value="r" v-model.number="minRating" class="accent-orange-500 cursor-pointer" />
                  <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">
                    <template v-if="r === 0">Semua rating</template>
                    <template v-else>
                      <span class="text-orange-400">{{ '★'.repeat(Math.floor(r)) }}{{ r % 1 ? '½' : '' }}</span>
                      {{ r }}+
                    </template>
                  </span>
                </label>
              </div>
            </div>

            <hr class="my-4 border-gray-200" />

            <!-- ④ Status Stok -->
            <div class="mb-5">
              <h6 class="text-slate-800 text-sm font-semibold mb-3">Ketersediaan</h6>
              <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" v-model="stockOnly" class="w-4 h-4 accent-orange-500 cursor-pointer" />
                <span class="text-sm text-slate-600">Hanya tampilkan yang tersedia</span>
              </label>
            </div>

            <hr class="my-4 border-gray-200" />

            <!-- ⑤ Brand -->
            <div class="mb-5">
              <h6 class="text-slate-800 text-sm font-semibold mb-3">Brand</h6>
              <div class="flex items-center gap-2 bg-gray-100 border border-gray-200 rounded-md px-3 py-1.5 mb-3">
                <svg class="w-3 h-3 fill-gray-400 shrink-0" viewBox="0 0 192.904 192.904">
                  <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"/>
                </svg>
                <input v-model="brandSearch" type="text" placeholder="Cari brand..." class="bg-transparent w-full text-sm outline-none text-gray-800" />
              </div>
              <ul class="space-y-2 max-h-40 overflow-y-auto pr-1">
                <li v-for="brand in filteredBrands" :key="brand" class="flex items-center gap-2">
                  <input
                    :id="'brand-' + brand"
                    type="checkbox"
                    :value="brand"
                    v-model="selectedBrands"
                    class="w-4 h-4 accent-orange-500 cursor-pointer"
                  />
                  <label :for="'brand-' + brand" class="text-sm text-slate-600 cursor-pointer hover:text-slate-900 transition-colors">{{ brand }}</label>
                </li>
                <li v-if="filteredBrands.length === 0" class="text-xs text-gray-400">Brand tidak ditemukan</li>
              </ul>
            </div>

            <hr class="my-4 border-gray-200" />

            <!-- ⑥ Warna -->
            <div class="mb-5">
              <h6 class="text-slate-800 text-sm font-semibold mb-3">Warna</h6>
              <div class="flex flex-wrap gap-2">
                <button
                  v-for="color in allColors" :key="color.value"
                  @click="toggleArr(selectedColors, color.value)"
                  :title="color.label"
                  :style="{ backgroundColor: color.hex }"
                  :class="['w-8 h-8 rounded-full transition-all cursor-pointer hover:scale-110',
                           color.border ? 'border border-gray-300' : '',
                           selectedColors.includes(color.value) ? 'ring-2 ring-offset-2 ring-slate-800 scale-110' : '']">
                </button>
              </div>
              <div v-if="selectedColors.length > 0" class="flex flex-wrap gap-1 mt-2">
                <span v-for="c in selectedColors" :key="c"
                  class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">
                  {{ allColors.find(x => x.value === c)?.label }}
                </span>
              </div>
            </div>

            <hr class="my-4 border-gray-200" />

            <!-- ⑦ Ukuran -->
            <div class="mb-2">
              <h6 class="text-slate-800 text-sm font-semibold mb-3">Ukuran</h6>
              <div class="flex flex-wrap gap-2">
                <button
                  v-for="size in allSizes" :key="size"
                  @click="toggleArr(selectedSizes, size)"
                  :class="['px-3 py-1 rounded-md border text-xs font-medium transition-all cursor-pointer',
                           selectedSizes.includes(size)
                             ? 'bg-slate-900 text-white border-slate-900'
                             : 'bg-white text-slate-600 border-gray-300 hover:border-slate-500']">
                  {{ size }}
                </button>
              </div>
            </div>

          </aside>

          <!-- ─── PRODUCT GRID ──────────────────────────────────────────────── -->
          <div class="w-full p-6">
            <div class="bg-white p-4 mx-auto max-w-7xl rounded-xl">
              <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl sm:text-3xl font-bold text-slate-900">Premium Threads</h2>
                <span class="text-sm text-gray-400">{{ filteredProducts.length }} produk</span>
              </div>

              <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                <div
                  v-for="product in filteredProducts" :key="product.id"
                  class="group overflow-hidden relative cursor-pointer"
                  @click="openProductModal(product.id)"
                >
                  <div class="aspect-3/4 bg-slate-100 w-full overflow-hidden">
                    <img :src="product.image" :alt="product.name"
                      class="w-full h-full object-cover object-top hover:scale-110 transition-all duration-700" />
                    <!-- Stock badge -->
                    <span v-if="!product.stock"
                      class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                      Habis
                    </span>
                  </div>
                  <div class="p-4 relative">
                    <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10 transition-all duration-500 left-0 right-0 group-hover:bottom-20 lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100 max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
                      <button type="button" title="Wishlist" class="bg-transparent outline-0 border-0 cursor-pointer" @click.stop>
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-slate-800 w-5 h-5" viewBox="0 0 64 64">
                          <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"/>
                        </svg>
                      </button>
                      <button type="button" title="Add to cart" class="bg-transparent outline-0 border-0 cursor-pointer" @click.stop>
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-slate-800 w-5 h-5" viewBox="0 0 512 512">
                          <path d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"/>
                        </svg>
                      </button>
                    </div>
                    <div class="z-20 relative bg-white">
                      <h6 class="text-[15px] font-semibold text-slate-900 truncate">{{ product.name }}</h6>
                      <div class="flex items-center gap-1 mt-1">
                        <span class="text-orange-400 text-xs">{{ '★'.repeat(Math.floor(product.rating)) }}</span>
                        <span class="text-xs text-gray-400">({{ product.rating }})</span>
                      </div>
                      <h6 class="text-sm text-slate-600 font-medium mt-1">{{ fmtPrice(product.price) }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Empty state -->
            <div v-if="filteredProducts.length === 0"
              class="max-w-7xl mx-auto text-center bg-white border border-gray-200 rounded-xl p-10 mt-6">
              <p class="text-lg font-semibold text-gray-700">Produk tidak ditemukan</p>
              <p class="text-sm text-gray-500 mt-1">Coba ubah filter atau kata kunci pencarian.</p>
              <button @click="resetFilter" class="mt-4 px-5 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-700 transition-colors cursor-pointer">
                Reset Filter
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ─── Product Modal ──────────────────────────────────────────────────── -->
    <div v-if="selectedProductId"
      class="fixed inset-0 z-50 bg-black/50 px-4 py-6 overflow-y-auto"
      @click.self="closeProductModal">
      <div class="w-full max-w-6xl mx-auto">
        <ProductDetail :product-id="selectedProductId" :is-modal="true" @close="closeProductModal" />
      </div>
    </div>
  </div>
</template>
