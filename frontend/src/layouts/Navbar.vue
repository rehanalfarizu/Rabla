<script setup>
import logoImg from '../assets/Logo.webp'
import { computed, ref, onMounted, onBeforeUnmount } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '../api'
import { useCart } from '../composables/useCart'

const router = useRouter()
const route = useRoute()
const { itemCount } = useCart()

const mobileMenuOpen = ref(false)
const dropdownOpen = ref(false)
const dropdownRef = ref(null)
const showLogoutModal = ref(false)

const isHomeActive = computed(() => route.path === '/')
const isProductsActive = computed(() => route.path.startsWith('/products'))

const showBanner = ref(true)
const showNavbar = ref(true)
const lastScrollY = ref(0)

const isLoggedIn = ref(false)
const authUser = ref({})

const loadAuthState = () => {
  const token = localStorage.getItem('auth_token')
  const user = localStorage.getItem('user')

  isLoggedIn.value = !!token
  authUser.value = user ? JSON.parse(user) : {}
}

const userInitial = computed(() => {
  const name = authUser.value?.name || authUser.value?.email || 'U'
  return name.charAt(0).toUpperCase()
})

const userName = computed(() => authUser.value?.name || authUser.value?.email || 'User')

const handleScroll = () => {
  const currentScroll = window.scrollY

  if (currentScroll > lastScrollY.value && currentScroll > 80) {
    showNavbar.value = false
  } else {
    showNavbar.value = true
  }

  lastScrollY.value = currentScroll
}

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

const stopWatch = router.afterEach(() => {
  loadAuthState()
  mobileMenuOpen.value = false
  dropdownOpen.value = false
})

onBeforeUnmount(() => stopWatch && stopWatch())

const confirmLogout = () => {
  dropdownOpen.value = false
  mobileMenuOpen.value = false
  showLogoutModal.value = true
}

const handleLogout = async () => {
  try {
    await api.post('/api/auth/logout')
  } catch (err) {
    console.warn('Logout API error:', err)
  } finally {
    localStorage.removeItem('auth_token')
    localStorage.removeItem('user')
    localStorage.removeItem('firebase_uid')

    isLoggedIn.value = false
    authUser.value = {}
    showLogoutModal.value = false

    router.push('/')
  }
}

const goToProfile = () => {
  dropdownOpen.value = false
  mobileMenuOpen.value = false

  if (authUser.value.profileCompleted) {
    router.push('/profile')
  } else {
    router.push('/complete-profile')
  }
}
</script>

