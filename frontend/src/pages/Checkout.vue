<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import ToastAlert from '../components/ToastAlert.vue'

const router = useRouter()
const toastAlertRef = ref(null)
const showPurchaseModal = ref(false)

const handleCompletePurchase = () => {
  showPurchaseModal.value = false
  if (toastAlertRef.value) {
    toastAlertRef.value.show('success', 'Pembelian berhasil! Anda akan dialihkan...')
  }
  setTimeout(() => {
    router.push('/order-summary')
  }, 1500)
}

const firstName = ref('')
const lastName = ref('')
const email = ref('')
const phone = ref('')
const address = ref('')
const city = ref('')
const state = ref('')
const zipCode = ref('')

onMounted(() => {
  const authUser = JSON.parse(localStorage.getItem('auth_user') || '{}')
  
  if (authUser.name) {
    const nameParts = authUser.name.split(' ')
    firstName.value = nameParts[0] || ''
    lastName.value = nameParts.slice(1).join(' ') || ''
  }
  
  email.value = authUser.email || ''
  phone.value = authUser.phone || ''
  address.value = authUser.address || ''
  city.value = authUser.city || ''
  state.value = authUser.province || ''
  zipCode.value = authUser.postalCode || ''
})
</script>

<template>
  <div class="bg-white px-4 py-8 sm:px-8 min-h-screen">
    <div class="max-w-7xl max-md:max-w-xl mx-auto">
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
                  <router-link to="/cart" class="text-slate-500 font-medium text-sm hover:text-blue-700">
                     Cart
                  </router-link>
               </div>
            </li>
            <li aria-current="page">
               <div class="flex items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="fill-slate-500 size-2.5" viewBox="0 0 451.846 451.847">
                     <path d="M345.441 248.292 151.154 442.573c-12.359 12.365-32.397 12.365-44.75 0-12.354-12.354-12.354-32.391 0-44.744L278.318 225.92 106.409 54.017c-12.354-12.359-12.354-32.394 0-44.748 12.354-12.359 32.391-12.359 44.75 0l194.287 194.284c6.177 6.18 9.262 14.271 9.262 22.366 0 8.099-3.091 16.196-9.267 22.373" />
                  </svg>
                  <span class="text-slate-900 text-sm font-medium">
                     Checkout
                  </span>
               </div>
            </li>
         </ul>
      </nav>

      <div class="flex items-start mb-16">
        <div class="w-full">
          <div class="flex items-center w-full">
            <div class="w-8 h-8 shrink-0 -mx-px bg-blue-600 p-1.5 flex items-center justify-center rounded-full">
              <span class="text-sm text-white font-semibold">1</span>
            </div>
            <div class="w-full h-0.75 mx-4 rounded-lg bg-blue-600"></div>
          </div>
          <div class="mt-2 mr-4">
            <h6 class="text-sm font-semibold text-slate-900">Cart</h6>
          </div>
        </div>
        <div class="w-full">
          <div class="flex items-center w-full">
            <div class="w-8 h-8 shrink-0 -mx-px bg-blue-600 p-1.5 flex items-center justify-center rounded-full">
              <span class="text-sm text-white font-semibold">2</span>
            </div>
            <div class="w-full h-0.75 mx-4 rounded-lg bg-slate-300"></div>
          </div>
          <div class="mt-2 mr-4">
            <h6 class="text-sm font-semibold text-slate-900">Checkout</h6>
          </div>
        </div>
        <div>
          <div class="flex items-center">
            <div class="w-8 h-8 shrink-0 -mx-px bg-slate-300 p-1.5 flex items-center justify-center rounded-full">
              <span class="text-sm text-white font-semibold">3</span>
            </div>
          </div>
          <div class="mt-2">
            <h6 class="text-sm font-semibold text-slate-400">Order</h6>
          </div>
        </div>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8 lg:gap-x-12">
        <div class="lg:col-span-2">
          <form>
            <div>
              <h2 class="text-xl text-slate-900 font-semibold mb-6">Delivery Details</h2>
              <div class="grid lg:grid-cols-2 gap-y-6 gap-x-4">
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">First Name</label>
                  <input v-model="firstName" type="text" placeholder="Enter First Name" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Last Name</label>
                  <input v-model="lastName" type="text" placeholder="Enter Last Name" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Email</label>
                  <input v-model="email" type="email" placeholder="Enter Email" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Phone No.</label>
                  <input v-model="phone" type="tel" placeholder="Enter Phone No." class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Address Line</label>
                  <input v-model="address" type="text" placeholder="Enter Address Line" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">City</label>
                  <input v-model="city" type="text" placeholder="Enter City" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">State</label>
                  <input v-model="state" type="text" placeholder="Enter State" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Zip Code</label>
                  <input v-model="zipCode" type="text" placeholder="Enter Zip Code" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
              </div>
            </div>

            <div class="mt-12">
              <h2 class="text-xl text-slate-900 font-semibold mb-6">Payment</h2>
              <div class="grid gap-4 lg:grid-cols-2">
                <div class="bg-gray-100 p-4 rounded-md border border-gray-300 max-w-sm">
                  <div>
                    <div class="flex items-center">
                      <input type="radio" name="method" class="w-5 h-5 cursor-pointer" id="card" checked />
                      <label for="card" class="ml-4 flex gap-2 cursor-pointer">
                        <img src="https://readymadeui.com/images/visa.webp" class="w-12" alt="card1" />
                        <img src="https://readymadeui.com/images/american-express.webp" class="w-12" alt="card2" />
                        <img src="https://readymadeui.com/images/master.webp" class="w-12" alt="card3" />
                      </label>
                    </div>
                  </div>
                  <p class="mt-4 text-sm text-slate-500 font-medium">Pay with your debit or credit card</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-md border border-gray-300 max-w-sm">
                  <div>
                    <div class="flex items-center">
                      <input type="radio" name="method" class="w-5 h-5 cursor-pointer" id="paypal" />
                      <label for="paypal" class="ml-4 flex gap-2 cursor-pointer">
                        <img src="https://readymadeui.com/images/paypal.webp" class="w-20" alt="paypalCard" />
                      </label>
                    </div>
                  </div>
                  <p class="mt-4 text-sm text-slate-500 font-medium">Pay with your paypal account</p>
                </div>
              </div>
            </div>

            <div class="mt-12 max-w-md">
              <p class="text-slate-900 text-sm font-medium mb-2">Do you have a promo code?</p>
              <div class="flex gap-4">
                <input type="email" placeholder="Promo code" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                <button type="button" class="flex items-center justify-center font-medium tracking-wide bg-blue-600 hover:bg-blue-700 px-4 py-2.5 rounded-md text-sm text-white cursor-pointer">
                  Apply
                </button>
              </div>
            </div>
          </form>
        </div>

        <div class="relative">
          <h2 class="text-xl text-slate-900 font-semibold mb-6">Order Summary</h2>
          <ul class="text-slate-500 font-medium space-y-4">
            <li class="flex flex-wrap gap-4 text-sm">Subtotal <span class="ml-auto font-semibold text-slate-900">Rp72.00</span></li>
            <li class="flex flex-wrap gap-4 text-sm">Discount <span class="ml-auto font-semibold text-slate-900">Rp0.00</span></li>
            <li class="flex flex-wrap gap-4 text-sm">Shipping <span class="ml-auto font-semibold text-slate-900">Rp6.00</span></li>
            <li class="flex flex-wrap gap-4 text-sm">Tax <span class="ml-auto font-semibold text-slate-900">Rp5.00</span></li>
            <hr class="border-slate-300" />
            <li class="flex flex-wrap gap-4 text-[15px] font-semibold text-slate-900">Total <span class="ml-auto">Rp83.00</span></li>
          </ul>
          <div class="space-y-4 mt-8">
            <button @click="showPurchaseModal = true" type="button" class="block rounded-md px-4 py-2.5 w-full text-sm font-medium tracking-wide bg-blue-600 hover:bg-blue-700 text-white cursor-pointer text-center">
              Bayar Rp83.00
            </button>
            <router-link to="/cart" class="block rounded-md px-4 py-2.5 w-full text-sm font-medium tracking-wide bg-gray-100 hover:bg-gray-200 border border-gray-300 text-slate-900 cursor-pointer text-center">
              Continue Shopping
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
  <ToastAlert ref="toastAlertRef" />

  <!-- Modal Konfirmasi Pembelian -->
  <Teleport to="body">
    <Transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="showPurchaseModal"
        id="purchaseModalOverlay"
        class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)]"
        @click.self="showPurchaseModal = false"
      >
        <Transition
          enter-active-class="transition duration-200 ease-out"
          enter-from-class="opacity-0 scale-95"
          enter-to-class="opacity-100 scale-100"
          leave-active-class="transition duration-150 ease-in"
          leave-from-class="opacity-100 scale-100"
          leave-to-class="opacity-0 scale-95"
        >
          <div
            v-if="showPurchaseModal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="purchase-modal-title"
            tabindex="-1"
            class="w-full max-w-lg bg-white border border-slate-100 shadow-lg rounded-lg relative max-h-[95vh] overflow-y-auto outline-none p-4 md:p-6"
          >
            <!-- Tombol Tutup -->
            <button
              type="button"
              aria-label="Tutup modal"
              @click="showPurchaseModal = false"
              class="flex items-center absolute top-6 right-6 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-3 cursor-pointer fill-slate-500 hover:fill-red-600"
                aria-hidden="true"
                viewBox="0 0 329.269 329"
              >
                <path d="M194.8 164.77 323.013 36.555c8.343-8.34 8.343-21.825 0-30.164-8.34-8.34-21.825-8.34-30.164 0L164.633 134.605 36.422 6.391c-8.344-8.34-21.824-8.34-30.164 0-8.344 8.34-8.344 21.824 0 30.164l128.21 128.215L6.259 292.984c-8.344 8.34-8.344 21.825 0 30.164a21.27 21.27 0 0 0 15.082 6.25c5.46 0 10.922-2.09 15.082-6.25l128.21-128.214 128.216 128.214a21.27 21.27 0 0 0 15.082 6.25c5.46 0 10.922-2.09 15.082-6.25 8.343-8.34 8.343-21.824 0-30.164zm0 0" />
              </svg>
            </button>

            <!-- Isi Modal -->
            <div class="text-center">
              <div class="w-14 h-14 p-3.5 mb-4 mx-auto rounded-full bg-blue-50 flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-eight fill-blue-600 h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
              </div>
              <h3 id="purchase-modal-title" class="text-slate-900 text-base font-semibold">Konfirmasi Pembelian</h3>
              <p class="text-slate-600 text-sm mt-2 leading-relaxed">
                Apakah Anda yakin ingin menyelesaikan pembelian ini dengan total<br><span class="font-medium text-slate-800">Rp83.00</span>?
              </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between gap-4 mt-6">
              <button
                type="button"
                @click="showPurchaseModal = false"
                class="px-3.5 py-2 w-full text-slate-900 text-sm font-semibold rounded-md cursor-pointer bg-white border border-slate-300 transition-colors hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
              >
                Batal
              </button>
              <button
                type="button"
                @click="handleCompletePurchase"
                class="px-3.5 py-2 w-full text-white text-sm font-semibold rounded-md cursor-pointer bg-blue-600 border border-blue-600 transition-colors hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
              >
                Ya, Bayar
              </button>
            </div>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>

</template>
