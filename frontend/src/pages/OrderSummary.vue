<script setup>
const currency = new Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
})

const billing = {
  subtotal: 120,
  shipping: 4,
  tax: 6,
  total: 130
}

const shippingInformation = {
  customer: 'Alex Johnson',
  shippingMethod: 'Express Delivery',
  address: '425 Park Avenue, San Francisco, CA 94107',
  phone: '(555) 123-4567'
}

const orderItems = [
  {
    id: 1,
    name: 'Velvet Sneaker',
    image: 'https://readymadeui.com/images/product14.webp',
    size: 'MD',
    qty: 1,
    price: 20
  },
  {
    id: 2,
    name: 'Smart Watch Timex',
    image: 'https://readymadeui.com/images/watch5.webp',
    size: 'SM',
    qty: 1,
    price: 60
  },
  {
    id: 3,
    name: 'French Connection',
    image: 'https://readymadeui.com/images/watch4.webp',
    size: 'LG',
    qty: 1,
    price: 40
  }
]
</script>

<template>
  <div class="bg-white p-2 min-h-screen py-8">
    <div class="max-w-6xl mx-auto max-lg:max-w-2xl">
      <nav aria-label="Breadcrumb" class="mb-8">
         <ul class="flex items-center gap-3">
            <li>
               <div class="flex items-center">
                  <router-link to="/" class="text-slate-500 font-medium text-sm flex items-center gap-2 hover:text-blue-700">
                     <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-current" viewBox="0 0 512 512">
                        <path d="M426 495.983H86c-25.364 0-46-20.635-46-46v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 7.72 6.28 14 14 14h340c7.72 0 14-6.28 14-14v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 25.364-20.635 46-46 46" />
                        <path d="M496 263.958a15.95 15.95 0 0 1-11.313-4.687L285.698 60.284c-16.375-16.376-43.02-16.376-59.396 0L27.314 259.272c-6.248 6.249-16.379 6.249-22.627 0-6.249-6.248-6.249-16.379 0-22.627L203.675 37.656c28.852-28.852 75.799-28.852 104.65 0l198.988 198.988c6.249 6.249 6.249 16.379 0 22.627A15.94 15.94 0 0 1 496 263.958M320 495.983H192c-8.837 0-16-7.164-16-16v-142c0-27.57 22.43-50 50-50h60c27.57 0 50 22.43 50 50v142c0 8.836-7.163 16-16 16m-112-32h96v-126c0-9.925-8.075-18-18-18h-60c-9.925 0-18 8.075-18 18z" />
                     </svg>
                     Home
                  </router-link>
               </div>
            </li>
            <li>
               <div class="flex items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="fill-slate-500 size-2.5" viewBox="0 0 451.846 451.847">
                     <path d="M345.441 248.292 151.154 442.573c-12.359 12.365-32.397 12.365-44.75 0-12.354-12.354-12.354-32.391 0-44.744L278.318 225.92 106.409 54.017c-12.354-12.359-12.354-32.394 0-44.748 12.354-12.359 32.391-12.359 44.75 0l194.287 194.284c6.177 6.18 9.262 14.271 9.262 22.366 0 8.099-3.091 16.196-9.267 22.373" />
                  </svg>
                  <router-link to="/profile" class="text-slate-500 font-medium text-sm hover:text-blue-700">
                     Profile
                  </router-link>
               </div>
            </li>
            <li aria-current="page">
               <div class="flex items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="fill-slate-500 size-2.5" viewBox="0 0 451.846 451.847">
                     <path d="M345.441 248.292 151.154 442.573c-12.359 12.365-32.397 12.365-44.75 0-12.354-12.354-12.354-32.391 0-44.744L278.318 225.92 106.409 54.017c-12.354-12.359-12.354-32.394 0-44.748 12.354-12.359 32.391-12.359 44.75 0l194.287 194.284c6.177 6.18 9.262 14.271 9.262 22.366 0 8.099-3.091 16.196-9.267 22.373" />
                  </svg>
                  <span class="text-slate-900 text-sm font-medium">
                     Order Summary
                  </span>
               </div>
            </li>
         </ul>
      </nav>

      <div>
        <h1 class="text-2xl font-semibold text-slate-900">Order Summary</h1>
        <p class="text-sm text-slate-500 mt-3">Your purchase was successful. Here’s a summary of your order details.</p>
      </div>

      <div class="grid lg:grid-cols-3 gap-y-16 mt-12">
        <div class="lg:border-r lg:border-gray-300 lg:pr-8">
          <div>
            <h3 class="text-base font-semibold text-slate-900 mb-6">Shipping Information</h3>
            <div class="grid sm:grid-cols-2 gap-x-4 gap-y-6">
              <div>
                <p class="text-slate-500 text-sm font-medium">Customer</p>
                <p class="text-slate-900 text-sm font-medium mt-2">{{ shippingInformation.customer }}</p>
              </div>
              <div>
                <p class="text-slate-500 text-sm font-medium">Shipping Method</p>
                <p class="text-slate-900 text-sm font-medium mt-2">{{ shippingInformation.shippingMethod }}</p>
              </div>
              <div>
                <p class="text-slate-500 text-sm font-medium">Address</p>
                <p class="text-slate-900 text-sm font-medium mt-2">{{ shippingInformation.address }}</p>
              </div>
              <div>
                <p class="text-slate-500 text-sm font-medium">Phone</p>
                <p class="text-slate-900 text-sm font-medium mt-2">{{ shippingInformation.phone }}</p>
              </div>
            </div>
          </div>

          <div class="mt-12">
            <h3 class="text-base font-semibold text-slate-900 mb-6">Billing details</h3>

            <ul class="font-medium mt-6 space-y-4">
              <li class="flex flex-wrap gap-4 text-slate-500 text-sm">Subtotal <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(billing.subtotal) }}</span></li>
              <li class="flex flex-wrap gap-4 text-slate-500 text-sm">Shipping <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(billing.shipping) }}</span></li>
              <li class="flex flex-wrap gap-4 text-slate-500 text-sm">Tax <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(billing.tax) }}</span></li>
              <hr class="border-gray-300" />
              <li class="flex flex-wrap gap-4 text-[15px]">Total <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(billing.total) }}</span></li>
            </ul>

            <div class="mt-8 space-y-3">
              <router-link to="/order-track" class="block text-sm px-4 py-2.5 w-full font-medium tracking-wide bg-orange-400 hover:bg-orange-500 text-white rounded-md cursor-pointer text-center">
                Track Order
              </router-link>
              <router-link to="/products" class="block text-sm px-4 py-2.5 w-full font-medium tracking-wide bg-transparent text-slate-900 border border-gray-300 rounded-md cursor-pointer text-center">
                Continue Shopping
              </router-link>
            </div>
          </div>
        </div>

        <div class="lg:col-span-2 space-y-4 lg:pl-8 max-lg:-order-1">
          <div class="lg:col-span-2 space-y-4">
            <div v-for="item in orderItems" :key="item.id" class="grid sm:grid-cols-3 items-center gap-4">
              <div class="col-span-2 flex items-center gap-4">
                <div class="w-28 h-28 max-sm:w-24 max-sm:h-24 shrink-0 bg-gray-100 p-2 rounded-md">
                  <img :src="item.image" :alt="item.name" class="w-full h-full object-contain" />
                </div>
                <div>
                  <h3 class="sm:text-base text-sm font-semibold text-slate-900">{{ item.name }}</h3>
                  <div class="mt-2">
                    <p class="text-xs font-medium text-slate-500">Size: {{ item.size }}</p>
                    <p class="text-xs font-medium text-slate-500 mt-1">Qty: {{ item.qty }}</p>
                  </div>
                </div>
              </div>
              <div class="sm:ml-auto">
                <h4 class="sm:text-lg text-base font-semibold text-slate-900">{{ currency.format(item.price) }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
