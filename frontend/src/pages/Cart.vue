<script setup>
import { computed, ref } from 'vue'

const cartItems = ref([
  {
    id: 1,
    title: 'Velvet Sneaker',
    image: 'https://readymadeui.com/images/product14.webp',
    price: 20,
    quantity: 2,
    size: 'XL',
    selected: true
  },
  {
    id: 2,
    title: 'Smart Watch Timex',
    image: 'https://readymadeui.com/images/watch5.webp',
    price: 120,
    quantity: 1,
    size: 'XL',
    selected: false
  },
  {
    id: 3,
    title: 'Sun Glass',
    image: 'https://readymadeui.com/images/sunglass1.webp',
    price: 50,
    quantity: 1,
    size: 'XL',
    selected: false
  }
])

const currency = new Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
})

const selectedSubtotal = computed(() => {
  return cartItems.value
    .filter(item => item.selected)
    .reduce((total, item) => total + item.price * item.quantity, 0)
})

const selectedCount = computed(() => {
  return cartItems.value.filter(item => item.selected).length
})

const shipping = computed(() => (selectedCount.value > 0 ? 20000 : 0))
const tax = computed(() => selectedSubtotal.value * 0.11)
const discount = computed(() => 0)
const total = computed(() => selectedSubtotal.value + shipping.value + tax.value - discount.value)

const isAllSelected = computed(() => {
  return cartItems.value.length > 0 && cartItems.value.every(item => item.selected)
})

const toggleSelectAll = () => {
  const nextSelected = !isAllSelected.value
  cartItems.value.forEach(item => {
    item.selected = nextSelected
  })
}

const updateQuantity = (itemId, change) => {
  const item = cartItems.value.find(entry => entry.id === itemId)
  if (!item) return

  const nextQuantity = item.quantity + change
  if (nextQuantity >= 1) {
    item.quantity = nextQuantity
  }
}

const removeItem = (itemId) => {
  cartItems.value = cartItems.value.filter(item => item.id !== itemId)
}
</script>

