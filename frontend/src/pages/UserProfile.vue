<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import ToastAlert from '../components/ToastAlert.vue'

const router = useRouter()
const toastAlert = ref(null)
const showLogoutModal = ref(false)

const confirmLogout = () => {
  showLogoutModal.value = true
}

const handleLogout = () => {
  showLogoutModal.value = false
  if (toastAlert.value) {
    toastAlert.value.show('success', 'Berhasil logout dari akun Anda.')
  }
  
  setTimeout(() => {
    localStorage.removeItem('auth_token')
    localStorage.removeItem('auth_user')
    router.push('/login')
  }, 1500)
}

const user = ref({
  name: '',
  email: '',
  phone: '',
  address: '',
  avatar: 'https://readymadeui.com/team-2.webp'
})

onMounted(() => {
  const authUser = JSON.parse(localStorage.getItem('auth_user') || '{}')
  if (!authUser.profileCompleted) {
    router.push('/complete-profile')
    return
  }
  
  user.value = {
    name: authUser.name || '',
    email: authUser.email || '',
    phone: authUser.phone || '',
    address: [authUser.address, authUser.city, authUser.province, authUser.postalCode].filter(Boolean).join(', '),
    avatar: authUser.avatarUrl || 'https://readymadeui.com/team-2.webp'
  }
})

const navigateTo = (path) => {
  router.push(path)
}
</script>

<template>
  <div class="min-h-screen bg-gray-50 pt-28 pb-12 px-4 sm:px-6 lg:px-8">
    <ToastAlert ref="toastAlert" />
    <div class="max-w-7xl mx-auto">
      <!-- Layout Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-32">
            <!-- User Info Summary -->
            <div class="p-6 text-center border-b border-gray-100">
              <div class="w-24 h-24 mx-auto rounded-full overflow-hidden border-2 border-orange-400 mb-4 shadow-sm">
                <img :src="user.avatar" alt="User Profile" class="w-full h-full object-cover" />
              </div>
              <h2 class="text-lg font-bold text-gray-900">{{ user.name }}</h2>
              <p class="text-sm text-gray-500">{{ user.email }}</p>
            </div>
            
            <!-- Quick Actions - Order Links as Icons -->
            <div class="p-4 bg-gray-50/50 flex flex-col justify-center gap-3 border-b border-gray-100">
              <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider text-center mb-1">Riwayat & Status Pesanan</p>
              <div class="flex justify-center gap-4">
                <!-- Order History Button (Icon Only) -->
                <button @click="navigateTo('/order-history')" class="group p-3 bg-white border border-gray-200 rounded-full text-gray-600 hover:text-orange-500 hover:border-orange-200 hover:bg-orange-50 transition-all shadow-sm relative flex items-center justify-center" aria-label="Order History" title="Order History">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
                </button>
  
                <!-- Order Summary Button (Icon Only) -->
                <button @click="navigateTo('/order-summary')" class="group p-3 bg-white border border-gray-200 rounded-full text-gray-600 hover:text-orange-500 hover:border-orange-200 hover:bg-orange-50 transition-all shadow-sm relative flex items-center justify-center" aria-label="Order Summary" title="Order Summary">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                  </svg>
                </button>
  
                <!-- Order Track Button (Icon Only) -->
                <button @click="navigateTo('/order-track')" class="group p-3 bg-white border border-gray-200 rounded-full text-gray-600 hover:text-orange-500 hover:border-orange-200 hover:bg-orange-50 transition-all shadow-sm relative flex items-center justify-center" aria-label="Order Track" title="Order Track">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1">
              <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-orange-50 text-orange-600 font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                Personal Info
              </a>
              <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                Addresses
              </a>
              <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
                Payment Methods
              </a>
              <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                </svg>
                Notifications
              </a>
              <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.99l1.004.828c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                Settings
              </a>
            </nav>
            <div class="px-4 pb-4 mt-2">
              <button @click="confirmLogout" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                </svg>
                Logout
              </button>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Personal Information</h1>
            
            <form class="space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                  <input type="text" v-model="user.name" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" />
                </div>

                <!-- Email -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                  <input type="email" v-model="user.email" disabled class="w-full bg-gray-50 px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" />
                </div>

                <!-- Phone -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                  <input type="tel" v-model="user.phone" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" />
                </div>

                <!-- Address (Full Width) -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Primary Address</label>
                  <textarea v-model="user.address" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all resize-none"></textarea>
                </div>
              </div>

              <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                <button type="button" class="px-6 py-3 rounded-xl font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition-colors">
                  Cancel
                </button>
                <button type="button" class="px-6 py-3 rounded-xl font-medium text-white bg-black hover:bg-gray-900 transition-colors">
                  Save Changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Logout -->
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
        v-if="showLogoutModal"
        id="logoutModalOverlay"
        class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)]"
        @click.self="showLogoutModal = false"
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
            v-if="showLogoutModal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="logout-modal-title"
            tabindex="-1"
            class="w-full max-w-lg bg-white border border-slate-100 shadow-lg rounded-lg relative max-h-[95vh] overflow-y-auto outline-none p-4 md:p-6"
          >
            <!-- Tombol Tutup -->
            <button
              type="button"
              aria-label="Tutup modal"
              @click="showLogoutModal = false"
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
              <div class="w-14 h-14 p-3.5 mb-4 mx-auto rounded-full bg-red-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-full fill-red-500 inline" viewBox="0 0 512 512" aria-hidden="true">
                  <path d="M312 371.98c-8.284 0-15 6.716-15 15v75H45V50.02h252v75c0 8.284 6.716 15 15 15s15-6.716 15-15v-90c0-8.284-6.716-15-15-15H30c-8.284 0-15 6.716-15 15v412c0 8.284 6.716 15 15 15h282c8.284 0 15-6.716 15-15v-90c0-8.284-6.716-15-15-15z" />
                  <path d="M495.609 248.38 406.628 159.4c-5.858-5.858-15.355-5.858-21.213 0-5.858 5.858-5.858 15.355 0 21.213l67.986 67.987H167c-8.284 0-15 6.716-15 15s6.716 15 15 15h286.401l-67.986 67.987c-5.858 5.858-5.858 15.355 0 21.213 2.929 2.929 6.768 4.394 10.607 4.394s7.678-1.465 10.607-4.394l88.98-88.98c5.857-5.858 5.857-15.356 0-21.214z" />
                </svg>
              </div>
              <h3 id="logout-modal-title" class="text-slate-900 text-base font-semibold">Yakin ingin keluar?</h3>
              <p class="text-slate-600 text-sm mt-2 leading-relaxed">
                Kamu akan keluar dari akun <span class="font-medium text-slate-800">{{ user.email }}</span>.
                Sesi kamu akan diakhiri dan kamu perlu login kembali untuk mengakses akun.
              </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between gap-4 mt-6">
              <button
                type="button"
                @click="showLogoutModal = false"
                class="px-3.5 py-2 w-full text-slate-900 text-sm font-semibold rounded-md cursor-pointer bg-white border border-slate-300 transition-colors hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
              >
                Tidak, Batal
              </button>
              <button
                type="button"
                @click="handleLogout"
                class="px-3.5 py-2 w-full text-white text-sm font-semibold rounded-md cursor-pointer bg-red-600 border border-red-600 transition-colors hover:bg-red-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
              >
                Ya, Keluar
              </button>
            </div>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>
