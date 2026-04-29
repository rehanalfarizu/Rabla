<script setup>
import { ref, watch, onBeforeUnmount, computed } from 'vue'
import ProductDetail from './ProductDetail.vue'

const selectedProductId = ref(null)

const openProductModal = (productId) => {
  selectedProductId.value = productId
}

const closeProductModal = () => {
  selectedProductId.value = null
}

watch(selectedProductId, (value) => {
  document.body.style.overflow = value ? 'hidden' : ''
})

onBeforeUnmount(() => {
  document.body.style.overflow = ''
})

const products = [
  {
    id: 1,
    name: 'New Ballance 530',
    brand: 'Brand',
    category: 'Sneakers',
    price: 149,
    oldPrice: 199,
    image: 'https://images.unsplash.com/photo-1709258228137-19a8c193be39?q=80&w=2011&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
  },
  {
    id: 2,
    name: 'Product Name',
    brand: 'Brand',
    category: 'Jacket',
    price: 149,
    oldPrice: 199,
    image: 'https://images.unsplash.com/photo-1651950537598-373e4358d320?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8Mjh8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60'
  },
  {
    id: 3,
    name: 'Product Name',
    brand: 'Brand',
    category: 'Dress',
    price: 149,
    oldPrice: 199,
    image: 'https://images.unsplash.com/photo-1651950519238-15835722f8bb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8MjV8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60'
  },
  {
    id: 4,
    name: 'Product Name',
    brand: 'Brand',
    category: 'Watch',
    price: 149,
    oldPrice: 199,
    image: 'https://images.unsplash.com/photo-1651950540805-b7c71869e689?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8Mjl8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60'
  },
  {
    id: 5,
    name: 'Product Name',
    brand: 'Brand',
    category: 'Sunglasses',
    price: 149,
    oldPrice: 199,
    image: 'https://images.unsplash.com/photo-1649261191624-ca9f79ca3fc6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NDd8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60'
  },
  {
    id: 6,
    name: 'Product Name',
    brand: 'Brand',
    category: 'Backpack',
    price: 149,
    oldPrice: 199,
    image: 'https://images.unsplash.com/photo-1649261191606-cb2496e97eee?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NDR8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60'
  }
]

const searchQuery = ref('')
const selectedCategory = ref('all')
const sortBy = ref('default')

const categories = computed(() => ['all', ...new Set(products.map((product) => product.category))])

const filteredProducts = computed(() => {
  const keyword = searchQuery.value.trim().toLowerCase()

  let result = products.filter((product) => {
    const matchCategory = selectedCategory.value === 'all' || product.category === selectedCategory.value
    const matchKeyword =
      keyword.length === 0 ||
      product.name.toLowerCase().includes(keyword) ||
      product.brand.toLowerCase().includes(keyword)

    return matchCategory && matchKeyword
  })

  if (sortBy.value === 'price-low') {
    result = [...result].sort((a, b) => a.price - b.price)
  }

  if (sortBy.value === 'price-high') {
    result = [...result].sort((a, b) => b.price - a.price)
  }

  return result
})

const resetFilter = () => {
  searchQuery.value = ''
  selectedCategory.value = 'all'
  sortBy.value = 'default'
}
</script>

