<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import ToastAlert from '../components/ToastAlert.vue'
import api from '../api'
import { firebaseAuth } from '../firebase'

const router = useRouter()
const toastRef = ref(null)

const isLoading = ref(false)
const email = ref('')
const password = ref('')
const errorMessage = ref('')

// Password login
const handlePasswordLogin = async (e) => {
  e.preventDefault()
  errorMessage.value = ''

  if (!email.value || !password.value) {
    toastRef.value.show('warning', 'Email dan password wajib diisi.')
    return
  }

  isLoading.value = true

  try {
    const response = await api.post('/api/auth/login', {
      email: email.value,
      password: password.value,
    })

    localStorage.setItem('auth_token', response.data.token)
    localStorage.setItem('user', JSON.stringify(response.data.user))
    toastRef.value.show('success', 'Login berhasil!')
    router.push('/')
  } catch (err) {
    const errMsg = err.response?.data?.message || err.response?.data?.errors?.email?.[0] || 'Login gagal.'
    errorMessage.value = errMsg
    toastRef.value.show('error', errMsg)
  } finally {
    isLoading.value = false
  }
}

// Google Sign-In
const handleGoogleLogin = async () => {
  isLoading.value = true
  errorMessage.value = ''

  try {
    // Note: Google popup requires additional setup in Firebase Console
    // For now, use email link as Google alternative
    if (!email.value || !email.value.includes('@')) {
      toastRef.value.show('warning', 'Masukkan email Google kamu terlebih dahulu.')
      isLoading.value = false
      return
    }

    const actionCodeSettings = {
      url: `${window.location.origin}/login`,
      handleCodeInApp: true,
    }

    await firebaseAuth.sendSignInLinkToEmail(firebaseAuth.auth, email.value, actionCodeSettings)
    localStorage.setItem('emailForSignIn', email.value)

    toastRef.value.show('success', `Link login Google dikirim ke ${email.value}. Cek email!`)
  } catch (error) {
    console.error('Google login error:', error)
    toastRef.value.show('error', 'Login dengan Google gagal.')
  } finally {
    isLoading.value = false
  }
}

const goToSignup = () => router.push('/register')
</script>

<template>
  <ToastAlert ref="toastRef" />

  <main class="bg-gray-50 px-4 md:px-8 relative min-h-screen">
    <!-- Loading overlay -->
    <div v-if="isLoading" class="fixed inset-0 bg-white/80 z-50 flex items-center justify-center">
      <div class="text-center">
        <svg class="animate-spin h-10 w-10 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p class="mt-4 text-gray-600">Memproses...</p>
      </div>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center pt-20">
      <div class="max-w-md w-full">
        <div class="p-6 rounded-lg bg-white border border-slate-300 shadow-xs md:p-8">
          <h1 class="text-slate-900 text-center text-3xl font-bold">Log in</h1>

          <form @submit="handlePasswordLogin" class="mt-8 space-y-4">
            <div>
              <label class="mb-2 text-slate-900 font-medium text-sm inline-block">Email</label>
              <input v-model="email" type="email" placeholder="john@example.com"
                class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600" />
            </div>
            <div>
              <label class="mb-2 text-slate-900 font-medium text-sm inline-block">Password</label>
              <input v-model="password" type="password" placeholder="••••••••"
                class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600" />
            </div>
            <p v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</p>
            <button type="submit"
              class="w-full py-2.5 px-4 text-sm rounded-md font-semibold text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all disabled:opacity-60 disabled:cursor-not-allowed">
              Log in
            </button>
          </form>

          <!-- Divider -->
          <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-slate-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="bg-white px-2 text-slate-500">Atau</span>
            </div>
          </div>

          <!-- Google Button -->
          <button @click="handleGoogleLogin"
            class="w-full py-2.5 px-4 text-sm rounded-md font-semibold text-slate-700 border border-slate-300 bg-white hover:bg-slate-50 transition-all flex items-center justify-center gap-2">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
              <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
              <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
              <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
              <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Masuk dengan Google
          </button>

          <div class="text-slate-900 text-sm text-center mt-6">
            Belum punya akun?
            <button @click="goToSignup" class="text-blue-700 hover:underline ml-1 font-medium">
              Register
            </button>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>