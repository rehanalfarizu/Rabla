<script setup>
import { RouterLink, useRoute } from 'vue-router'
import { ref, computed, watch, onMounted } from 'vue'
import api from '../api'

const props = defineProps({
  productId: {
    type: [String, Number],
    default: null
  },
  isModal: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['close'])

const route = useRoute()

const product = ref(null)
const loading = ref(true)
const error = ref(null)

const mainImage = ref('')
const quantity = ref(1)
const selectedColor = ref('')
const selectedSize = ref('')
const activeTab = ref('details')

const fetchProduct = async (id) => {
  loading.value = true
  error.value = null
  try {
    const response = await api.get(`/api/products/${String(id)}`)
    const data = response.data

    // Handle MongoDB Decimal128 price as string
    const priceValue = typeof data.price === 'string' ? parseFloat(data.price) : (data.price || 0)
    const comparePriceValue = data.compare_price
      ? (typeof data.compare_price === 'string' ? parseFloat(data.compare_price) : data.compare_price)
      : null

    product.value = {
      id: data.id || data._id,
      name: data.name || '',
      brand: data.brand || '',
      price: priceValue,
      oldPrice: comparePriceValue,
      rating: parseFloat(data.rating) || 4.5,
      reviews: 0,
      sku: data.sku || '',
      image: (data.images && data.images[0]) || '',
      gallery: data.images || [],
      description: data.description || '',
      category: data.category?.name || data.category_name || 'Uncategorized',
      tags: data.tags || [],
      colors: data.colors || [],
      sizes: data.sizes || [],
      stock: data.stock || 0,
      inStock: data.stock > 0,
    }

    mainImage.value = product.value.image

    if (product.value.colors.length > 0) {
      selectedColor.value = product.value.colors[0]
    }
    if (product.value.sizes.length > 0) {
      selectedSize.value = product.value.sizes[0]
    }
  } catch (err) {
    error.value = err.message || 'Failed to fetch product'
    console.error('Error fetching product:', err)
  } finally {
    loading.value = false
  }
}

const resolvedProductId = computed(() => {
  if (props.productId) return props.productId
  return route.params.id
})

onMounted(() => {
  if (resolvedProductId.value) {
    fetchProduct(resolvedProductId.value)
  }
})

watch(() => props.productId, (newId) => {
  if (newId) fetchProduct(newId)
})

watch(() => route.params.id, (newId) => {
  if (newId && !props.productId) fetchProduct(newId)
})

watch(product, (newProduct) => {
  if (newProduct) {
    mainImage.value = newProduct.image || newProduct.gallery?.[0] || ''
    quantity.value = 1
  }
}, { immediate: true })

const discount = computed(() => {
  if (product.value?.oldPrice && product.value?.price) {
    return Math.round(((product.value.oldPrice - product.value.price) / product.value.oldPrice) * 100)
  }
  return 0
})

const renderStars = (rating) => {
  return Array(Math.round(rating)).fill(0)
}

const starSlots = computed(() => Array(5).fill(0))

const colorOptions = computed(() => {
  if (!product.value?.colors?.length) {
    return [
      { id: 'white', className: 'bg-white' },
      { id: 'gray', className: 'bg-gray-200' },
      { id: 'black', className: 'bg-black' }
    ]
  }
  return product.value.colors.map(c => ({ id: c, className: `bg-${c}` }))
})

const sizeOptions = computed(() => {
  if (!product.value?.sizes?.length) {
    return ['40.5', '41', '42', '43', '43.5', '44', '44.5', '45']
  }
  return product.value.sizes
})

const formatPrice = (price) => {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
  }).format(price)
}

const handleAddToCart = async () => {
  if (!product.value) return

  try {
    const token = localStorage.getItem('auth_token')
    if (!token) {
      alert('Please login to add items to cart')
      return
    }

    await api.post('/api/cart', {
      product_id: product.value.id,
      quantity: quantity.value,
      size: selectedSize.value,
      color: selectedColor.value
    })

    alert('Product added to cart!')
  } catch (err) {
    console.error('Error adding to cart:', err)
    alert('Failed to add to cart. Please try again.')
  }
}
</script>