<template>
  <div class="bg-gray-50 min-h-screen py-8 pt-28">
    <div class="lg:max-w-5xl max-lg:max-w-2xl mx-auto bg-white p-4">
      <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-gray-100 p-6 rounded-md">
          <div class="flex items-center justify-between gap-4">
            <h3 class="text-lg font-semibold text-slate-900">Your Cart</h3>
            <label class="flex items-center gap-2 text-sm font-medium text-slate-700 cursor-pointer select-none">
              <input
                type="checkbox"
                :checked="isAllSelected"
                @change="toggleSelectAll"
                class="w-4 h-4 accent-orange-500"
              />
              Select all
            </label>
          </div>
          <hr class="border-gray-300 mt-4 mb-8" />

          <div v-if="cartItems.length" class="sm:space-y-6 space-y-8">
            <div
              v-for="item in cartItems"
              :key="item.id"
              class="grid sm:grid-cols-3 items-center gap-4 bg-white rounded-md p-4 border border-gray-200"
            >
              <div class="sm:col-span-2 flex sm:items-center max-sm:flex-col gap-6">
                <label class="flex items-start pt-1 cursor-pointer">
                  <input
                    v-model="item.selected"
                    type="checkbox"
                    class="w-4 h-4 accent-orange-500"
                  />
                </label>
                <div class="w-24 h-24 shrink-0 bg-white p-2 rounded-md border border-gray-200">
                  <img :src="item.image" :alt="item.title" class="w-full h-full object-contain" />
                </div>
                <div>
                  <h4 class="text-[15px] font-semibold text-slate-900">{{ item.title }}</h4>
                  <button
                    type="button"
                    class="mt-1 inline-flex items-center gap-1 text-xs font-medium text-red-500 hover:text-red-600 cursor-pointer"
                    @click="removeItem(item.id)"
                  >
                    <i class="ri-delete-bin-line"></i>
                    Remove
                  </button>
                  <div class="flex gap-4 mt-4">
                    <div class="relative group">
                      <button
                        type="button"
                        class="flex items-center px-2.5 py-1.5 border border-gray-300 text-slate-900 text-xs font-medium cursor-pointer outline-0 bg-transparent rounded-md"
                      >
                        {{ item.size }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-gray-500 inline ml-2.5" viewBox="0 0 24 24">
                          <path fill-rule="evenodd" d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z" clip-rule="evenodd" data-original="#000000" />
                        </svg>
                      </button>
                      <ul class="group-hover:block hidden absolute rounded-md min-w-20 shadow-lg bg-white z-1000">
                        <li class="py-2 px-4 hover:bg-gray-100 text-slate-900 text-xs font-medium cursor-pointer">SM</li>
                        <li class="py-2 px-4 hover:bg-gray-100 text-slate-900 text-xs font-medium cursor-pointer">MD</li>
                        <li class="py-2 px-4 hover:bg-gray-100 text-slate-900 text-xs font-medium cursor-pointer">XL</li>
                        <li class="py-2 px-4 hover:bg-gray-100 text-slate-900 text-xs font-medium cursor-pointer">XXL</li>
                      </ul>
                    </div>
                    <div>
                      <div class="flex items-center px-2.5 py-1.5 border border-gray-300 text-slate-900 text-xs rounded-md">
                        <button type="button" class="cursor-pointer" @click="updateQuantity(item.id, -1)">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 124 124">
                            <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                          </svg>
                        </button>

                        <span class="mx-3">{{ item.quantity }}</span>
                        <button type="button" class="cursor-pointer" @click="updateQuantity(item.id, 1)">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 42 42">
                            <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="sm:ml-auto sm:text-right">
                <h4 class="text-[15px] font-semibold text-slate-900">{{ currency.format(item.price * item.quantity) }}</h4>
                <p class="text-xs text-slate-500 mt-1">{{ currency.format(item.price) }} each</p>
              </div>
            </div>
          </div>

          <div v-else class="rounded-md bg-white border border-gray-200 p-8 text-center text-slate-500">
            Your cart is empty.
          </div>
        </div>

        <div class="bg-gray-100 rounded-md p-6 md:sticky top-0 h-max">
          <h3 class="text-lg font-semibold text-slate-900">Order details</h3>
          <hr class="border-gray-300 mt-4 mb-8" />

          <ul class="text-slate-500 font-medium mt-8 space-y-4">
            <li class="flex flex-wrap gap-4 text-sm">Discount <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(discount) }}</span></li>
            <li class="flex flex-wrap gap-4 text-sm">Shipping <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(shipping) }}</span></li>
            <li class="flex flex-wrap gap-4 text-sm">Tax <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(tax) }}</span></li>
            <li class="flex flex-wrap gap-4 text-sm text-slate-900">Total <span class="ml-auto font-semibold">{{ currency.format(total) }}</span></li>
          </ul>
          <p class="mt-4 text-sm text-slate-600">
            {{ selectedCount }} item{{ selectedCount !== 1 ? 's' : '' }} selected
          </p>
          <div class="mt-8 space-y-3">
            <router-link
              to="/checkout"
              :class="[
                'text-sm px-4 py-2.5 w-full font-medium tracking-wide text-white rounded-md text-center',
                selectedCount === 0
                  ? 'bg-blue-300 pointer-events-none cursor-not-allowed'
                  : 'bg-blue-600 hover:bg-blue-700 cursor-pointer'
              ]"
            >
              Checkout
            </router-link>
            <router-link to="/products" class="block text-sm px-4 py-2.5 w-full font-medium tracking-wide bg-transparent text-slate-900 border border-gray-300 rounded-md cursor-pointer text-center">
              Continue Shopping
            </router-link>
          </div>
          <div class="mt-6">
            <p class="text-slate-900 text-sm font-medium mb-2">Do you have a promo code?</p>
            <div class="flex border border-blue-600 overflow-hidden rounded-md">
              <input
                type="email"
                placeholder="Promo code"
                class="w-full outline-0 bg-white text-slate-600 text-sm px-4 py-2.5"
              />
              <button type="button" class="flex items-center justify-center font-medium tracking-wide bg-blue-600 hover:bg-blue-700 px-4 text-sm text-white cursor-pointer">
                Apply
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
