<script setup>
import logoImg from '../assets/Logo.webp'
import { computed, ref } from 'vue'
import { useRoute } from 'vue-router'


const mobileMenuOpen = ref(false)
const route = useRoute()
const isHomeActive = computed(() => route.path === '/')
const isProductsActive = computed(() => route.path.startsWith('/products'))
</script>

<template>
  <header class="fixed top-0 left-0 z-50 flex h-16 w-full items-center bg-white shadow-md tracking-wide sm:h-20">
    <div class="container mx-auto flex w-full items-center justify-between px-4">
      <RouterLink to="/" class="max-sm:hidden">
        <img :src="logoImg" alt="logo" class="w-28 sm:w-32" />
      </RouterLink>
      <RouterLink to="/" class="hidden max-sm:block">
        <img :src="logoImg" alt="logo" class="w-8" />
      </RouterLink>

      <div
        class="max-lg:before:fixed max-lg:before:inset-0 max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:z-50"
        :class="mobileMenuOpen ? 'block lg:flex' : 'hidden lg:flex'"
      >
        <button
          class="fixed right-4 top-2 z-100 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full border border-gray-200 bg-white lg:hidden"
          @click="mobileMenuOpen = false"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-black" viewBox="0 0 320.591 320.591">
            <path
              d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
            ></path>
            <path
              d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
            ></path>
          </svg>
        </button>

        <ul class="z-50 gap-x-4 max-lg:fixed max-lg:left-0 max-lg:top-0 max-lg:h-full max-lg:w-1/2 max-lg:min-w-75 max-lg:space-y-3 max-lg:overflow-auto max-lg:bg-white max-lg:p-6 max-lg:shadow-md lg:flex">
          <li class="mb-6 hidden max-lg:block">
            <RouterLink to="/">
              <img :src="logoImg" alt="logo" class="w-28" />
            </RouterLink>
          </li>
          <li class="px-3 max-lg:border-b max-lg:border-gray-300 max-lg:py-3">
            <RouterLink to="/" class="block text-[15px] font-medium hover:text-blue-700"
              :class="isHomeActive ? 'text-blue-700' : 'text-slate-900'">Home</RouterLink>
          </li>
          <li class="px-3 max-lg:border-b max-lg:border-gray-300 max-lg:py-3">
            <a href="javascript:void(0)" class="block text-[15px] font-medium text-slate-900 hover:text-blue-700">Team</a>
          </li>
          <li class="px-3 max-lg:border-b max-lg:border-gray-300 max-lg:py-3">
            <a href="javascript:void(0)" class="block text-[15px] font-medium text-slate-900 hover:text-blue-700">Feature</a>
          </li>
          <li class="px-3 max-lg:border-b max-lg:border-gray-300 max-lg:py-3">
            <RouterLink
              to="/products"
              class="block text-[15px] font-medium hover:text-blue-700"
              :class="isProductsActive ? 'text-blue-700' : 'text-slate-900'"
            >
              Products
            </RouterLink>
          </li>
          <li class="px-3 max-lg:border-b max-lg:border-gray-300 max-lg:py-3">
            <a href="javascript:void(0)" class="block text-[15px] font-medium text-slate-900 hover:text-blue-700">About</a>
          </li>
          <li class="px-3 max-lg:border-b max-lg:border-gray-300 max-lg:py-3">
            <a href="javascript:void(0)" class="block text-[15px] font-medium text-slate-900 hover:text-blue-700">Contact</a>
          </li>
        </ul>
      </div>

      <div class="flex space-x-3 max-lg:ml-auto">
        <RouterLink to="/login"
          class="cursor-pointer rounded-full border border-gray-400 bg-transparent px-3 py-1.5 text-sm font-medium tracking-wide text-slate-900 transition-all hover:bg-gray-50"
        >
          Login
        </RouterLink>
        <RouterLink to="/register"
          class="cursor-pointer rounded-full border border-blue-600 bg-blue-600 px-3 py-1.5 text-sm font-medium tracking-wide text-white transition-all hover:bg-blue-700"
        >
          Sign up
        </RouterLink>

        <button class="cursor-pointer lg:hidden" @click="mobileMenuOpen = true">
          <svg class="h-6 w-6" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
              fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </button>
      </div>
    </div>
  </header>
</template>