<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import logoImg from '../assets/Logo.webp'

const router = useRouter()
const fullName = ref('')
const email = ref('')
const password = ref('')
const confirmPassword = ref('')
const agreeTerms = ref(false)
const errorMsg = ref('')
const isLoading = ref(false)

const handleRegister = async (e) => {
  e.preventDefault()
  errorMsg.value = ''

  if (password.value !== confirmPassword.value) {
    errorMsg.value = 'Password dan konfirmasi password tidak cocok!'
    return
  }
  if (!agreeTerms.value) {
    errorMsg.value = 'Harap setujui syarat dan ketentuan terlebih dahulu.'
    return
  }

  isLoading.value = true
  try {
    // TODO: Ganti dengan API call ke backend saat sudah tersedia
    // Contoh: const res = await fetch('/api/auth/register', { method: 'POST', body: JSON.stringify({...}) })
    console.log({ fullName: fullName.value, email: email.value, agreeTerms: agreeTerms.value })

    // Simpan token & info user ke localStorage (langsung login setelah register)
    const fakeToken = btoa(`${email.value}:${Date.now()}`)
    localStorage.setItem('auth_token', fakeToken)
    localStorage.setItem('auth_user', JSON.stringify({
      email: email.value,
      name: fullName.value,
      profileCompleted: false,
    }))

    // Simpan kredensial di key terpisah untuk validasi login
    // Catatan: di produksi, password tidak boleh disimpan plain-text — gunakan backend + hashing
    const credentials = JSON.parse(localStorage.getItem('auth_credentials') || '[]')
    const existing = credentials.findIndex(c => c.email === email.value)
    const entry = { email: email.value, password: password.value }
    if (existing >= 0) credentials[existing] = entry
    else credentials.push(entry)
    localStorage.setItem('auth_credentials', JSON.stringify(credentials))

    // Redirect ke halaman OTP untuk verifikasi
    router.push('/otp-verification')
  } catch (err) {
    errorMsg.value = 'Registrasi gagal. Silakan coba lagi.'
    console.error(err)
  } finally {
    isLoading.value = false
  }
}

const goToLogin = () => {
  router.push('/login')
}
</script>

