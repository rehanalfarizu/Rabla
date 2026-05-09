<script setup>
import logoImg from '../assets/Logo.webp'
import { computed, ref, onMounted, onBeforeUnmount } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const router = useRouter()
const route = useRoute()

const mobileMenuOpen = ref(false)
const dropdownOpen = ref(false)
const dropdownRef = ref(null)
const showLogoutModal = ref(false)

const isHomeActive = computed(() => route.path === '/')
const isProductsActive = computed(() => route.path.startsWith('/products'))

const showBanner = ref(true)
const showNavbar = ref(true)
const lastScrollY = ref(0)

// --- Auth State ---
const isLoggedIn = ref(false)
const authUser = ref({})

const loadAuthState = () => {
  const token = localStorage.getItem('auth_token')
  const user = localStorage.getItem('auth_user')
  isLoggedIn.value = !!token
  authUser.value = user ? JSON.parse(user) : {}
}

// Inisial huruf dari nama user untuk avatar fallback
const userInitial = computed(() => {
  const name = authUser.value?.name || authUser.value?.email || 'U'
  return name.charAt(0).toUpperCase()
})

const userName = computed(() => authUser.value?.name || authUser.value?.email || 'User')

const handleScroll = () => {
  const currentScroll = window.scrollY

  if (currentScroll > lastScrollY.value && currentScroll > 80) {
    // scroll ke bawah
    showNavbar.value = false
  } else {
    // scroll ke atas
    showNavbar.value = true
  }

  lastScrollY.value = currentScroll
}

// Close dropdown saat klik di luar
const handleClickOutside = (e) => {
  if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
    dropdownOpen.value = false
  }
}

onMounted(() => {
  loadAuthState()
  document.addEventListener('click', handleClickOutside)
  window.addEventListener('scroll', handleScroll)
})

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
  window.removeEventListener('scroll', handleScroll)
})

// Re-cek auth setiap kali route berubah (setelah login/logout)
const stopWatch = router.afterEach(() => { loadAuthState() })
onBeforeUnmount(() => stopWatch && stopWatch())

// Buka modal konfirmasi logout
const confirmLogout = () => {
  dropdownOpen.value = false
  showLogoutModal.value = true
}

// Eksekusi logout sebenarnya (dipanggil dari modal)
const handleLogout = () => {
  localStorage.removeItem('auth_token')
  localStorage.removeItem('auth_user')
  isLoggedIn.value = false
  authUser.value = {}
  showLogoutModal.value = false
  router.push('/')
}

const goToProfile = () => {
  dropdownOpen.value = false
  if (authUser.value.profileCompleted) {
    router.push('/profile')
  } else {
    router.push('/complete-profile')
  }
}
</script>

<template>
  <div
  class="fixed top-0 left-0 z-50 w-full transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]"
  :class="showNavbar ? 'translate-y-0 opacity-100' : '-translate-y-full opacity-0'"
>
    <!-- Promotion Banner -->
    <div v-if="showBanner" role="region" aria-label="Promotion" class="bg-slate-800 px-4 py-2.5 relative flex items-center border-b border-slate-800 md:px-6">
      <p class="text-sm text-slate-50 font-medium pr-6 leading-relaxed flex-1 text-center sm:text-left">
          Big news! Our new AI-powered search is now available for all Pro users – 
          <a href="#" class="ml-1 underline underline-offset-4 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded text-blue-300 hover:text-blue-200">Try it out!</a>
      </p>
      <button @click="showBanner = false" type="button" aria-label="Dismiss notification banner" class="absolute right-4 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded p-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-3 cursor-pointer fill-slate-50 hover:fill-red-400 transition" aria-hidden="true" viewBox="0 0 329.269 329"><path d="M194.8 164.77 323.013 36.555c8.343-8.34 8.343-21.825 0-30.164-8.34-8.34-21.825-8.34-30.164 0L164.633 134.605 36.422 6.391c-8.344-8.34-21.824-8.34-30.164 0-8.344 8.34-8.344 21.824 0 30.164l128.21 128.215L6.259 292.984c-8.344 8.34-8.344 21.825 0 30.164a21.27 21.27 0 0 0 15.082 6.25c5.46 0 10.922-2.09 15.082-6.25l128.21-128.214 128.216 128.214a21.27 21.27 0 0 0 15.082 6.25c5.46 0 10.922-2.09 15.082-6.25 8.343-8.34 8.343-21.824 0-30.164zm0 0"/></svg>
      </button>
    </div>
    
    <!-- Main Navigation -->
    <header
  class="h-[88px] w-full border-b border-slate-200/60 bg-white/95 backdrop-blur-xl shadow-sm">
      <div
  class="container relative mx-auto flex items-start justify-between px-5 pt-2 lg:px-8"