<template>
  <div class="bg-gray-50 min-h-screen">
    <section class="py-22">
      <div class="w-full px-4 py-10">
        <div class="flex flex-col lg:flex-row gap-6">
          <div class="w-full max-w-75 shrink-0 shadow-md px-6 sm:px-8 min-h-screen py-6 bg-white rounded-xl">
            <div class="flex items-center border-b border-gray-300 pb-2 mb-6">
              <h3 class="text-slate-900 text-lg font-semibold">Filter</h3>
              <button type="button" class="text-sm text-red-500 font-semibold ml-auto cursor-pointer" @click="resetFilter">Clear all</button>
            </div>
            <div>
              <h6 class="text-slate-900 text-sm font-semibold">Brand</h6>
              <div class="flex px-3 py-1.5 rounded-md border border-gray-300 bg-gray-100 overflow-hidden mt-2">
                <input
                  v-model="searchQuery"
                  type="text"
                  placeholder="Search brand"
                  class="w-full bg-transparent outline-none text-gray-900 text-sm"
                />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" class="w-3 fill-gray-600">
                  <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"
                  ></path>
                </svg>
              </div>
              <ul class="mt-6 space-y-4">
                <li class="flex items-center gap-3">
                  <input id="zara" type="checkbox" class="w-4 h-4 cursor-pointer" />
                  <label for="zara" class="text-slate-600 font-medium text-sm cursor-pointer">Zara</label>
                </li>
                <li class="flex items-center gap-3">
                  <input id="hm" type="checkbox" class="w-4 h-4 cursor-pointer" />
                  <label for="hm" class="text-slate-600 font-medium text-sm cursor-pointer">H&M</label>
                </li>
                <li class="flex items-center gap-3">
                  <input id="uniqlo" type="checkbox" class="w-4 h-4 cursor-pointer" />
                  <label for="uniqlo" class="text-slate-600 font-medium text-sm cursor-pointer">Uniqlo</label>
                </li>
                <li class="flex items-center gap-3">
                  <input id="levis" type="checkbox" class="w-4 h-4 cursor-pointer" />
                  <label for="levis" class="text-slate-600 font-medium text-sm cursor-pointer">Levi’s</label>
                </li>
                <li class="flex items-center gap-3">
                  <input id="nike" type="checkbox" class="w-4 h-4 cursor-pointer" />
                  <label for="nike" class="text-slate-600 font-medium text-sm cursor-pointer">Nike</label>
                </li>
                <li class="flex items-center gap-3">
                  <input id="adidas" type="checkbox" class="w-4 h-4 cursor-pointer" />
                  <label for="adidas" class="text-slate-600 font-medium text-sm cursor-pointer">Adidas</label>
                </li>
                <li class="flex items-center gap-3">
                  <input id="puma" type="checkbox" class="w-4 h-4 cursor-pointer" />
                  <label for="puma" class="text-slate-600 font-medium text-sm cursor-pointer">Puma</label>
                </li>
                <li class="flex items-center gap-3">
                  <input id="tommy" type="checkbox" class="w-4 h-4 cursor-pointer" />
                  <label for="tommy" class="text-slate-600 font-medium text-sm cursor-pointer">Tommy Hilfiger</label>
                </li>
              </ul>
            </div>

            <hr class="my-6 border-gray-300" />

            <div>
              <h6 class="text-slate-900 text-sm font-semibold">Size</h6>
              <div class="flex flex-wrap gap-3 mt-4">
                <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">XS</button>
                <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">S</button>
                <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">M</button>
                <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">L</button>
                <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">XL</button>
                <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">XXL</button>
                <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">XXXL</button>
                <button type="button" class="cursor-pointer border border-gray-300 hover:border-blue-600 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">4XL</button>
              </div>
            </div>

            <hr class="my-6 border-gray-300" />

            <div>
              <h6 class="text-slate-900 text-sm font-semibold">Price</h6>
              <div class="relative mt-6">
                <div class="h-1.5 bg-gray-300 relative">
                  <div id="activeTrack" class="absolute h-1.5 bg-orange-400 rounded-full w-9/12"></div>
                </div>
                <input
                  type="range"
                  id="minRange"
                  min="0"
                  max="1000"
                  value="0"
                  class="absolute top-0 w-full h-1.5 bg-transparent appearance-none cursor-pointer [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:bg-orange-500 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-white [&::-webkit-slider-thumb]:shadow-md [&::-webkit-slider-thumb]:cursor-pointer [&::-moz-range-thumb]:w-5 [&::-moz-range-thumb]:h-5 [&::-moz-range-thumb]:bg-orange-400 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-white [&::-moz-range-thumb]:shadow-md [&::-moz-range-thumb]:cursor-pointer [&::-moz-range-thumb]:border-none"
                />

                <input
                  type="range"
                  id="maxRange"
                  min="0"
                  max="1000"
                  value="750"
                  class="absolute top-0 w-full h-1.5 bg-transparent appearance-none cursor-pointer [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:bg-orange-500 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-white [&::-webkit-slider-thumb]:shadow-md [&::-webkit-slider-thumb]:cursor-pointer [&::-moz-range-thumb]:w-5 [&::-moz-range-thumb]:h-5 [&::-moz-range-thumb]:bg-orange-400 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-white [&::-moz-range-thumb]:shadow-md [&::-moz-range-thumb]:cursor-pointer [&::-moz-range-thumb]:border-none"
                />

                <div class="flex justify-between text-slate-600 font-medium text-sm mt-4">
                  <span id="minPrice">$750</span>
                  <span id="maxPrice">$1000</span>
                </div>
              </div>
            </div>

            <hr class="my-6 border-gray-300" />

            <div>
              <h6 class="text-slate-900 text-sm font-semibold">Color</h6>
              <div class="flex flex-wrap gap-3 mt-4">
                <button type="button" class="cursor-pointer rounded-full text-[13px] text-white font-medium bg-blue-700 w-8 h-8 hover:scale-[1.05] transition-all"></button>
                <button type="button" class="cursor-pointer rounded-full text-[13px] text-white font-medium bg-purple-700 w-8 h-8 hover:scale-[1.05] transition-all"></button>
                <button type="button" class="cursor-pointer rounded-full text-[13px] text-white font-medium bg-pink-700 w-8 h-8 hover:scale-[1.05] transition-all"></button>
                <button type="button" class="cursor-pointer rounded-full text-[13px] text-white font-medium bg-orange-700 w-8 h-8 hover:scale-[1.05] transition-all"></button>
                <button type="button" class="cursor-pointer rounded-full text-[13px] text-white font-medium bg-red-700 w-8 h-8 hover:scale-[1.05] transition-all"></button>
                <button type="button" class="cursor-pointer rounded-full text-[13px] text-white font-medium bg-yellow-700 w-8 h-8 hover:scale-[1.05] transition-all"></button>
                <button type="button" class="cursor-pointer rounded-full text-[13px] text-white font-medium bg-black w-8 h-8 hover:scale-[1.05] transition-all"></button>
                <button type="button" class="cursor-pointer rounded-full text-[13px] text-white font-medium bg-gray-700 w-8 h-8 hover:scale-[1.05] transition-all"></button>
              </div>
            </div>
          </div>

          <div class="w-full p-6">
            <div class="bg-white p-4 mx-auto max-w-7xl">
              <h2 class="text-xl sm:text-3xl font-bold text-slate-900 mb-6 sm:mb-8">Premium Threads</h2>

              <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                <div
                  v-for="product in filteredProducts"
                  :key="product.id"
                  class="group overflow-hidden relative cursor-pointer"
                  @click="openProductModal(product.id)"
                >
                  <div class="block">
                    <div class="aspect-3/4 bg-slate-100 w-full overflow-hidden">
                      <img
                        :src="product.image"
                        :alt="product.name"
                        class="w-full h-full object-cover object-top hover:scale-110 transition-all duration-700"
                      />
                    </div>
                  </div>
                  <div class="p-4 relative">
                    <div class="flex flex-wrap justify-between gap-2 w-full absolute px-4 pt-3 z-10 transition-all duration-500 left-0 right-0 group-hover:bottom-20 lg:bottom-5 lg:opacity-0 lg:bg-white lg:group-hover:opacity-100 max-lg:bottom-20 max-lg:py-3 max-lg:bg-white/60">
                      <button type="button" title="Add to wishlist" class="bg-transparent outline-0 border-0 cursor-pointer" @click.stop>
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-slate-800 w-5 h-5 inline-block" viewBox="0 0 64 64">
                          <path
                            d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                            data-original="#000000"></path>
                        </svg>
                      </button>
                      <button type="button" title="Add to cart" class="bg-transparent outline-0 border-0 cursor-pointer" @click.stop>
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-slate-800 w-5 h-5 inline-block" viewBox="0 0 512 512">
                          <path
                            d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                            data-original="#000000"></path>
                        </svg>
                      </button>
                    </div>
                    <div class="z-20 relative bg-white">
                      <h6 class="text-[15px] font-semibold text-slate-900 truncate">{{ product.name }}</h6>
                      <h6 class="text-sm text-slate-600 font-medium mt-2">Rp{{ product.price }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div
              v-if="filteredProducts.length === 0"
              class="max-w-7xl mx-auto text-center bg-white border border-gray-200 rounded-xl p-10 mt-6"
            >
              <p class="text-lg font-semibold text-gray-700">Produk tidak ditemukan</p>
              <p class="text-sm text-gray-500 mt-1">Coba ubah kata kunci atau kategori filter.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div
      v-if="selectedProductId"
      class="fixed inset-0 z-50 bg-black/50 px-4 py-6 overflow-y-auto"
      @click.self="closeProductModal"
    >
      <div class="w-full max-w-6xl mx-auto">
        <ProductDetail
          :product-id="selectedProductId"
          :is-modal="true"
          @close="closeProductModal"
        />
      </div>
    </div>
  </div>
</template>