<template>
  <div :class="isModal ? '' : 'min-h-screen flex items-center justify-center py-10 px-4'">
    <div class="relative w-full max-w-6xl bg-white rounded-xl border border-gray-300 overflow-hidden">

      <button
        v-if="isModal"
        type="button"
        @click="emit('close')"
        class="absolute top-4 right-4 w-8 h-8 bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-black rounded-full flex items-center justify-center z-10 transition-colors"
      >
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>

      <RouterLink
        v-else
        to="/products"
        class="absolute top-4 right-4 w-8 h-8 bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-black rounded-full flex items-center justify-center z-10 transition-colors"
      >
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </RouterLink>

      <!-- Loading State -->
      <div v-if="loading" class="p-8 text-center">
        <svg class="animate-spin h-8 w-8 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p class="mt-4 text-gray-500">Loading product...</p>
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="p-8 text-center text-red-500">
        <p>{{ error }}</p>
      </div>

      <!-- Product Content -->
      <template v-else-if="product">
        <div class="px-6 pt-6 pb-2">
          <div class="flex items-center gap-2 text-sm text-gray-500">
            <span class="hover:text-orange-400 cursor-pointer">Home</span>
            <span>/</span>
            <span class="hover:text-orange-400 cursor-pointer">{{ product.category }}</span>
            <span>/</span>
            <span class="hover:text-orange-400 cursor-pointer">{{ product.brand }}</span>
          </div>
        </div>

        <main class="px-6 pb-8 pt-4">
          <div class="grid md:grid-cols-2 gap-8">
            <div class="space-y-4">
              <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden">
                <img v-if="mainImage" :src="mainImage" :alt="product.name" class="w-full h-full object-cover" />
                <div v-else class="w-full h-full flex items-center justify-center text-gray-400">No image</div>
              </div>
              <div class="grid grid-cols-4 gap-4">
                <button
                  v-for="(img, idx) in product.gallery"
                  :key="idx"
                  type="button"
                  @click="mainImage = img"
                  :class="[
                    'aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 transition-colors',
                    mainImage === img ? 'border-orange-400' : 'border-transparent hover:border-orange-400'
                  ]"
                >
                  <img :src="img" :alt="`Thumbnail ${idx + 1}`" class="w-full h-full object-cover" />
                </button>
              </div>
            </div>

            <div class="space-y-6">
              <div class="flex items-start justify-between gap-4">
                <div>
                  <div class="flex items-center gap-2 mb-2">
                    <span class="font-medium">{{ product.brand }}</span>
                  </div>
                  <h1 class="text-3xl font-bold mb-2">{{ product.name }}</h1>
                  <div class="text-3xl font-bold text-gray-900">{{ formatPrice(product.price) }}</div>
                  <div v-if="product.oldPrice" class="text-lg text-gray-400 line-through">{{ formatPrice(product.oldPrice) }}</div>
                  <div v-if="discount > 0" class="text-sm text-orange-500 font-medium">{{ discount }}% Off</div>
                  <div class="flex items-center gap-2 mt-2">
                    <div class="flex items-center">
                      <svg
                        v-for="(slot, index) in starSlots"
                        :key="index"
                        class="w-5 h-5"
                        :class="index < Math.round(product.rating) ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current'"
                        viewBox="0 0 20 20"
                      >
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                      </svg>
                    </div>
                    <span class="text-sm text-gray-500">({{ product.reviews }} reviews)</span>
                  </div>
                </div>
              </div>

              <div>
                <h3 class="font-medium mb-3">Color</h3>
                <div class="flex flex-wrap gap-3">
                  <button
                    v-for="color in (product.colors.length ? product.colors : ['white', 'gray', 'black'])"
                    :key="color"
                    type="button"
                    @click="selectedColor = color"
                    :class="[
                      'w-12 h-12 rounded-lg bg-gray-100 border-2 p-0.5',
                      selectedColor === color ? 'border-orange-400' : 'border-transparent hover:border-orange-400'
                    ]"
                  >
                    <span class="block w-full h-full rounded" :class="`bg-${color}`"></span>
                  </button>
                </div>
              </div>

              <div>
                <div class="flex items-center justify-between mb-3">
                  <h3 class="font-medium">Size</h3>
                  <button type="button" class="text-black underline text-sm">Size guide</button>
                </div>
                <div class="grid grid-cols-4 gap-2">
                  <button
                    v-for="size in (product.sizes.length ? product.sizes : ['40.5', '41', '42', '43', '43.5', '44', '44.5', '45'])"
                    :key="size"
                    type="button"
                    @click="selectedSize = size"
                    :class="[
                      'py-3 border rounded-lg transition-colors',
                      selectedSize === size
                        ? 'bg-orange-400 text-white border-orange-400'
                        : 'border-gray-200 hover:border-orange-400'
                  ]"
                  >
                    {{ size }}
                  </button>
                </div>
              </div>

              <div class="flex gap-4 items-center">
                <div class="flex items-center gap-2 border border-gray-300 rounded-full px-2 py-2">
                  <button type="button" @click="quantity > 1 ? quantity-- : null" class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 rounded-full">-</button>
                  <input v-model="quantity" type="number" min="1" class="w-10 text-center font-medium outline-none" />
                  <button type="button" @click="quantity++" class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 rounded-full">+</button>
                </div>

                <button
                  @click="handleAddToCart"
                  class="flex-1 bg-orange-400 text-white py-4 rounded-xl hover:bg-orange-500 transition-colors"
                >
                  Add to Cart
                </button>

                <button type="button" class="w-14 h-14 flex items-center justify-center border border-gray-200 rounded-xl hover:border-orange-400">
                  <i class="ri-shopping-bag-line text-2xl"></i>
                </button>
              </div>

              <div class="flex items-center gap-2 text-sm text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                <span>Free delivery on orders over Rp300.000</span>
              </div>
            </div>
          </div>

          <div class="mt-16">
            <div class="border-b border-gray-200">
              <div class="flex gap-8 overflow-auto">
                <button
                  type="button"
                  @click="activeTab = 'details'"
                  :class="activeTab === 'details' ? 'px-4 py-2 text-orange-400 border-b-2 border-orange-400' : 'px-4 py-2 text-gray-500'"
                >
                  Details
                </button>
                <button
                  type="button"
                  @click="activeTab = 'reviews'"
                  :class="activeTab === 'reviews' ? 'px-4 py-2 text-orange-400 border-b-2 border-orange-400' : 'px-4 py-2 text-gray-500'"
                >
                  Reviews
                </button>
              </div>
            </div>

            <div class="mt-8 grid md:grid-cols-2 gap-8" v-if="activeTab === 'details'">
              <div class="space-y-6">
                <div class="bg-gray-50 rounded-xl p-5">
                  <h4 class="font-semibold text-gray-900 mb-2">Product Description</h4>
                  <p class="text-sm text-gray-600 leading-relaxed">{{ product.description || 'No description available.' }}</p>
                </div>
              </div>

              <div class="bg-gray-50 rounded-xl p-5">
                <h4 class="font-semibold text-gray-900 mb-3">Product Info</h4>
                <div class="space-y-2 text-sm text-gray-600">
                  <div><span class="font-medium text-gray-800">Category:</span> {{ product.category }}</div>
                  <div><span class="font-medium text-gray-800">SKU:</span> {{ product.sku || 'N/A' }}</div>
                  <div><span class="font-medium text-gray-800">Stock:</span> {{ product.stock > 0 ? `${product.stock} units` : 'Out of Stock' }}</div>
                  <div v-if="discount > 0"><span class="font-medium text-gray-800">Discount:</span> {{ discount }}% Off</div>
                  <div v-if="product.tags?.length" class="flex flex-wrap gap-2 pt-2">
                    <span v-for="tag in product.tags" :key="tag" class="text-xs text-gray-600 bg-gray-200/70 px-3 py-1 rounded-full">{{ tag }}</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-8" v-if="activeTab === 'reviews'">
              <div class="text-center text-gray-500 py-8">
                <p>No reviews yet for this product.</p>
              </div>
            </div>
          </div>
        </main>
      </template>
    </div>
  </div>
</template>