<script setup>
const currency = new Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
})

const orders = [
  {
    purchaseDate: 'May 05, 2025',
    orderId: 'OR981122',
    totalPaid: 78,
    items: [
      {
        name: 'Tshirt',
        image: 'https://readymadeui.com/images/dark-green-tshirt-2.webp',
        deliveryDate: 'May 12, 2025',
        status: 'Completed',
        statusClass: 'bg-green-100 text-green-600',
        price: 24
      },
      {
        name: 'Echo Elegance',
        image: 'https://readymadeui.com/images/product14.webp',
        deliveryDate: 'April 22, 2025',
        status: 'Processing',
        statusClass: 'bg-blue-100 text-blue-600',
        price: 30
      },
      {
        name: 'Smart Watch Timex',
        image: 'https://readymadeui.com/images/watch5.webp',
        deliveryDate: 'May 7, 2025',
        status: 'Cancelled',
        statusClass: 'bg-red-100 text-red-600',
        price: 24
      }
    ]
  },
  {
    purchaseDate: 'Jun 16, 2025',
    orderId: 'OR675915',
    totalPaid: 64,
    items: [
      {
        name: 'Echo Elegance',
        image: 'https://readymadeui.com/images/product14.webp',
        deliveryDate: 'April 22, 2025',
        status: 'Processing',
        statusClass: 'bg-blue-100 text-blue-600',
        price: 24
      },
      {
        name: 'Smart Watch Timex',
        image: 'https://readymadeui.com/images/watch5.webp',
        deliveryDate: 'May 7, 2025',
        status: 'Cancelled',
        statusClass: 'bg-red-100 text-red-600',
        price: 20
      },
      {
        name: 'Sunscreen',
        image: 'https://readymadeui.com/images/sunscreen-img-4.webp',
        deliveryDate: 'May 10, 2025',
        status: 'Completed',
        statusClass: 'bg-green-100 text-green-600',
        price: 20
      }
    ]
  }
]
</script>

<template>
  <div class="p-4 min-h-screen bg-white pt-28">
    <div class="max-w-6xl mx-auto">
      <div class="border-b border-gray-300 pb-4">
        <div class="flex gap-4 items-start">
          <div>
            <h3 class="text-2xl font-semibold text-slate-900">Order History</h3>
            <p class="text-[15px] text-slate-500 mt-3">Easily view and manage all your previous orders.</p>
          </div>
          <div class="ml-auto">
            <select class="appearance-none cursor-pointer text-sm text-slate-900 bg-gray-100 border border-gray-300 outline-0 px-4 py-2 rounded-md">
              <option>All orders</option>
              <option>Completed</option>
              <option>Processing</option>
              <option>Cancelled</option>
            </select>
          </div>
        </div>
      </div>

      <div v-for="order in orders" :key="order.orderId" class="mt-8">
        <div class="bg-gray-100 p-6 rounded-md">
          <div class="flex md:items-center max-md:flex-col gap-x-12 gap-y-6">
            <div class="max-md:flex max-md:justify-between max-md:gap-4">
              <h6 class="text-[15px] font-medium text-slate-900">Purchase Date</h6>
              <p class="text-sm text-slate-500 font-medium md:mt-2">{{ order.purchaseDate }}</p>
            </div>
            <div class="max-md:flex max-md:justify-between max-md:gap-4">
              <h6 class="text-[15px] font-medium text-slate-900">Order id</h6>
              <p class="text-sm text-slate-500 font-medium md:mt-2">{{ order.orderId }}</p>
            </div>
            <div class="max-md:flex max-md:justify-between max-md:gap-4">
              <h6 class="text-[15px] font-medium text-slate-900">Total Paid</h6>
              <p class="text-sm text-slate-500 font-medium md:mt-2">{{ currency.format(order.totalPaid) }}</p>
            </div>
            <div class="md:ml-auto">
              <button type="button" class="cursor-pointer text-sm text-slate-900 font-medium bg-gray-200 border border-gray-300 outline-0 px-4 py-2 rounded-md max-md:w-full">
                View Invoice
              </button>
            </div>
          </div>
        </div>

        <div class="divide-y divide-gray-300 mt-4">
          <div v-for="item in order.items" :key="`${order.orderId}-${item.name}`" class="grid grid-cols-5 max-md:grid-cols-2 items-start justify-between gap-6 py-4">
            <div class="md:col-span-2 flex sm:items-center gap-4 max-sm:flex-col">
              <div class="bg-gray-100 p-2 rounded-lg w-16 h-16 shrink-0">
                <img :src="item.image" :alt="item.name" class="w-full h-full object-contain" />
              </div>
              <div>
                <h6 class="text-[15px] font-medium text-slate-900">{{ item.name }}</h6>
              </div>
            </div>
            <div>
              <h6 class="text-sm font-medium text-slate-500">Delivery Date</h6>
              <p class="text-sm text-slate-900 font-medium mt-2">{{ item.deliveryDate }}</p>
            </div>
            <div>
              <h6 class="text-sm font-medium text-slate-500">Order Status</h6>
              <p class="text-[13px] font-medium mt-2 inline-block rounded-md py-1.5 px-3" :class="item.statusClass">{{ item.status }}</p>
            </div>
            <div class="md:ml-auto">
              <h6 class="text-sm font-medium text-slate-500">Price</h6>
              <p class="text-sm text-slate-900 font-medium mt-2">{{ currency.format(item.price) }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
