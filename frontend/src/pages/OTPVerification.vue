<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'
import ToastAlert from '../components/ToastAlert.vue'

const router = useRouter()
const toastAlert = ref(null)

// Konfigurasi
const OTP_LENGTH = 6
const otpValues = ref(Array(OTP_LENGTH).fill(''))
const inputRefs = ref([])

// State simulasi
const sentTo = ref('user@example.com')
const timer = ref(60)
const isResending = ref(false)
const isVerifying = ref(false)
const errorMessage = ref('')

// Focus management
const setInputRef = (el, index) => {
  if (el) inputRefs.value[index] = el
}

// Timer logic
let timerInterval
const startTimer = () => {
  timer.value = 60
  clearInterval(timerInterval)
  timerInterval = setInterval(() => {
    if (timer.value > 0) {
      timer.value--
    } else {
      clearInterval(timerInterval)
    }
  }, 1000)
}

onMounted(() => {
  startTimer()
  // Focus input pertama
  setTimeout(() => {
    if (inputRefs.value[0]) inputRefs.value[0].focus()
  }, 100)
})

onUnmounted(() => {
  clearInterval(timerInterval)
})

const formatTime = computed(() => {
  const m = Math.floor(timer.value / 60)
  const s = timer.value % 60
  return `${m}:${s.toString().padStart(2, '0')}`
})

// Input handlers
const handleInput = (e, index) => {
  errorMessage.value = ''
  const val = e.target.value
  
  // Pastikan hanya angka
  if (!/^\d*$/.test(val)) {
    otpValues.value[index] = ''
    return
  }

  // Handle single character
  if (val.length === 1) {
    otpValues.value[index] = val
    // Pindah ke input selanjutnya
    if (index < OTP_LENGTH - 1) {
      inputRefs.value[index + 1].focus()
    }
  } else if (val.length > 1) {
    otpValues.value[index] = val[0]
  }
}

const handleKeydown = (e, index) => {
  if (e.key === 'Backspace') {
    errorMessage.value = ''
    if (!otpValues.value[index] && index > 0) {
      // Pindah ke input sebelumnya dan hapus
      inputRefs.value[index - 1].focus()
      otpValues.value[index - 1] = ''
    } else {
      // Hapus input saat ini
      otpValues.value[index] = ''
    }
  } else if (e.key === 'ArrowLeft' && index > 0) {
    inputRefs.value[index - 1].focus()
  } else if (e.key === 'ArrowRight' && index < OTP_LENGTH - 1) {
    inputRefs.value[index + 1].focus()
  }
}

const handlePaste = (e) => {
  e.preventDefault()
  errorMessage.value = ''
  // Ambil hanya angka dari teks yang dipaste
  const pastedData = e.clipboardData.getData('text/plain').replace(/\D/g, '').slice(0, OTP_LENGTH)
  
  if (pastedData) {
    for (let i = 0; i < pastedData.length; i++) {
      otpValues.value[i] = pastedData[i]
    }
    // Focus ke input kosong berikutnya atau input terakhir
    const nextIndex = Math.min(pastedData.length, OTP_LENGTH - 1)
    inputRefs.value[nextIndex].focus()
  }
}

const resendCode = async () => {
  if (timer.value > 0) return
  
  isResending.value = true
  errorMessage.value = ''
  
  try {
    // Simulasi API call
    await new Promise(resolve => setTimeout(resolve, 1000))
    startTimer()
    // Reset input
    otpValues.value = Array(OTP_LENGTH).fill('')
    if (inputRefs.value[0]) inputRefs.value[0].focus()
    toastAlert.value.show('success', 'Kode OTP baru telah dikirim!')
  } catch (error) {
    errorMessage.value = 'Gagal mengirim ulang kode.'
    toastAlert.value.show('error', 'Gagal mengirim ulang kode.')
  } finally {
    isResending.value = false
  }
}

const verifyCode = async () => {
  const code = otpValues.value.join('')
  
  if (code.length < OTP_LENGTH) {
    errorMessage.value = `Masukkan kode OTP ${OTP_LENGTH} digit.`
    return
  }
  
  isVerifying.value = true
  errorMessage.value = ''
  
  try {
    // Simulasi API call verifikasi
    await new Promise(resolve => setTimeout(resolve, 1500))
    
    // Anggap '123456' adalah kode yang benar untuk testing
    if (code === '123456') { 
      // Sukses
      toastAlert.value.show('success', 'Verifikasi berhasil!')
      setTimeout(() => router.push('/complete-profile'), 1500)
    } else {
      errorMessage.value = 'Kode OTP salah atau sudah kadaluarsa.'
      toastAlert.value.show('error', 'Kode OTP salah!')
    }
  } catch (error) {
    errorMessage.value = 'Terjadi kesalahan saat verifikasi.'
    toastAlert.value.show('error', 'Terjadi kesalahan sistem.')
  } finally {
    isVerifying.value = false
  }
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <ToastAlert ref="toastAlert" />
    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-2xl shadow-xl">
      <div class="text-center">
        <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold text-gray-900">
          Verifikasi OTP
        </h2>
        <p class="mt-4 text-sm text-gray-600 leading-relaxed">
          Masukkan kode {{ OTP_LENGTH }} digit yang telah kami kirimkan ke:
          <br>
          <span class="font-bold text-gray-900">{{ sentTo }}</span>
        </p>
      </div>

      <form class="mt-8 space-y-6" @submit.prevent="verifyCode">
        <div>
          <!-- Input OTP -->
          <div class="flex justify-between gap-2 sm:gap-3 mb-6">
            <input
              v-for="(val, index) in otpValues"
              :key="index"
              :ref="el => setInputRef(el, index)"
              v-model="otpValues[index]"
              type="text"
              inputmode="numeric"
              maxlength="1"
              autocomplete="one-time-code"
              class="w-12 h-14 sm:w-14 sm:h-16 text-center text-2xl font-bold bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm"
              :class="{ 'border-red-500 ring-1 ring-red-500': errorMessage }"
              @input="e => handleInput(e, index)"
              @keydown="e => handleKeydown(e, index)"
              @paste="handlePaste"
            />
          </div>
          
          <!-- Pesan Error -->
          <div v-if="errorMessage" class="text-sm text-red-600 text-center font-medium animate-pulse">
            {{ errorMessage }}
          </div>
        </div>

        <div>
          <!-- Tombol Verifikasi -->
          <button
            type="submit"
            :disabled="isVerifying || otpValues.join('').length < OTP_LENGTH"
            class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all disabled:opacity-70 disabled:cursor-not-allowed"
          >
            <span v-if="isVerifying" class="flex items-center gap-2">
              <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Memverifikasi...
            </span>
            <span v-else>Verifikasi</span>
          </button>
        </div>
      </form>

      <!-- Informasi Resend -->
      <div class="mt-6 text-center space-y-4">
        <p class="text-sm text-gray-600">
          Belum menerima kode?
        </p>
        <button
          v-if="timer > 0"
          disabled
          class="text-sm font-medium text-gray-400 cursor-not-allowed"
        >
          Kirim ulang dalam <span class="font-bold">{{ formatTime }}</span>
        </button>
        <button
          v-else
          @click="resendCode"
          :disabled="isResending"
          class="text-sm font-bold text-orange-600 hover:text-orange-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
        >
          {{ isResending ? 'Mengirim...' : 'Kirim ulang kode' }}
        </button>
      </div>
    </div>
  </div>
</template>
