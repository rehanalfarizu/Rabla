<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import logoImg from '../assets/Logo.webp'

const props = defineProps({
  sidebarOpen: {
    type: Boolean,
    required: true
  }
})

const emit = defineEmits(['toggle'])
const route = useRoute()

// Computed logic for active states tracking
const isDashboardActive = computed(() => route.path === '/admin')
const isOrdersActive = computed(() => route.path.startsWith('/admin/orders'))
const isProductsActive = computed(() => route.path.startsWith('/admin/products'))

const isCustomersActive = computed(() => route.path.startsWith('/admin/customers'))
const isPromotionsActive = computed(() => route.path.startsWith('/admin/promotions'))

const isInboxActive = computed(() => route.path.startsWith('/admin/inbox'))
const isRefundsActive = computed(() => route.path.startsWith('/admin/refunds'))

</script>

<template>
  <nav
    class="fixed left-0 top-0 z-40 h-screen overflow-y-auto overflow-x-hidden border-r border-gray-100 bg-white px-3 py-4 shadow-xl transition-all duration-300 flex flex-col"
    :style="{ width: sidebarOpen ? '250px' : '80px' }"
  >
    <!-- Logo & Toggle -->
    <div class="relative flex items-center mb-6" :class="sidebarOpen ? 'w-full px-2' : 'justify-center'">
      <router-link to="/admin" class="flex items-center justify-center">
        <img :src="logoImg" alt="Logo" class="h-8 w-8 object-contain" />
        <span v-if="sidebarOpen" class="ml-3 text-lg font-bold text-gray-900 tracking-tight">DASHBOARD</span>
      </router-link>

      <button
        type="button"
        @click="emit('toggle')"
        class="text-gray-400 transition-colors hover:text-gray-900"
        :class="sidebarOpen 
          ? 'absolute right-0' 
          : 'fixed left-5 top-16 block rotate-180 bg-white shadow-sm border border-gray-100 rounded-full p-1 z-50'"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current transition-transform duration-300" viewBox="0 0 55.752 55.752">
          <path d="M43.006 23.916a5.36 5.36 0 0 0-.912-.727L20.485 1.581a5.4 5.4 0 0 0-7.637 7.638l18.611 18.609-18.705 18.707a5.398 5.398 0 1 0 7.634 7.635l21.706-21.703a5.35 5.35 0 0 0 .912-.727 5.373 5.373 0 0 0 1.574-3.912 5.363 5.363 0 0 0-1.574-3.912z" />
        </svg>
      </button>
    </div>

    <!-- Navigation Groups -->
    <div class="w-full flex-1 flex flex-col gap-6">
      
      <!-- MAIN SECTION -->
      <div>
        <h4 v-if="sidebarOpen" class="px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Main</h4>
        <ul class="space-y-1" :class="!sidebarOpen ? 'flex flex-col items-center' : ''">
          <li>
            <router-link
              to="/admin"
              class="flex items-center rounded-lg h-10 px-3 text-sm font-medium transition-all group"
              :class="[
                isDashboardActive ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900',
                sidebarOpen ? 'w-full' : 'w-10 justify-center px-0'
              ]"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0" :class="sidebarOpen ? 'mr-3' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
              </svg>
              <span v-if="sidebarOpen">Dashboard</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/orders"
              class="flex items-center rounded-lg h-10 px-3 text-sm font-medium transition-all group"
              :class="[
                isOrdersActive ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900',
                sidebarOpen ? 'w-full' : 'w-10 justify-center px-0'
              ]"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0" :class="sidebarOpen ? 'mr-3' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
              </svg>
              <span v-if="sidebarOpen" class="flex-1">Orders</span>
              <span v-if="sidebarOpen" class="inline-flex items-center justify-center w-5 h-5 ml-2 text-xs font-semibold text-white bg-blue-600 rounded-full">3</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/products"
              class="flex items-center rounded-lg h-10 px-3 text-sm font-medium transition-all group"
              :class="[
                isProductsActive ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900',
                sidebarOpen ? 'w-full' : 'w-10 justify-center px-0'
              ]"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0" :class="sidebarOpen ? 'mr-3' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75v-3a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75Z" />
              </svg>
              <span v-if="sidebarOpen">Products</span>
            </router-link>
          </li>
        </ul>
      </div>

      <!-- MANAGEMENT SECTION -->
      <div>
        <h4 v-if="sidebarOpen" class="px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</h4>
        <ul class="space-y-1" :class="!sidebarOpen ? 'flex flex-col items-center' : ''">
          <li>
            <router-link
              to="/admin/customers"
              class="flex items-center rounded-lg h-10 px-3 text-sm font-medium transition-all group"
              :class="[
                isCustomersActive ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900',
                sidebarOpen ? 'w-full' : 'w-10 justify-center px-0'
              ]"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0" :class="sidebarOpen ? 'mr-3' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
              </svg>
              <span v-if="sidebarOpen">Customers</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/promotions"
              class="flex items-center rounded-lg h-10 px-3 text-sm font-medium transition-all group"
              :class="[
                isPromotionsActive ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900',
                sidebarOpen ? 'w-full' : 'w-10 justify-center px-0'
              ]"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0" :class="sidebarOpen ? 'mr-3' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
              </svg>
              <span v-if="sidebarOpen">Promotions</span>
            </router-link>
          </li>
        </ul>
      </div>

      <!-- SUPPORT SECTION -->
      <div>
        <h4 v-if="sidebarOpen" class="px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Support</h4>
        <ul class="space-y-1" :class="!sidebarOpen ? 'flex flex-col items-center' : ''">
          <li>
            <router-link
              to="/admin/inbox"
              class="flex items-center rounded-lg h-10 px-3 text-sm font-medium transition-all group"
              :class="[
                isInboxActive ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900',
                sidebarOpen ? 'w-full' : 'w-10 justify-center px-0'
              ]"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0" :class="sidebarOpen ? 'mr-3' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.909A2.25 2.25 0 0 1 2.25 8.665V6.75m19.5 0V8.665c0 .41-.176.793-.473 1.053l-7.5 6.55a2.25 2.25 0 0 1-2.364 0l-7.5-6.554A1.5 1.5 0 0 1 2.25 8.665V6.75" />
              </svg>
              <span v-if="sidebarOpen">Inbox</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/refunds"
              class="flex items-center rounded-lg h-10 px-3 text-sm font-medium transition-all group"
              :class="[
                isRefundsActive ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900',
                sidebarOpen ? 'w-full' : 'w-10 justify-center px-0'
              ]"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0" :class="sidebarOpen ? 'mr-3' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
              </svg>
              <span v-if="sidebarOpen">Refunds</span>
            </router-link>
          </li>
        </ul>
      </div>

    </div>

    <!-- User Profile Area at Bottom -->
    <div class="mt-auto border-t border-gray-100 pt-4" :class="sidebarOpen ? 'px-1' : 'flex flex-col items-center'">
      <a href="javascript:void(0)" class="flex items-center rounded-lg hover:bg-gray-100 transition-colors" :class="sidebarOpen ? 'p-2 w-full' : 'p-1.5 w-10 justify-center'">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="h-8 w-8 rounded-full border border-gray-200" alt="Admin" />
        <div v-if="sidebarOpen" class="ml-3 flex-1 overflow-hidden">
          <p class="text-sm font-medium text-gray-900 truncate">Admin Store</p>
          <p class="text-xs text-gray-500 truncate">admin@markhub.com</p>
        </div>
      </a>
    </div>
  </nav>
</template>