>
      <RouterLink to="/" class="max-sm:hidden relative -top-1">
        <img :src="logoImg" alt="logo" class="w-24 md:w-28 lg:w-32" />
      </RouterLink>
      <RouterLink to="/" class="hidden max-sm:block">
        <img :src="logoImg" alt="logo" class="w-8" />
      </RouterLink>

<div class="absolute left-1/2 top-1/2 flex w-full max-w-[560px] -translate-x-1/2 -translate-y-1/2 flex-col items-start">
  <!-- Search -->
  <div class="w-full max-w-[540px]">

    <form class="w-full" role="search">

      <div
        class="group flex h-[42px] w-full items-center rounded-full border border-slate-200 bg-white/95 px-2 shadow-[0_2px_10px_rgba(15,23,42,0.05)] transition-all duration-300 hover:shadow-[0_4px_14px_rgba(15,23,42,0.08)] focus-within:border-slate-300"
      >

        <!-- Icon -->
        <div class="pl-3 text-slate-400">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-[18px]"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
            />
          </svg>
        </div>

        <!-- Input -->
        <input
          type="search"
          id="search"
          placeholder="Search products..."
          required
          class="h-full w-full bg-transparent px-4 text-[14px] font-medium text-slate-700 outline-none placeholder:text-slate-400"
        />

        <!-- Button -->
        <button
          type="submit"
          aria-label="Search"
          class="flex h-8 items-center justify-center rounded-full bg-slate-900 px-5 text-sm font-medium text-white transition-all duration-300 hover:bg-slate-700"
        >
          Search
        </button>

      </div>

    </form>

  </div>

  <!-- Navigation Menu -->
<ul class="mt-2 flex items-center gap-3">

  <!-- Home -->
  <li>
    <RouterLink
      to="/"
      class="rounded-full px-4 py-1.5 text-[13px] font-medium text-slate-500 transition-all duration-200 hover:text-slate-900"
      :class="
        isHomeActive
          ? 'text-slate-900'
          : 'text-slate-500'
      "
    >
      Home
    </RouterLink>
  </li>

  <!-- Products -->
  <li>
    <RouterLink
      to="/products"
      class="rounded-full px-3.5 py-1.5 text-[13px] font-medium text-slate-500 transition-all duration-200 hover:text-slate-900"
      :class="
        isProductsActive
          ? 'text-slate-900'
          : 'text-slate-500'
      "
    >
      Products
    </RouterLink>
  </li>

</ul>

</div>

      <div class="ml-auto flex items-center gap-2 relative top-1">

        <template v-if="!isLoggedIn">

  <!-- Auth Buttons -->
<div class="ml-auto flex items-center gap-1.5 pr-1">

  <!-- Login -->
  <RouterLink
    to="/login"
    class="flex h-[36px] items-center justify-center rounded-full px-5 text-[13px] font-medium text-slate-600 transition-all duration-300 hover:bg-slate-100 hover:text-slate-900"
  >
    Login
  </RouterLink>

  <!-- Signup -->
  <RouterLink
    to="/register"
    class="flex h-[36px] items-center justify-center rounded-full px-5 text-[13px] font-medium text-slate-600 transition-all duration-300 hover:bg-slate-100 hover:text-slate-900"
  >
    Sign up
  </RouterLink>