<template>
  <main class="bg-gray-50 px-4 md:px-8 relative min-h-screen">
    <!-- Breadcrumb Navbar -->
    <div class="absolute top-0 left-0 w-full pt-6 px-4">
      <nav aria-label="Breadcrumb">
         <ul class="flex items-center justify-center gap-3">
            <li>
               <div class="flex items-center">
                  <RouterLink to="/"
                     class="text-slate-500 font-medium text-sm leading-snug flex items-center gap-2 hover:text-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded">
                     <svg xmlns="http://www.w3.org/2000/svg" class="size-4 fill-current overflow-visible"
                        viewBox="0 0 512 512" aria-hidden="true">
                        <path
                           d="M426 495.983H86c-25.364 0-46-20.635-46-46v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 7.72 6.28 14 14 14h340c7.72 0 14-6.28 14-14v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 25.364-20.635 46-46 46"
                           data-original="#000000" />
                        <path
                           d="M496 263.958a15.95 15.95 0 0 1-11.313-4.687L285.698 60.284c-16.375-16.376-43.02-16.376-59.396 0L27.314 259.272c-6.248 6.249-16.379 6.249-22.627 0-6.249-6.248-6.249-16.379 0-22.627L203.675 37.656c28.852-28.852 75.799-28.852 104.65 0l198.988 198.988c6.249 6.249 6.249 16.379 0 22.627A15.94 15.94 0 0 1 496 263.958M320 495.983H192c-8.837 0-16-7.164-16-16v-142c0-27.57 22.43-50 50-50h60c27.57 0 50 22.43 50 50v142c0 8.836-7.163 16-16 16m-112-32h96v-126c0-9.925-8.075-18-18-18h-60c-9.925 0-18 8.075-18 18z"
                           data-original="#000000" />
                     </svg>
                     Home
                  </RouterLink>
               </div>
            </li>
            <li aria-current="page">
               <div class="flex items-center gap-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="fill-slate-500 size-2.5 overflow-visible"
                     viewBox="0 0 451.846 451.847" aria-hidden="true">
                     <path
                        d="M345.441 248.292 151.154 442.573c-12.359 12.365-32.397 12.365-44.75 0-12.354-12.354-12.354-32.391 0-44.744L278.318 225.92 106.409 54.017c-12.354-12.359-12.354-32.394 0-44.748 12.354-12.359 32.391-12.359 44.75 0l194.287 194.284c6.177 6.18 9.262 14.271 9.262 22.366 0 8.099-3.091 16.196-9.267 22.373"
                        data-original="#000000" />
                  </svg>
                  <span class="text-slate-900 text-sm leading-snug font-medium">
                     Register
                  </span>
               </div>
            </li>
         </ul>
      </nav>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center pt-24 pb-12">
      <div class="max-w-md w-full">
        <div class="p-6 rounded-lg bg-white border border-slate-300 shadow-xs md:p-8">
          <h1 class="text-slate-900 text-center text-3xl font-bold">Register</h1>

          <form class="space-y-6 mt-10" @submit="handleRegister">
            <div>
              <label for="fullName" class="mb-2 text-slate-900 font-medium text-sm inline-block">Full Name</label>
              <input
                v-model="fullName"
                type="text"
                id="fullName"
                name="fullName"
                placeholder="John Doe"
                required
                class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600"
              />
            </div>
            <div>
              <label for="email" class="mb-2 text-slate-900 font-medium text-sm inline-block">Email</label>
              <input
                v-model="email"
                type="email"
                id="email"
                name="email"
                placeholder="john@readymadeui.com"
                required
                class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600"
              />
            </div>
            <div>
              <label for="password" class="mb-2 text-slate-900 font-medium text-sm inline-block">Password</label>
              <input
                v-model="password"
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
                class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600"
              />
            </div>
            <div>
              <label for="confirmPassword" class="mb-2 text-slate-900 font-medium text-sm inline-block">Confirm Password</label>
              <input
                v-model="confirmPassword"
                type="password"
                id="confirmPassword"
                name="confirmPassword"
                placeholder="••••••••"
                required
                class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600"
              />
            </div>

            <div class="flex items-start flex-wrap gap-2">
              <label class="flex items-center group has-[input:checked]:text-slate-900">
                <input v-model="agreeTerms" id="agree" name="agree" type="checkbox" class="sr-only" required />
                <!-- Custom box -->
                <span
                  class="flex h-4 w-4 shrink-0 items-center justify-center rounded outline-1 outline-slate-300 bg-white group-has-[input:checked]:bg-blue-600 group-has-[input:checked]:outline-blue-600 group-focus-within:outline-2 group-focus-within:outline-blue-600"
                  aria-hidden="true"
                >
                  <!-- Checkmark -->
                  <svg
                    class="size-3 text-white opacity-0 group-has-[input:checked]:opacity-100"
                    viewBox="0 0 12 10"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path d="M1 5l3 3 7-7" />
                  </svg>
                </span>
                <span class="ml-3 text-sm text-slate-700">
                  I agree to the
                  <a href="#" class="text-blue-700 hover:underline font-medium">Terms and Conditions</a>
                </span>
              </label>
            </div>

            <!-- Error Message -->
            <p v-if="errorMsg" class="text-red-600 text-sm text-center -mt-2">{{ errorMsg }}</p>

            <button
              type="submit"
              :disabled="isLoading"
              class="w-full py-2 px-3.5 text-sm rounded-md font-semibold tracking-wide text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 disabled:opacity-60 disabled:cursor-not-allowed"
            >
              <span v-if="isLoading">Mendaftar...</span>
              <span v-else>Register</span>
            </button>

            <div class="text-slate-900 text-sm text-center">
              Already have an account?
              <button
                type="button"
                @click="goToLogin"
                class="text-blue-700 hover:underline ml-1 font-medium focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded"
              >
                Log in
              </button>
            </div>
          </form>
          </div>
        </div>
      </div>
  </main>
</template>
