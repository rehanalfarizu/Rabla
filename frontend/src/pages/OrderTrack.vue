<script setup>
const currency = new Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
})

const trackingId = '#51235541'

const trackingSteps = [
  {
    title: 'Order placed',
    date: '28 Feb 2025, 08:00',
    completed: true,
    icon: 'check'
  },
  {
    title: 'Arrived at courier warehouse',
    date: '05 March 2025, 01:10',
    completed: true,
    icon: 'check'
  },
  {
    title: 'Out for delivery',
    date: 'Courier is on the way',
    completed: false,
    icon: 'truck'
  },
  {
    title: 'Expected delivery on 06 March 2025',
    date: 'Products delivered',
    completed: false,
    icon: 'home'
  }
]

const products = [
  {
    id: 1,
    name: 'Velvet Sneaker',
    image: 'https://readymadeui.com/images/product14.webp',
    qty: 1,
    price: 20
  },
  {
    id: 2,
    name: 'Smart Watch Timex',
    image: 'https://readymadeui.com/images/watch5.webp',
    qty: 1,
    price: 60
  },
  {
    id: 3,
    name: 'French Connection',
    image: 'https://readymadeui.com/images/watch4.webp',
    qty: 1,
    price: 40
  }
]

const billing = {
  subtotal: 120,
  shipping: 4,
  tax: 6,
  total: 130
}

const deliveryInformation = {
  customer: 'Alex Johnson',
  shippingMethod: 'Express Delivery',
  address: '425 Park Avenue, San Francisco, CA 94107'
}

const downloadInvoice = () => {
  window.print()
}
</script>