</div>
</template>

        <!-- Sudah Login: Avatar + Dropdown -->
        <template v-else>
          <div ref="dropdownRef" class="relative">
            <button
              type="button"
              id="user-dropdown-toggle"
              :aria-expanded="dropdownOpen"
              aria-haspopup="true"
              aria-controls="user-dropdown-menu"
              @click="dropdownOpen = !dropdownOpen"
              class="flex items-center gap-2 rounded-full border border-slate-200 bg-white p-1 pr-3 shadow-sm transition hover:border-slate-300 hover:shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 cursor-pointer"
            >
              <!-- Avatar: gunakan foto profil jika ada, fallback ke inisial -->
              <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white overflow-hidden">
                <img
                  v-if="authUser.avatarUrl"
                  :src="authUser.avatarUrl"
                  :alt="userName"
                  class="h-full w-full object-cover"
                />
                <span v-else>{{ userInitial }}</span>
              </div>
              <span class="max-w-28 truncate text-sm font-medium text-slate-700">{{ userName }}</span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 fill-slate-400 transition-transform duration-200"
                :class="dropdownOpen ? 'rotate-180' : ''"
                viewBox="0 0 512 512"
                aria-hidden="true"
              >
                <path d="M511 138.2c-3-13.8-11.2-23.1-25.2-27-15.3-4.3-28 .4-38.8 11.3-41.9 42-83.7 84.1-125.5 126.2-21 21-42.2 41.9-65.4 65L64.7 122.3c-16-16-38.8-16.9-53.6-2.8s-15 38 .6 53.7C83.9 245.8 156.4 318.3 229 390.5c15.8 15.7 38 16.1 53.5.6 73-72.5 145.7-145.2 218.2-218.1 9.5-9.6 13.3-21.4 10.3-34.8" />
              </svg>
            </button>

            <!-- Dropdown Menu -->
            <ul
              id="user-dropdown-menu"
              aria-labelledby="user-dropdown-toggle"
              v-show="dropdownOpen"
              class="absolute right-0 mt-2 min-w-48 rounded-xl border border-slate-200 bg-white p-2 shadow-lg z-50"
            >
              <!-- Info User -->
              <li class="mb-1 px-2 py-1.5 border-b border-slate-100">
                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Masuk sebagai</p>
                <p class="text-sm font-semibold text-slate-800 truncate">{{ authUser.email }}</p>
              </li>

              <li>
                <button
                  type="button"
                  @click="goToProfile"
                  class="flex w-full items-center gap-2.5 rounded-lg p-2 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-slate-900"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-[18px] fill-current shrink-0" viewBox="0 0 512 512" aria-hidden="true">
                    <path d="M253.414 103.434c48.556 0 87.919 40.52 87.919 90.505s-39.363 90.505-87.919 90.505-87.919-40.521-87.919-90.505 39.363-90.505 87.919-90.505m0 36.202c-28.324 0-51.717 24.081-51.717 54.303s23.393 54.303 51.717 54.303 51.717-24.081 51.717-54.303-23.393-54.303-51.717-54.303" />
                    <path d="M253.414 0c139.957 0 253.414 113.457 253.414 253.414 0 94.285-51.491 176.544-127.886 220.19-35.728 20.575-77.036 32.582-121.104 33.199l-4.423.025C113.457 506.828 0 393.371 0 253.414S113.457 0 253.414 0m-23.676 346.505c-46.331 0-87.479 29.378-102.607 73.008l-2.339 7.571c35.919 27.232 80.165 42.893 126.504 43.522l5.709-.009c38.24-.62 74.079-11.122 105.072-29.064l19.977-13.243-2.237-6.866c-14.371-44.046-55.062-74.052-101.239-74.901zm23.676-310.303c-119.963 0-217.212 97.249-217.212 217.212 0 57.493 22.337 109.77 58.807 148.624 21.668-55.072 74.965-91.735 134.73-91.735h46.831c59.905 0 113.311 36.835 134.885 92.121 36.686-38.892 59.172-91.325 59.172-149.01-.001-119.963-97.25-217.212-217.213-217.212" />
                  </svg>
                  My Profile
                </button>
              </li>

              <li>
                <RouterLink to="/order-history"
                  @click="dropdownOpen = false"
                  class="flex w-full items-center gap-2.5 rounded-lg p-2 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-slate-900"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-[18px] fill-current shrink-0" viewBox="0 0 32 32" aria-hidden="true">
                    <g data-name="Layer 2">
                      <path d="M24.915 3.663a3.15 3.15 0 0 0-2.688-1.554H9.774a3.15 3.15 0 0 0-2.688 1.554L.859 14.446a3.15 3.15 0 0 0 0 3.15l6.227 10.742a3.15 3.15 0 0 0 2.688 1.554h12.453a3.15 3.15 0 0 0 2.688-1.554l6.226-10.784a3.15 3.15 0 0 0 0-3.15zm4.41 12.841-6.227 10.784a1.05 1.05 0 0 1-.871.504H9.774a1.05 1.05 0 0 1-.872-.504L2.676 16.504a1.05 1.05 0 0 1 0-1.05L8.902 4.713a1.05 1.05 0 0 1 .872-.504h12.453a1.05 1.05 0 0 1 .871.504l6.227 10.783a1.05 1.05 0 0 1 0 1.008" />
                      <path d="M16 9.7a6.3 6.3 0 1 0 6.3 6.3A6.3 6.3 0 0 0 16 9.7m0 10.5a4.2 4.2 0 1 1 4.2-4.2 4.2 4.2 0 0 1-4.2 4.2" />
                    </g>
                  </svg>
                  Riwayat Pesanan
                </RouterLink>
              </li>

              <li>
                <RouterLink to="/cart"
                  @click="dropdownOpen = false"
                  class="flex w-full items-center gap-2.5 rounded-lg p-2 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-slate-900"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-[18px] fill-current shrink-0" viewBox="0 0 456 512" aria-hidden="true">
                    <path d="M456 80H56c-30.878 0-56 25.122-56 56v240c0 30.878 25.122 56 56 56h400c30.878 0 56-25.122 56-56V136c0-30.878-25.122-56-56-56M56 112h400c13.233 0 24 10.767 24 24v32H32v-32c0-13.233 10.767-24 24-24m400 288H56c-13.233 0-24-10.767-24-24V200h448v176c0 13.233-10.767 24-24 24" />
                  </svg>
                  Keranjang Belanja
                </RouterLink>
              </li>

              <!-- Divider -->
              <li class="my-1 border-t border-slate-100"></li>

              <li>
                <button
                  type="button"
                  @click="confirmLogout"
                  class="flex w-full items-center gap-2.5 rounded-lg p-2 text-sm text-red-600 transition hover:bg-red-50 hover:text-red-700"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-[18px] fill-current shrink-0" viewBox="0 0 512 512" aria-hidden="true">
                    <path d="M312 371.98c-8.284 0-15 6.716-15 15v75H45V50.02h252v75c0 8.284 6.716 15 15 15s15-6.716 15-15v-90c0-8.284-6.716-15-15-15H30c-8.284 0-15 6.716-15 15v412c0 8.284 6.716 15 15 15h282c8.284 0 15-6.716 15-15v-90c0-8.284-6.716-15-15-15z" />
                    <path d="M495.609 248.38 406.628 159.4c-5.858-5.858-15.355-5.858-21.213 0-5.858 5.858-5.858 15.355 0 21.213l67.986 67.987H167c-8.284 0-15 6.716-15 15s6.716 15 15 15h286.401l-67.986 67.987c-5.858 5.858-5.858 15.355 0 21.213 2.929 2.929 6.768 4.394 10.607 4.394s7.678-1.465 10.607-4.394l88.98-88.98c5.857-5.858 5.857-15.356 0-21.214z" />
                  </svg>
                  Keluar
                </button>
              </li>
            </ul>
          </div>
        </template>

        
      </div>
    </div>
  </header>
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
                Kamu akan keluar dari akun <span class="font-medium text-slate-800">{{ authUser.email }}</span>.
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