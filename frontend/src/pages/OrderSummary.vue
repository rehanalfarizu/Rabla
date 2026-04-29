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
  <div class="bg-white p-2 min-h-screen pt-34">
    <div class="max-w-6xl mx-auto max-lg:max-w-2xl">
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
