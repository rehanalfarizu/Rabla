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

<<template>
<section class="bg-white py-8 pt-28 antialiased md:py-16 md:pt-32">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Shopping Cart</h2>

    <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
      <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
        <div class="space-y-6">
          <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
              <a href="#" class="shrink-0 md:order-1">
                <img class="hidden h-20 w-20 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="imac image" />
              </a>

              <label for="counter-input" class="sr-only">Choose quantity:</label>
              <div class="flex items-center justify-between md:order-3 md:justify-end">
                <div class="flex items-center">
                  
                  <!-- DECREMENT -->
                  <button 
                    type="button"
                    class="inline-flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  >
                    <svg class="h-2.5 w-2.5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                    </svg>
                  </button>

                  <!-- INPUT -->
                  <input 
                    type="text"
                    class="w-10 text-center text-sm font-medium text-gray-900 bg-white focus:outline-none"
                    value="1"
                  />

                  <!-- INCREMENT -->
                  <button 
                    type="button"
                    class="inline-flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  >
                    <svg class="h-2.5 w-2.5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                    </svg>
                  </button>

                </div>

                <!-- PRICE -->
                <div class="text-end md:w-32">
                  <p class="text-base font-bold text-gray-900">$1,499</p>
                </div>
              </div>

              <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                <a href="#" class="text-base font-medium text-gray-900 hover:underline">PC system All in One APPLE iMac (2023) mqrq3ro/a, Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU, Keyboard layout INT</a>

                <div class="flex items-center gap-4 mt-5">
                  <button type="button" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-gray-900">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                    </svg>
                    Add to Favorites
                  </button>

                  <button type="button" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    Remove
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
              <a href="#" class="shrink-0 md:order-1">
                <img class="hidden h-20 w-20 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="imac image" />
              </a>

              <label for="counter-input" class="sr-only">Choose quantity:</label>
              <div class="flex items-center justify-between md:order-3 md:justify-end">
                <div class="flex items-center">
                  
                  <!-- DECREMENT -->
                  <button 
                    type="button"
                    class="inline-flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  >
                    <svg class="h-2.5 w-2.5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                    </svg>
                  </button>

                  <!-- INPUT -->
                  <input 
                    type="text"
                    class="w-10 text-center text-sm font-medium text-gray-900 bg-white focus:outline-none"
                    value="1"
                  />

                  <!-- INCREMENT -->
                  <button 
                    type="button"
                    class="inline-flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  >
                    <svg class="h-2.5 w-2.5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                    </svg>
                  </button>

                </div>

                <!-- PRICE -->
                <div class="text-end md:w-32">
                  <p class="text-base font-bold text-gray-900">$1,499</p>
                </div>
              </div>

              <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                <a href="#" class="text-base font-medium text-gray-900 hover:underline">PC system All in One APPLE iMac (2023) mqrq3ro/a, Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU, Keyboard layout INT</a>

                <div class="flex items-center gap-4 mt-5">
                  <button type="button" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-gray-900">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                    </svg>
                    Add to Favorites
                  </button>

                  <button type="button" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    Remove
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
              <a href="#" class="shrink-0 md:order-1">
                <img class="hidden h-20 w-20 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="imac image" />
              </a>

              <label for="counter-input" class="sr-only">Choose quantity:</label>
              <div class="flex items-center justify-between md:order-3 md:justify-end">
                <div class="flex items-center">
                  
                  <!-- DECREMENT -->
                  <button 
                    type="button"
                    class="inline-flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  >
                    <svg class="h-2.5 w-2.5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                    </svg>
                  </button>

                  <!-- INPUT -->
                  <input 
                    type="text"
                    class="w-10 text-center text-sm font-medium text-gray-900 bg-white focus:outline-none"
                    value="1"
                  />

                  <!-- INCREMENT -->
                  <button 
                    type="button"
                    class="inline-flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  >
                    <svg class="h-2.5 w-2.5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                    </svg>
                  </button>

                </div>

                <!-- PRICE -->
                <div class="text-end md:w-32">
                  <p class="text-base font-bold text-gray-900">$1,499</p>
                </div>
              </div>

              <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                <a href="#" class="text-base font-medium text-gray-900 hover:underline">PC system All in One APPLE iMac (2023) mqrq3ro/a, Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU, Keyboard layout INT</a>

                <div class="flex items-center gap-4 mt-5">
                  <button type="button" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-gray-900">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                    </svg>
                    Add to Favorites
                  </button>

                  <button type="button" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    Remove
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm md:p-6">
            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
              <a href="#" class="shrink-0 md:order-1">
                <img class="hidden h-20 w-20 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="imac image" />
              </a>

              <label for="counter-input" class="sr-only">Choose quantity:</label>
              <div class="flex items-center justify-between md:order-3 md:justify-end">
                <div class="flex items-center">
                  
                  <!-- DECREMENT -->
                  <button 
                    type="button"
                    class="inline-flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  >
                    <svg class="h-2.5 w-2.5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                    </svg>
                  </button>

                  <!-- INPUT -->
                  <input 
                    type="text"
                    class="w-10 text-center text-sm font-medium text-gray-900 bg-white focus:outline-none"
                    value="1"
                  />

                  <!-- INCREMENT -->
                  <button 
                    type="button"
                    class="inline-flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  >
                    <svg class="h-2.5 w-2.5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                    </svg>
                  </button>

                </div>

                <!-- PRICE -->
                <div class="text-end md:w-32">
                  <p class="text-base font-bold text-gray-900">$1,499</p>
                </div>
              </div>

              <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                <a href="#" class="text-base font-medium text-gray-900 hover:underline">PC system All in One APPLE iMac (2023) mqrq3ro/a, Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU, Keyboard layout INT</a>

                <div class="flex items-center gap-4 mt-5">
                  <button type="button" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-gray-900">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                    </svg>
                    Add to Favorites
                  </button>

                  <button type="button" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    Remove
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="hidden xl:mt-8 xl:block">
          <h3 class="text-2xl font-semibold text-gray-900">People also bought</h3>

          <div class="mt-6 grid grid-cols-3 gap-4 sm:mt-8">

            <!-- CARD -->
            <div class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
              <a href="#" class="overflow-hidden rounded">
                <img class="mx-auto h-44 w-44" 
                    src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" 
                    alt="imac image" />
              </a>

              <div>
                <a href="#" class="text-lg font-semibold text-gray-900 hover:underline">
                  iMac 27”
                </a>
                <p class="mt-2 text-base text-gray-500">
                  This generation has some improvements, including a longer continuous battery life.
                </p>
              </div>

              <div>
                <p class="text-lg font-bold text-red-600 line-through">$399,99</p>
                <p class="text-lg font-bold text-gray-900">$299</p>
              </div>

              <div class="mt-6 flex items-center gap-2.5">
                <button class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white p-2.5 text-gray-900 hover:bg-gray-100">
                  <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"/>
                  </svg>
                </button>

                <button class="w-full rounded-lg bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700">
                  Add to cart
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">

      <!-- ORDER SUMMARY -->
      <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <p class="text-xl font-semibold text-gray-900">Order summary</p>

        <div class="space-y-4">
          <div class="space-y-2">

            <dl class="flex justify-between">
              <dt class="text-gray-500">Original price</dt>
              <dd class="font-medium text-gray-900">$7,592.00</dd>
            </dl>

            <dl class="flex justify-between">
              <dt class="text-gray-500">Savings</dt>
              <dd class="font-medium text-green-600">-$299.00</dd>
            </dl>

            <dl class="flex justify-between">
              <dt class="text-gray-500">Store Pickup</dt>
              <dd class="font-medium text-gray-900">$99</dd>
            </dl>

            <dl class="flex justify-between">
              <dt class="text-gray-500">Tax</dt>
              <dd class="font-medium text-gray-900">$799</dd>
            </dl>

          </div>

          <dl class="flex justify-between border-t pt-3">
            <dt class="font-bold text-gray-900">Total</dt>
            <dd class="font-bold text-gray-900">$8,191.00</dd>
          </dl>
        </div>

        <a href="#" 
          class="flex w-full justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
          Proceed to Checkout
        </a>

        <div class="flex justify-center gap-2 text-sm">
          <span class="text-gray-500">or</span>
          <a href="#" class="font-medium text-blue-600 hover:underline">
            Continue Shopping →
          </a>
        </div>
      </div>

      <!-- VOUCHER -->
      <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <form class="space-y-4">

          <div>
            <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900">
              Do you have a voucher or gift card?
            </label>

            <input
              type="text"
              id="voucher"
              class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
              placeholder="Enter code"
            />
          </div>

          <button
            type="submit"
            class="w-full rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
            Apply Code
          </button>

        </form>
      </div>

    </div>
    </div>
  </div>
</section>
</template>
