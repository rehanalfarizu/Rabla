<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const email = ref('')
const password = ref('')
const rememberMe = ref(false)

const handleLogin = (e) => {
  e.preventDefault()
  // TODO: Implement login logic here
  console.log({ email: email.value, password: password.value, rememberMe: rememberMe.value })
  router.push('/')
}

const handleForgotPassword = () => {
  // TODO: Implement forgot password logic
  console.log('Forgot password clicked')
}

const goToSignup = () => {
  // TODO: Add signup route when available
  router.push('/register')
}
</script>

<template>
  <main class="bg-gray-50 px-4 md:px-8">
    <div class="min-h-screen flex flex-col items-center justify-center">
      <div class="max-w-md w-full">
        <div class="p-6 rounded-lg bg-white border border-slate-300 shadow-xs md:p-8">
          <h1 class="text-slate-900 text-center text-3xl font-bold">Log in</h1>

          <form class="space-y-6 mt-10" @submit="handleLogin">
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

            <div class="flex items-start flex-wrap gap-2">
              <label class="flex items-center group has-[input:checked]:text-slate-900">
                <input v-model="rememberMe" id="remember" name="remember" type="checkbox" class="sr-only" />
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
                <span class="ml-3 text-sm text-slate-700"> Remember me </span>
              </label>

              <button
                type="button"
                @click="handleForgotPassword"
                class="ml-auto text-sm font-medium text-blue-700 hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded"
              >
                Forgot password?
              </button>
            </div>

            <button
              type="submit"
              class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer tracking-wide text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
            >
              Log in
            </button>

            <div class="text-slate-900 text-sm text-center">
              Don't have an account?
              <button
                type="button"
                @click="goToSignup"
                class="text-blue-700 hover:underline ml-1 font-medium focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded"
              >
                Register
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</template>
