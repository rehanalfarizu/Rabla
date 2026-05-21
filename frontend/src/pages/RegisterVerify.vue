<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import ToastAlert from '../components/ToastAlert.vue'
import api from '../api'
import { firebaseAuth } from '../firebase'

const router = useRouter()
const toastRef = ref(null)
const isLoading = ref(true)
const errorMessage = ref('')

onMounted(async () => {
  const urlParams = new URLSearchParams(window.location.search)
  const email = urlParams.get('email')
  const name = urlParams.get('name') || localStorage.getItem('newUserName')

  // Check if it's a valid Firebase sign-in link
  const isSignInLink = firebaseAuth.isSignInWithEmailLink(firebaseAuth.auth, window.location.href)
  const storedEmail = localStorage.getItem('emailForSignIn')

  if (!isSignInLink || !storedEmail) {
    errorMessage.value = 'Link tidak valid atau sudah expired. Silakan daftar ulang.'
    isLoading.value = false
    setTimeout(() => router.push('/register'), 3000)
    return
  }

  try {
    // Complete Firebase sign-in
    const result = await firebaseAuth.signInWithEmailLink(firebaseAuth.auth, storedEmail, window.location.href)
    const userName = name || result.user.displayName || storedEmail.split('@')[0]

    // Get Firebase ID token
    const idToken = await result.user.getIdToken()

    // Try to create user in backend
    try {
      const response = await api.post('/api/auth/firebase-register', {
        email: result.user.email,
        name: userName,
        firebase_token: idToken,
      }, {
        headers: {
          'Authorization': `Bearer ${idToken}`,
        },
      })

      // Clean up
      localStorage.removeItem('emailForSignIn')
      localStorage.removeItem('newUserName')
      window.history.replaceState({}, document.title, '/')

      // Store token and user data
      localStorage.setItem('auth_token', response.data.token)
      localStorage.setItem('user', JSON.stringify(response.data.user))

      toastRef.value.show('success', 'Registrasi berhasil!')
      setTimeout(() => router.push('/complete-profile'), 1500)
    } catch (backendError) {
      console.warn('Backend registration failed, using Firebase-only mode')
      // Fallback: store Firebase user data directly
      localStorage.removeItem('emailForSignIn')
      localStorage.removeItem('newUserName')
      window.history.replaceState({}, document.title, '/')

      const userData = {
        id: result.user.uid,
        name: userName,
        email: result.user.email,
        is_verified: true,
      }
      localStorage.setItem('auth_token', 'firebase_' + result.user.uid)
      localStorage.setItem('user', JSON.stringify(userData))
      localStorage.setItem('firebase_uid', result.user.uid)

      toastRef.value.show('success', 'Registrasi berhasil!')
      setTimeout(() => router.push('/complete-profile'), 1500)
    }
  } catch (error) {
    console.error('Registration error:', error)
    errorMessage.value = error.response?.data?.message || 'Verifikasi gagal. Silakan coba lagi.'
    toastRef.value.show('error', errorMessage.value)
    setTimeout(() => router.push('/register'), 3000)
  } finally {
    isLoading.value = false
  }
})
</script>

<template>
  <ToastAlert ref="toastRef" />

  <div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="text-center">
      <div v-if="isLoading" class="space-y-4">
        <svg class="animate-spin h-12 w-12 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p class="text-gray-600">Memverifikasi email...</p>
      </div>

      <div v-else-if="errorMessage" class="space-y-4">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto">
          <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </div>
        <p class="text-red-600 font-medium">{{ errorMessage }}</p>
        <p class="text-gray-500 text-sm">Mengalihkan...</p>
      </div>
    </div>
  </div>
</template>