<template>
  <div
    class="fixed left-0 top-0 z-50 w-full bg-white transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]"
    :class="showNavbar ? 'translate-y-0 opacity-100' : '-translate-y-full opacity-0'"
  >
    <!-- Banner -->
    <div
      v-if="showBanner"
      class="relative flex h-9 items-center justify-center bg-slate-950 px-4 text-center"
    >
      <p class="pr-8 text-[11px] font-semibold tracking-wide text-white sm:text-xs">
        Big news! Our new AI-powered search is now available for all Pro users —
        <a href="#" class="font-bold text-cyan-300 underline underline-offset-4 hover:text-cyan-200">
          Try it out!
        </a>
      </p>

      <button
        type="button"
        class="absolute right-4 rounded px-2 py-1 text-sm font-bold text-white/80 hover:bg-white/10 hover:text-white"
        @click="showBanner = false"
      >
        ×
      </button>
    </div>

    <!-- Navbar -->
    <header class="border-b border-slate-200 bg-white">
      <div class="mx-auto flex h-[76px] max-w-7xl items-center justify-between gap-4 px-4 md:px-6 lg:px-8">
        <!-- Logo -->
        <RouterLink
          to="/"
          class="flex shrink-0 items-center"
          @click="mobileMenuOpen = false"
        >
          <img :src="logoImg" alt="Rabla logo" class="h-10 w-auto md:h-11" />
        </RouterLink>

        <!-- Desktop Menu -->
        <nav class="hidden items-center gap-8 md:flex">
          <RouterLink
            to="/"
            class="relative text-sm font-semibold transition"
            :class="isHomeActive ? 'text-slate-950' : 'text-slate-500 hover:text-slate-950'"
          >
            Home
            <span
              class="absolute -bottom-2 left-1/2 h-1 w-6 -translate-x-1/2 rounded-full bg-slate-950 transition"
              :class="isHomeActive ? 'opacity-100' : 'opacity-0'"
            ></span>
          </RouterLink>

          <RouterLink
            to="/products"
            class="relative text-sm font-semibold transition"
            :class="isProductsActive ? 'text-slate-950' : 'text-slate-500 hover:text-slate-950'"
          >
            Products
            <span
              class="absolute -bottom-2 left-1/2 h-1 w-6 -translate-x-1/2 rounded-full bg-slate-950 transition"
              :class="isProductsActive ? 'opacity-100' : 'opacity-0'"
            ></span>
          </RouterLink>
        </nav>

        <!-- Desktop Right -->
        <div class="hidden items-center gap-3 md:flex">
          <!-- Search bar: hilang saat di halaman Products -->
          <form v-if="!isProductsActive" class="hidden md:block" role="search">
            <div class="flex h-10 w-[320px] items-center rounded-full border border-slate-200 bg-slate-50 px-3 transition focus-within:border-slate-900 focus-within:bg-white">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 shrink-0 text-slate-400"
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

              <input
                type="search"
                placeholder="Search products..."
                class="h-full w-full bg-transparent px-3 text-sm text-slate-700 outline-none placeholder:text-slate-400"
              />
            </div>
          </form>

          <template v-if="!isLoggedIn">
            <RouterLink
              to="/login"
              class="rounded-full px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-950"
            >
              Login
            </RouterLink>

            <RouterLink
              to="/register"
              class="rounded-full bg-slate-950 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800"
            >
              Sign up
            </RouterLink>
          </template>

          <template v-else>
            <RouterLink
              to="/cart"
              class="relative rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
              Cart
              <span
                v-if="itemCount > 0"
                class="absolute -right-2 -top-2 flex h-5 min-w-5 items-center justify-center rounded-full bg-slate-950 px-1.5 text-[10px] font-bold text-white"
              >
                {{ itemCount }}
              </span>
            </RouterLink>

            <div ref="dropdownRef" class="relative">
              <button
                type="button"
                class="flex items-center gap-2 rounded-full border border-slate-200 bg-white p-1 pr-3 transition hover:bg-slate-50"
                @click="dropdownOpen = !dropdownOpen"
              >
                <div class="flex h-8 w-8 items-center justify-center overflow-hidden rounded-full bg-slate-950 text-sm font-bold text-white">
                  <img
                    v-if="authUser.avatarUrl"
                    :src="authUser.avatarUrl"
                    :alt="userName"
                    class="h-full w-full object-cover"
                  />
                  <span v-else>{{ userInitial }}</span>
                </div>

                <span class="max-w-24 truncate text-sm font-semibold text-slate-700">
                  {{ userName }}
                </span>

                <span class="text-xs text-slate-400">▾</span>
              </button>

              <ul
                v-show="dropdownOpen"
                class="absolute right-0 z-50 mt-3 w-56 rounded-xl border border-slate-200 bg-white p-2 shadow-xl"
              >
                <li class="mb-1 rounded-lg bg-slate-50 px-3 py-2">
                  <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Masuk sebagai
                  </p>
                  <p class="truncate text-sm font-semibold text-slate-800">
                    {{ authUser.email }}
                  </p>
                </li>

                <li>
                  <button
                    type="button"
                    class="w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-slate-700 hover:bg-slate-100"
                    @click="goToProfile"
                  >
                    My Profile
                  </button>
                </li>

                <li>
                  <RouterLink
                    to="/order-history"
                    class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100"
                    @click="dropdownOpen = false"
                  >
                    Riwayat Pesanan
                  </RouterLink>
                </li>

                <li>
                  <RouterLink
                    to="/cart"
                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100"
                    @click="dropdownOpen = false"
                  >
                    <span>Keranjang Belanja</span>
                    <span
                      v-if="itemCount > 0"
                      class="rounded-full bg-slate-950 px-2 py-0.5 text-xs font-bold text-white"
                    >
                      {{ itemCount }}
                    </span>
                  </RouterLink>
                </li>

                <li class="my-1 border-t border-slate-100"></li>

                <li>
                  <button
                    type="button"
                    class="w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-red-600 hover:bg-red-50"
                    @click="confirmLogout"
                  >
                    Keluar
                  </button>
                </li>
              </ul>
            </div>
          </template>
        </div>

        <!-- Mobile Button -->
        <button
          type="button"
          class="ml-auto flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 md:hidden"
          @click="mobileMenuOpen = !mobileMenuOpen"
        >
          <svg
            v-if="!mobileMenuOpen"
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
          </svg>

          <svg
            v-else
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Mobile Menu -->
      <div
        v-show="mobileMenuOpen"
        class="border-t border-slate-200 bg-white px-4 py-4 shadow-lg md:hidden"
      >
        <!-- Search bar mobile: hilang saat di halaman Products -->
        <form v-if="!isProductsActive" class="mb-4" role="search">
          <div class="flex h-11 items-center rounded-xl border border-slate-200 bg-slate-50 px-3">
            <input
              type="search"
              placeholder="Search products..."
              class="h-full w-full bg-transparent text-sm outline-none placeholder:text-slate-400"
            />

            <button
              type="submit"
              class="rounded-lg bg-slate-950 px-4 py-2 text-xs font-semibold text-white"
            >
              Search
            </button>
          </div>
        </form>

        <nav class="flex flex-col gap-2">
          <RouterLink
            to="/"
            class="rounded-xl px-3 py-3 text-sm font-semibold"
            :class="isHomeActive ? 'bg-slate-100 text-slate-950' : 'text-slate-600'"
            @click="mobileMenuOpen = false"
          >
            Home
          </RouterLink>

          <RouterLink
            to="/products"
            class="rounded-xl px-3 py-3 text-sm font-semibold"
            :class="isProductsActive ? 'bg-slate-100 text-slate-950' : 'text-slate-600'"
            @click="mobileMenuOpen = false"
          >
            Products
          </RouterLink>

          <template v-if="!isLoggedIn">
            <div class="mt-2 grid grid-cols-2 gap-2">
              <RouterLink
                to="/login"
                class="rounded-xl border border-slate-200 px-3 py-3 text-center text-sm font-semibold text-slate-700"
                @click="mobileMenuOpen = false"
              >
                Login
              </RouterLink>

              <RouterLink
                to="/register"
                class="rounded-xl bg-slate-950 px-3 py-3 text-center text-sm font-semibold text-white"
                @click="mobileMenuOpen = false"
              >
                Sign up
              </RouterLink>
            </div>
          </template>

          <template v-else>
            <div class="mt-2 rounded-xl bg-slate-50 px-3 py-3">
              <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Masuk sebagai
              </p>
              <p class="truncate text-sm font-semibold text-slate-800">
                {{ authUser.email }}
              </p>
            </div>

            <button
              type="button"
              class="rounded-xl px-3 py-3 text-left text-sm font-semibold text-slate-600"
              @click="goToProfile"
            >
              My Profile
            </button>

            <RouterLink
              to="/order-history"
              class="rounded-xl px-3 py-3 text-sm font-semibold text-slate-600"
              @click="mobileMenuOpen = false"
            >
              Riwayat Pesanan
            </RouterLink>

            <RouterLink
              to="/cart"
              class="flex items-center justify-between rounded-xl px-3 py-3 text-sm font-semibold text-slate-600"
              @click="mobileMenuOpen = false"
            >
              <span>Keranjang Belanja</span>
              <span
                v-if="itemCount > 0"
                class="rounded-full bg-slate-950 px-2 py-0.5 text-xs font-bold text-white"
              >
                {{ itemCount }}
              </span>
            </RouterLink>

            <button
              type="button"
              class="rounded-xl px-3 py-3 text-left text-sm font-semibold text-red-600"
              @click="confirmLogout"
            >
              Keluar
            </button>
          </template>
        </nav>
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
        class="fixed inset-0 z-[1000] flex h-full w-full items-center justify-center p-4 before:fixed before:inset-0 before:bg-black/50"
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
            class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl"
          >
            <button
              type="button"
              class="absolute right-5 top-5 rounded-full px-2 py-1 text-xl leading-none text-slate-400 hover:bg-slate-100 hover:text-slate-700"
              @click="showLogoutModal = false"
            >
              ×
            </button>

            <div class="text-center">
              <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-red-50 text-2xl">
                🚪
              </div>

              <h3 class="text-lg font-bold text-slate-950">
                Yakin ingin keluar?
              </h3>

              <p class="mt-2 text-sm leading-relaxed text-slate-600">
                Kamu akan keluar dari akun
                <span class="font-semibold text-slate-800">{{ authUser.email }}</span>.
                Sesi kamu akan diakhiri dan kamu perlu login kembali.
              </p>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
              <button
                type="button"
                class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                @click="showLogoutModal = false"
              >
                Batal
              </button>

              <button
                type="button"
                class="rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-700"
                @click="handleLogout"
              >
                Keluar
              </button>
            </div>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>