<template>
  <div class="p-6 min-h-screen py-8 bg-white">
    <div class="max-w-6xl mx-auto">
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
                     Track Order
                  </span>
               </div>
            </li>
         </ul>
      </nav>

      <div class="flex items-center gap-6 flex-wrap border-b border-gray-300 pb-6">
        <div class="flex-1 text-nowrap">
          <h2 class="text-2xl font-semibold text-slate-900">Order Tracking</h2>
          <h4 class="text-base text-slate-600 mt-4">Tracking Id: {{ trackingId }}</h4>
        </div>
        <button
          type="button"
          @click="downloadInvoice"
          class="text-[15px] font-medium px-4 py-3 rounded-md bg-indigo-600 hover:bg-indigo-700 text-white tracking-wide cursor-pointer"
        >
          Download invoice
        </button>
      </div>

      <div class="mt-12 border-b border-gray-300 pb-6">
        <div class="flex items-start max-md:flex-col max-md:gap-y-8">
          <div class="w-full">
            <div class="flex items-center w-full">
              <div class="w-9 h-9 shrink-0 -mx-px bg-blue-600 flex items-center justify-center rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-white" viewBox="0 0 24 24">
                  <path d="M22.05 4.8c-.6-.6-1.5-.6-2.1 0L8.7 16.05 4.05 11.4c-.6-.6-1.5-.6-2.1 0s-.6 1.5 0 2.1l5.7 5.7c.3.3.6.45 1.05.45s.75-.15 1.05-.45l12.3-12.3c.6-.6.6-1.5 0-2.1z" data-original="#000000" />
                </svg>
              </div>
              <div class="w-full h-0.75 mx-4 rounded-lg bg-blue-600 max-md:hidden"></div>
            </div>
            <div class="mt-4 mr-4">
              <h4 class="text-[15px] font-semibold text-slate-900">Order placed</h4>
              <p class="text-sm text-slate-600 mt-1">28 Feb 2025, 08:00</p>
            </div>
          </div>
          <div class="w-full">
            <div class="flex items-center w-full">
              <div class="w-9 h-9 shrink-0 -mx-px bg-blue-600 flex items-center justify-center rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-white" viewBox="0 0 24 24">
                  <path d="M22.05 4.8c-.6-.6-1.5-.6-2.1 0L8.7 16.05 4.05 11.4c-.6-.6-1.5-.6-2.1 0s-.6 1.5 0 2.1l5.7 5.7c.3.3.6.45 1.05.45s.75-.15 1.05-.45l12.3-12.3c.6-.6.6-1.5 0-2.1z" data-original="#000000" />
                </svg>
              </div>
              <div class="w-full h-0.75 mx-4 rounded-lg bg-blue-600 max-md:hidden"></div>
            </div>
            <div class="mt-4 mr-4">
              <h4 class="text-[15px] font-semibold text-slate-900">Arrived at courier warehouse</h4>
              <p class="text-sm text-slate-600 mt-1">05 March 2025, 01:10</p>
            </div>
          </div>
          <div class="w-full">
            <div class="flex items-center w-full">
              <div class="w-9 h-9 shrink-0 -mx-px bg-gray-300 flex items-center justify-center rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-slate-900" viewBox="0 0 512 512">
                  <g fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="30">
                    <path d="M159.6 400.6h176.733V288.133H15v80.333a32.115 32.115 0 0 0 9.415 22.726 32.122 32.122 0 0 0 22.718 9.407H63.2" data-original="#000000" />
                    <path d="M336.333 288.133v-192.8a32.11 32.11 0 0 0-9.415-22.718A32.13 32.13 0 0 0 304.2 63.2H47.133a32.13 32.13 0 0 0-22.718 9.415A32.11 32.11 0 0 0 15 95.333v192.8h321.333z" data-original="#000000" />
                    <path d="M432.733 400.6h32.133a32.122 32.122 0 0 0 22.718-9.407 32.115 32.115 0 0 0 9.415-22.726V239.934c0-44.36-35.965-80.333-80.333-80.333h-80.333v241" data-original="#000000" />
                    <circle cx="111.4" cy="400.6" r="48.2" data-original="#000000" />
                    <circle cx="384.533" cy="400.6" r="48.2" data-original="#000000" />
                    <path d="M416.667 159.6v128.533H497" data-original="#000000" />
                  </g>
                </svg>
              </div>
              <div class="w-full h-0.75 mx-4 rounded-lg bg-gray-300 max-md:hidden"></div>
            </div>
            <div class="mt-4 mr-4">
              <h4 class="text-[15px] font-semibold text-slate-900">Out for delivery</h4>
              <p class="text-sm text-slate-600 mt-1">Courier is on the way</p>
            </div>
          </div>
          <div class="w-full">
            <div class="flex items-center">
              <div class="w-9 h-9 shrink-0 -mx-px bg-gray-300 flex items-center justify-center rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-slate-900" viewBox="0 0 512 512">
                  <path d="M426 495.983H86c-25.364 0-46-20.635-46-46v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 7.72 6.28 14 14 14h340c7.72 0 14-6.28 14-14v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 25.364-20.635 46-46 46z" data-original="#000000" />
                  <path d="M496 263.958a15.945 15.945 0 0 1-11.313-4.687L285.698 60.284c-16.375-16.376-43.02-16.376-59.396 0L27.314 259.272c-6.248 6.249-16.379 6.249-22.627 0-6.249-6.248-6.249-16.379 0-22.627L203.675 37.656c28.852-28.852 75.799-28.852 104.65 0l198.988 198.988c6.249 6.249 6.249 16.379 0 22.627A15.943 15.943 0 0 1 496 263.958zM320 495.983H192c-8.837 0-16-7.164-16-16v-142c0-27.57 22.43-50 50-50h60c27.57 0 50 22.43 50 50v142c0 8.836-7.163 16-16 16zm-112-32h96v-126c0-9.925-8.075-18-18-18h-60c-9.925 0-18 8.075-18 18z" data-original="#000000" />
                </svg>
              </div>
            </div>
            <div class="mt-4">
              <h4 class="text-[15px] font-semibold text-slate-900">Expected delivery on 06 March 2025</h4>
              <p class="text-sm text-slate-600 mt-1">Products delivered</p>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-12 grid lg:grid-cols-2 gap-12">
        <div>
          <h3 class="text-base font-semibold text-slate-900 border-b border-gray-300 pb-2">Products</h3>
          <div class="space-y-4 mt-6">
            <div v-for="product in products" :key="product.id" class="grid sm:grid-cols-3 items-center gap-4">
              <div class="col-span-2 flex items-center gap-4">
                <div class="w-20 h-20 shrink-0 bg-gray-100 p-2 rounded-md">
                  <img :src="product.image" :alt="product.name" class="w-full h-full object-contain" />
                </div>
                <div>
                  <h4 class="text-[15px] font-medium text-slate-900">{{ product.name }}</h4>
                  <div class="mt-2">
                    <p class="text-xs font-medium text-slate-600 mt-1">Qty: {{ product.qty }}</p>
                  </div>
                </div>
              </div>
              <div class="sm:ml-auto">
                <h4 class="text-[15px] font-medium text-slate-900">{{ currency.format(product.price) }}</h4>
              </div>
            </div>
          </div>
        </div>

        <div>
          <h3 class="text-base font-semibold text-slate-900 border-b border-gray-300 pb-2">Delivery information</h3>
          <div class="space-y-6 mt-6">
            <div>
              <p class="text-slate-600 text-sm font-medium">Customer</p>
              <h4 class="text-slate-900 text-[15px] font-medium mt-2">{{ deliveryInformation.customer }}</h4>
            </div>
            <div>
              <p class="text-slate-600 text-sm font-medium">Shipping Method</p>
              <h4 class="text-slate-900 text-[15px] font-medium mt-2">{{ deliveryInformation.shippingMethod }}</h4>
            </div>
            <div>
              <p class="text-slate-600 text-sm font-medium">Address</p>
              <h4 class="text-slate-900 text-[15px] font-medium mt-2">{{ deliveryInformation.address }}</h4>
            </div>
          </div>

          <div class="bg-gray-100 rounded-md p-6 h-max mt-8">
            <h3 class="text-base font-semibold text-slate-900 border-b border-gray-300 pb-2">Billing details</h3>
            <ul class="font-medium mt-6 space-y-4">
              <li class="flex flex-wrap gap-4 text-slate-600 text-sm">Subtotal <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(billing.subtotal) }}</span></li>
              <li class="flex flex-wrap gap-4 text-slate-600 text-sm">Shipping <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(billing.shipping) }}</span></li>
              <li class="flex flex-wrap gap-4 text-slate-600 text-sm">Tax <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(billing.tax) }}</span></li>
              <hr class="border-gray-300" />
              <li class="flex flex-wrap gap-4 text-[15px]">Total <span class="ml-auto text-slate-900 font-semibold">{{ currency.format(billing.total) }}</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
