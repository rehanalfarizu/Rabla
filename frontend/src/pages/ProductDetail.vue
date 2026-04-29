<script setup>
import { RouterLink, useRoute } from 'vue-router'
import { ref, computed, watch } from 'vue'

const props = defineProps({
  productId: {
    type: Number,
    default: null
  },
  isModal: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['close'])

const route = useRoute()

const productDatabase = {
  1: {
    id: 1,
    name: 'New Balance 530',
    brand: 'New Balance',
    price: 89.28,
    oldPrice: 149,
    rating: 5,
    reviews: 124,
    sku: '2,51,594',
    image: 'https://images.unsplash.com/photo-1709258228137-19a8c193be39?q=80&w=2011&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
    gallery: [
      'https://images.unsplash.com/photo-1709258228137-19a8c193be39?q=80&w=2011&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
      'https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1551028719-00167b16ebc5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1552820728-8ac41f1ce891?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ],
    description: 'Experience premium comfort with New Balance 530 sneakers. Engineered with cutting-edge cushioning technology and breathable materials for all-day wearability. Perfect for sports, casual wear, or everyday activities.',
    category: 'Sneakers',
    tags: ['Sneakers', 'Sports', 'Casual', 'New Balance', 'Comfortable', 'Athletic'],
    inStock: true,
    quantity: 1
  },
  2: {
    id: 2,
    name: 'Classic Leather Jacket',
    brand: 'Fashion Pro',
    price: 120.00,
    oldPrice: 199,
    rating: 5,
    reviews: 89,
    sku: '2,51,595',
    image: 'https://images.unsplash.com/photo-1651950519238-15835722f8bb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8MjV8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60',
    gallery: [
      'https://images.unsplash.com/photo-1651950519238-15835722f8bb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8MjV8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1520989541350-1e1e3f4f4b5f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1495927904b68e0dba5bfdde3d37b2f735f74cc0e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1495927904b68e0dba5bfdde3d37b2f735f74cc0e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ],
    description: 'Timeless elegance meets modern style in this premium leather jacket. Crafted from genuine leather with meticulous attention to detail. Perfect for any occasion, from casual outings to special events.',
    category: 'Outerwear',
    tags: ['Leather', 'Jacket', 'Fashion', 'Casual', 'Premium', 'Classic'],
    inStock: true,
    quantity: 1
  },
  3: {
    id: 3,
    name: 'Summer Floral Dress',
    brand: 'Elegant Line',
    price: 65.00,
    oldPrice: 109,
    rating: 5,
    reviews: 156,
    sku: '2,51,596',
    image: 'https://images.unsplash.com/photo-1651950540805-b7c71869e689?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8Mjl8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60',
    gallery: [
      'https://images.unsplash.com/photo-1651950540805-b7c71869e689?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8Mjl8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1595777707802-5b575e6f4c15?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1572804419326-46f44af8e206?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1558769136-e990157a5389?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ],
    description: 'Embrace the warmth of summer with this beautiful floral dress. Made from breathable fabric with a comfortable fit. Perfect for beach days, casual outings, or outdoor gatherings.',
    category: 'Dresses',
    tags: ['Dress', 'Summer', 'Floral', 'Casual', 'Comfortable', 'Women'],
    inStock: true,
    quantity: 1
  },
  4: {
    id: 4,
    name: 'Premium Watch',
    brand: 'Time Luxury',
    price: 199.00,
    oldPrice: 299,
    rating: 5,
    reviews: 98,
    sku: '2,51,597',
    image: 'https://images.unsplash.com/photo-1649261191624-ca9f79ca3fc6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NDd8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60',
    gallery: [
      'https://images.unsplash.com/photo-1649261191624-ca9f79ca3fc6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NDd8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1523293182086-7651a899d37f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1525562141207-4b201312b8c1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ],
    description: 'Sophisticated timekeeping meets exquisite design. This premium watch features precision mechanics and luxury craftsmanship. An investment piece that complements any lifestyle.',
    category: 'Accessories',
    tags: ['Watch', 'Luxury', 'Premium', 'Accessories', 'Elegant', 'Timeless'],
    inStock: true,
    quantity: 1
  },
  5: {
    id: 5,
    name: 'Designer Sunglasses',
    brand: 'Vision Style',
    price: 79.99,
    oldPrice: 149,
    rating: 5,
    reviews: 112,
    sku: '2,51,598',
    image: 'https://images.unsplash.com/photo-1649261191606-cb2496e97eee?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NDR8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60',
    gallery: [
      'https://images.unsplash.com/photo-1649261191606-cb2496e97eee?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NDR8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1572635196237-14b3f281503f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1527173536622-3f7da59fe393?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1511499767150-a01a6648e4cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ],
    description: 'Protect your eyes in style with these designer sunglasses. UV protection and premium lenses ensure crystal-clear vision. Perfect for any sunny season or beach vacation.',
    category: 'Accessories',
    tags: ['Sunglasses', 'Designer', 'Accessories', 'UV Protection', 'Fashion', 'Premium'],
    inStock: true,
    quantity: 1
  },
  6: {
    id: 6,
    name: 'Canvas Backpack',
    brand: 'Adventure Gear',
    price: 55.00,
    oldPrice: 89,
    rating: 5,
    reviews: 203,
    sku: '2,51,599',
    image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
    gallery: [
      'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1553056069-5d88a8323f9f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
      'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ],
    description: 'Durable canvas backpack designed for everyday carry and outdoor adventures. Multiple compartments and ergonomic design provide comfort and functionality. Perfect for work, travel, or school.',
    category: 'Bags',
    tags: ['Backpack', 'Canvas', 'Durable', 'Travel', 'Outdoor', 'Practical'],
    inStock: true,
    quantity: 1
  }
}

const resolvedProductId = computed(() => {
  if (props.productId !== null) {
    return props.productId
  }

  const parsedId = Number.parseInt(route.params.id, 10)
  return Number.isNaN(parsedId) ? 1 : parsedId
})

const product = computed(() => {
  const id = resolvedProductId.value
  return productDatabase[id] || productDatabase[1]
})

const mainImage = ref(product.value.image)
const quantity = ref(1)
const selectedColor = ref('white')
const selectedSize = ref('41')
const activeTab = ref('details')

const discount = computed(() => {
  if (product.value.oldPrice > 0) {
    return Math.round(((product.value.oldPrice - product.value.price) / product.value.oldPrice) * 100)
  }
  return 0
})

const renderStars = (rating) => {
  return Array(rating).fill(0)
}

const starSlots = computed(() => Array(5).fill(0))

const colorOptions = [
  { id: 'white', className: 'bg-white' },
  { id: 'gray', className: 'bg-gray-200' },
  { id: 'black', className: 'bg-black' }
]

const sizeOptions = ['40.5', '41', '42', '43', '43.5', '44', '44.5', '45']

const relatedReviews = [
  {
    name: 'ARK customer',
    time: 'Yesterday',
    rating: 4,
    text: 'Excellent running shoes. It turns very sharply on the foot. Good to buy from Zudio.'
  }
]

watch(
  product,
  (newProduct) => {
    mainImage.value = newProduct.image
    quantity.value = 1
  },
  { immediate: true }
)
</script>

<template>
  <div class="min-h-screen flex items-center justify-center py-10 px-4">
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

      <div class="px-6 pt-6 pb-2">
        <div class="flex items-center gap-2 text-sm text-gray-500">
          <span class="hover:text-orange-400 cursor-pointer">Clothes and shoes</span>
          <span>/</span>
          <span class="hover:text-orange-400 cursor-pointer">Shoes</span>
          <span>/</span>
          <span class="hover:text-orange-400 cursor-pointer">{{ product.brand }}</span>
        </div>
      </div>

      <main class="px-6 pb-8 pt-4">
        <div class="grid md:grid-cols-2 gap-8">
          <div class="space-y-4">
            <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden">
              <img :src="mainImage" :alt="product.name" class="w-full h-full object-cover" />
            </div>
            <div class="grid grid-cols-4 gap-4">
              <button
                v-for="(img, idx) in product.gallery"
                :key="img"
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
                  <img :src="product.image" :alt="product.brand" class="w-6 h-6 rounded-full object-cover" />
                  <span class="font-medium">{{ product.brand }}</span>
                </div>
                <h1 class="text-3xl font-bold mb-2">{{ product.name }}</h1>
                <div class="text-3xl font-bold text-gray-900">Rp{{ product.price.toFixed(2) }}</div>
                <div class="flex items-center gap-2 mt-2">
                  <div class="flex items-center">
                    <svg
                      v-for="(slot, index) in starSlots"
                      :key="index"
                      class="w-5 h-5"
                      :class="index < product.rating ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current'"
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
              <div class="flex gap-3">
                <button
                  v-for="color in colorOptions"
                  :key="color.id"
                  type="button"
                  @click="selectedColor = color.id"
                  :class="[
                    'w-12 h-12 rounded-lg bg-gray-100 border-2 p-0.5',
                    selectedColor === color.id ? 'border-orange-400' : 'border-transparent'
                  ]"
                >
                  <span class="block w-full h-full rounded" :class="color.className"></span>
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
                  v-for="size in sizeOptions"
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

              <button class="flex-1 bg-orange-400 text-white py-4 rounded-xl hover:bg-orange-500 transition-colors">
                Buy Now
              </button>

              <button type="button" class="w-14 h-14 flex items-center justify-center border border-gray-200 rounded-xl hover:border-orange-400">
                <i class="ri-shopping-bag-line text-2xl"></i>
              </button>
            </div>

            <div class="flex items-center gap-2 text-sm text-gray-500">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
              </svg>
              <span>Free delivery on orders over Rp300.00</span>
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
              <button
                type="button"
                @click="activeTab = 'discussion'"
                :class="activeTab === 'discussion' ? 'px-4 py-2 text-orange-400 border-b-2 border-orange-400' : 'px-4 py-2 text-gray-500'"
              >
                Discussion
              </button>
            </div>
          </div>

          <div class="mt-8 grid md:grid-cols-2 gap-8" v-if="activeTab === 'details'">
            <div class="space-y-6">
              <div class="bg-gray-50 rounded-xl p-5">
                <h4 class="font-semibold text-gray-900 mb-2">Product Description</h4>
                <p class="text-sm text-gray-600 leading-relaxed">{{ product.description }}</p>
              </div>
            </div>

            <div class="bg-gray-50 rounded-xl p-5">
              <h4 class="font-semibold text-gray-900 mb-3">Product Info</h4>
              <div class="space-y-2 text-sm text-gray-600">
                <div><span class="font-medium text-gray-800">Category:</span> {{ product.category }}</div>
                <div><span class="font-medium text-gray-800">SKU:</span> {{ product.sku }}</div>
                <div><span class="font-medium text-gray-800">Discount:</span> {{ discount }}% Off</div>
                <div class="flex flex-wrap gap-2 pt-2">
                  <span v-for="tag in product.tags" :key="tag" class="text-xs text-gray-600 bg-gray-200/70 px-3 py-1 rounded-full">{{ tag }}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-8" v-if="activeTab === 'reviews'">
            <div class="p-6">
              <div class="max-w-screen-xl mx-auto">
                <div class="flex max-lg:flex-col gap-12">
                  <div class="max-w-sm w-full">
                    <div>
                      <h2 class="text-2xl font-bold text-slate-900 !leading-tight mb-2">Customer reviews</h2>
                      <div class="flex items-center gap-2">
                        <div class="flex items-center gap-0.5 text-orange-500">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" />
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" />
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" />
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" />
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" />
                          </svg>
                        </div>
                        <p class="text-slate-900 font-semibold text-sm">4.5 out of 5</p>
                      </div>
                      <p class="mt-4 text-slate-600 text-sm">global ratings (5,456,852)</p>
                    </div>
                    <div class="space-y-1 mt-6">
                      <div class="flex items-center">
                        <div class="min-w-9">
                          <p class="text-sm text-slate-900">5.0</p>
                        </div>
                        <div class="bg-gray-300 rounded w-full h-3">
                          <div class="w-2/3 h-full rounded bg-orange-500"></div>
                        </div>
                        <div class="min-w-14">
                          <p class="text-sm text-slate-900 ml-4">66%</p>
                        </div>
                      </div>
                      <div class="flex items-center">
                        <div class="min-w-9">
                          <p class="text-sm text-slate-900">4.0</p>
                        </div>
                        <div class="bg-gray-300 rounded w-full h-3">
                          <div class="w-1/3 h-full rounded bg-orange-500"></div>
                        </div>
                        <div class="min-w-14">
                          <p class="text-sm text-slate-900 ml-4">33%</p>
                        </div>
                      </div>
                      <div class="flex items-center">
                        <div class="min-w-9">
                          <p class="text-sm text-slate-900">3.0</p>
                        </div>
                        <div class="bg-gray-300 rounded w-full h-3">
                          <div class="w-1/6 h-full rounded bg-orange-500"></div>
                        </div>
                        <div class="min-w-14">
                          <p class="text-sm text-slate-900 ml-4">16%</p>
                        </div>
                      </div>
                      <div class="flex items-center">
                        <div class="min-w-9">
                          <p class="text-sm text-slate-900">2.0</p>
                        </div>
                        <div class="bg-gray-300 rounded w-full h-3">
                          <div class="w-1/12 h-full rounded bg-orange-500"></div>
                        </div>
                        <div class="min-w-14">
                          <p class="text-sm text-slate-900 ml-4">8%</p>
                        </div>
                      </div>
                      <div class="flex items-center">
                        <div class="min-w-9">
                          <p class="text-sm text-slate-900">1.0</p>
                        </div>
                        <div class="bg-gray-300 rounded w-full h-3">
                          <div class="w-[6%] h-full rounded bg-orange-500"></div>
                        </div>
                        <div class="min-w-14">
                          <p class="text-sm text-slate-900 ml-4">6%</p>
                        </div>
                      </div>
                    </div>

                    <hr class="border-gray-300 my-6" />

                    <div>
                      <h3 class="text-lg font-semibold text-slate-900 !leading-tight mb-6">By feature</h3>
                      <ul class="space-y-3">
                        <li class="flex sm:items-center justify-between max-sm:flex-col gap-2 text-slate-900 text-sm">
                          <span>Picture quality</span>
                          <span class="flex gap-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <p class="pl-1">5.0</p>
                          </span>
                        </li>
                        <li class="flex sm:items-center justify-between max-sm:flex-col gap-2 text-slate-900 text-sm">
                          <span>Value for money</span>
                          <span class="flex gap-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <p class="pl-1">4.8</p>
                          </span>
                        </li>
                        <li class="flex sm:items-center justify-between max-sm:flex-col gap-2 text-slate-900 text-sm">
                          <span>Screen quality</span>
                          <span class="flex gap-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-orange-500" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <p class="pl-1">4.8</p>
                          </span>
                        </li>
                      </ul>
                    </div>

                    <hr class="border-gray-300 my-6" />

                    <div>
                      <h3 class="text-lg font-semibold text-slate-900 !leading-tight mb-4">Review this product</h3>
                      <p class="mt-4 text-slate-600 text-sm">Share you thoughts with other customers</p>
                      <button type="button" class="cursor-pointer px-4 py-2 text-white font-medium text-sm rounded-md mt-6 bg-orange-500 hover:bg-orange-600">Write a customer review</button>
                    </div>
                  </div>

                  <div>
                    <div>
                      <h3 class="text-lg font-semibold text-slate-900 !leading-tight mb-4">Reviews with Images</h3>
                      <div class="flex items-center gap-4 overflow-auto">
                        <img src="https://readymadeui.com/images/digital-img-3.webp" class="bg-gray-100 object-cover p-2 w-[232px] h-[232px]" alt="customer-img-1" />
                        <img src="https://readymadeui.com/images/digital-img-1.webp" class="bg-gray-100 object-cover p-2 w-[232px] h-[232px]" alt="customer-img-2" />
                        <img src="https://readymadeui.com/images/ai-laptop.webp" class="bg-gray-100 object-cover p-2 w-[232px] h-[232px]" alt="customer-img-3" />
                        <img src="https://readymadeui.com/images/laptop2.webp" class="bg-gray-100 object-cover p-2 w-[232px] h-[232px]" alt="customer-img-4" />
                        <img src="https://readymadeui.com/images/digital-img-2.webp" class="bg-gray-100 object-cover p-2 w-[232px] h-[232px]" alt="customer-img-5" />
                      </div>
                    </div>

                    <div class="divide-y divide-gray-300 mt-8">
                      <div class="py-6">
                        <div class="flex items-center gap-4">
                          <div class="shrink-0">
                            <img src="https://readymadeui.com/team-2.webp" class="object-cover rounded-full w-11 h-11 border-2 border-gray-400" alt="customer-img-1" />
                          </div>
                          <div>
                            <p class="text-sm text-slate-900 font-semibold">Emily Carter</p>
                            <div class="flex items-center gap-2 mt-2">
                              <span class="w-4 h-4 flex items-center justify-center rounded-full bg-green-600/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 fill-green-700" viewBox="0 0 24 24">
                                  <path d="M9.225 20.656a1.206 1.206 0 0 1-1.71 0L.683 13.823a1.815 1.815 0 0 1 0-2.566l.855-.856a1.815 1.815 0 0 1 2.567 0l4.265 4.266L19.895 3.14a1.815 1.815 0 0 1 2.567 0l.855.856a1.815 1.815 0 0 1 0 2.566z" />
                                </svg>
                              </span>
                              <p class="text-slate-600 text-xs">Verified Buyer</p>
                            </div>
                          </div>
                        </div>
                        <div class="mt-4">
                          <h6 class="text-slate-900 text-[15px] font-semibold">Quick and Easy Experience</h6>
                          <div class="flex items-center space-x-0.5 text-orange-500 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <p class="text-slate-600 text-sm !ml-2">2 days ago</p>
                          </div>
                          <div class="mt-4">
                            <p class="text-slate-600 text-sm leading-relaxed">Everything was seamless. Ordering was simple and the response time was super fast. Highly recommend to anyone looking for convenience and speed.</p>
                          </div>
                        </div>
                      </div>

                      <div class="py-6">
                        <div class="flex items-center gap-4">
                          <div class="shrink-0">
                            <img src="https://readymadeui.com/team-3.webp" class="object-cover rounded-full w-11 h-11 border-2 border-gray-400" alt="customer-img-2" />
                          </div>
                          <div>
                            <p class="text-sm text-slate-900 font-semibold">Daniel Kim</p>
                            <div class="flex items-center gap-2 mt-2">
                              <span class="w-4 h-4 flex items-center justify-center rounded-full bg-green-600/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 fill-green-700" viewBox="0 0 24 24">
                                  <path d="M9.225 20.656a1.206 1.206 0 0 1-1.71 0L.683 13.823a1.815 1.815 0 0 1 0-2.566l.855-.856a1.815 1.815 0 0 1 2.567 0l4.265 4.266L19.895 3.14a1.815 1.815 0 0 1 2.567 0l.855.856a1.815 1.815 0 0 1 0 2.566z" />
                                </svg>
                              </span>
                              <p class="text-slate-600 text-xs">Verified Buyer</p>
                            </div>
                          </div>
                        </div>
                        <div class="mt-4">
                          <h6 class="text-slate-900 text-[15px] font-semibold">Fantastic Support</h6>
                          <div class="flex items-center space-x-0.5 text-orange-500 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <p class="text-slate-600 text-sm !ml-2">3 days ago</p>
                          </div>
                          <div class="mt-4">
                            <p class="text-slate-600 text-sm leading-relaxed">Had a few questions before ordering and the customer service team was amazing—super responsive and knowledgeable. It really made a difference!</p>
                          </div>
                        </div>
                        <div class="flex items-center gap-4 mt-4 overflow-auto">
                          <img src="https://readymadeui.com/images/digital-img-3.webp" class="bg-gray-100 object-cover p-2 w-48 h-48" alt="review-img-1" />
                          <img src="https://readymadeui.com/images/digital-img-1.webp" class="bg-gray-100 object-cover p-2 w-48 h-48" alt="review-img-2" />
                        </div>
                      </div>

                      <div class="py-6">
                        <div class="flex items-center gap-4">
                          <div class="shrink-0">
                            <img src="https://readymadeui.com/team-4.webp" class="object-cover rounded-full w-11 h-11 border-2 border-gray-400" alt="customer-img-3" />
                          </div>
                          <div>
                            <p class="text-sm text-slate-900 font-semibold">Priya Singh</p>
                            <div class="flex items-center gap-2 mt-2">
                              <span class="w-4 h-4 flex items-center justify-center rounded-full bg-green-600/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 fill-green-700" viewBox="0 0 24 24">
                                  <path d="M9.225 20.656a1.206 1.206 0 0 1-1.71 0L.683 13.823a1.815 1.815 0 0 1 0-2.566l.855-.856a1.815 1.815 0 0 1 2.567 0l4.265 4.266L19.895 3.14a1.815 1.815 0 0 1 2.567 0l.855.856a1.815 1.815 0 0 1 0 2.566z" />
                                </svg>
                              </span>
                              <p class="text-slate-600 text-xs">Verified Buyer</p>
                            </div>
                          </div>
                        </div>
                        <div class="mt-4">
                          <h6 class="text-slate-900 text-[15px] font-semibold">Exceeded Expectations</h6>
                          <div class="flex items-center space-x-0.5 text-orange-500 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <p class="text-slate-600 text-sm !ml-2">4 days ago</p>
                          </div>
                          <div class="mt-4">
                            <p class="text-slate-600 text-sm leading-relaxed">From start to finish, I felt taken care of. The ordering process was smooth and the delivery was right on time. Would definitely use this service again.</p>
                          </div>
                        </div>
                        <div class="flex items-center gap-4 mt-4 overflow-auto">
                          <img src="https://readymadeui.com/images/digital-img-2.webp" class="bg-gray-100 object-cover p-2 w-48 h-48" alt="review-img-1" />
                          <img src="https://readymadeui.com/images/laptop2.webp" class="bg-gray-100 object-cover p-2 w-48 h-48" alt="review-img-2" />
                        </div>
                      </div>

                      <div class="py-6">
                        <div class="flex items-center gap-4">
                          <div class="shrink-0">
                            <img src="https://readymadeui.com/team-5.webp" class="object-cover rounded-full w-11 h-11 border-2 border-gray-400" alt="customer-img-4" />
                          </div>
                          <div>
                            <p class="text-sm text-slate-900 font-semibold">Liam Brown</p>
                            <div class="flex items-center gap-2 mt-2">
                              <span class="w-4 h-4 flex items-center justify-center rounded-full bg-green-600/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 fill-green-700" viewBox="0 0 24 24">
                                  <path d="M9.225 20.656a1.206 1.206 0 0 1-1.71 0L.683 13.823a1.815 1.815 0 0 1 0-2.566l.855-.856a1.815 1.815 0 0 1 2.567 0l4.265 4.266L19.895 3.14a1.815 1.815 0 0 1 2.567 0l.855.856a1.815 1.815 0 0 1 0 2.566z" />
                                </svg>
                              </span>
                              <p class="text-slate-600 text-xs">Verified Buyer</p>
                            </div>
                          </div>
                        </div>
                        <div class="mt-4">
                          <h6 class="text-slate-900 text-[15px] font-semibold">Highly Recommended</h6>
                          <div class="flex items-center space-x-0.5 text-orange-500 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] fill-current" viewBox="0 0 24 24"><path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" /></svg>
                            <p class="text-slate-600 text-sm !ml-2">5 days ago</p>
                          </div>
                          <div class="mt-4">
                            <p class="text-slate-600 text-sm leading-relaxed">Very impressed by the quality and speed. It’s rare to see this level of dedication these days. I’ll definitely be coming back.</p>
                          </div>
                        </div>
                      </div>
                      
                      <div class="py-6">
                        <button type="button" class="cursor-pointer text-blue-700 font-medium border-0 outline-0 bg-transparent text-sm leading-relaxed">See all reviews</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-if="activeTab === 'discussion'" class="mt-8 bg-gray-50 rounded-xl p-6 text-sm text-gray-600">
            Discussion is coming soon for this product.
          </div>
        </div>
      </main>

    </div>
  </div>
</template>
