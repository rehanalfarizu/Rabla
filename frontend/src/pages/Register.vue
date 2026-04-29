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

const handleRegister = (e) => {
  e.preventDefault()
  if (password.value !== confirmPassword.value) {
    alert('Passwords do not match!')
    return
  }
  if (!agreeTerms.value) {
    alert('Please agree to the terms and conditions!')
    return
  }
  // TODO: Implement register logic here
  console.log({
    fullName: fullName.value,
    email: email.value,
    password: password.value,
    agreeTerms: agreeTerms.value
  })
  router.push('/login')
}

const goToLogin = () => {
  router.push('/login')
}
</script>

<template>
  <main class="bg-gray-50 px-4 md:px-8">
    <div class="min-h-screen flex flex-col items-center justify-center">
      <div class="max-w-md w-full">
        <div class="mt-20">
        <div class="p-6 rounded-lg bg-white border border-slate-300 shadow-xs md:p-8">
          <h1 class="text-slate-900 text-center text-3xl font-bold">Sign up</h1>

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

            <button
              type="submit"
              class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer tracking-wide text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
            >
              Sign up
            </button>

            <div class="text-slate-900 text-sm text-center">
              Already have an account?
              <button
                type="button"
                @click="goToLogin"
                class="text-blue-700 hover:underline ml-1 font-medium focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded"
              >
                Sign in
              </button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
