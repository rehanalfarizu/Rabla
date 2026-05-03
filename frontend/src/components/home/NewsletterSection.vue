<script setup>
import { ref } from 'vue'

const email = ref('')
const submitted = ref(false)
const loading = ref(false)

const subscribe = () => {
  if (!email.value) return
  loading.value = true
  setTimeout(() => {
    loading.value = false
    submitted.value = true
    email.value = ''
  }, 900)
}
</script>

<template>
  <section class="py-10 px-5 lg:px-8">
    <div class="container mx-auto max-w-7xl">
      <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-purple-700 px-8 py-14 lg:px-16">
        <!-- Decorative blobs -->
        <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full bg-white/5 blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-56 h-56 rounded-full bg-white/5 blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
          <!-- Left text -->
          <div class="text-center lg:text-left">
            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-200 uppercase tracking-widest mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
              Newsletter
            </span>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-white leading-tight">
              Dapatkan Promo<br />Terbaik Untukmu
            </h2>
            <p class="text-white/70 mt-3 max-w-sm text-sm leading-relaxed">
              Daftar sekarang dan dapatkan diskon 15% untuk pembelian pertama + notifikasi promo eksklusif setiap minggu.
            </p>
          </div>

          <!-- Right: form -->
          <div class="w-full max-w-md">
            <div v-if="!submitted">
              <p class="text-white/60 text-xs mb-3 text-center lg:text-right">Bergabung dengan 50.000+ subscriber</p>
              <form @submit.prevent="subscribe" class="flex gap-2">
                <input
                  v-model="email"
                  type="email"
                  placeholder="Masukkan email kamu..."
                  required
                  class="flex-1 px-5 py-3.5 rounded-xl bg-white/15 backdrop-blur border border-white/30 text-white placeholder-white/50 text-sm outline-none focus:bg-white/20 focus:border-white/60 transition-all"
                />
                <button
                  type="submit"
                  :disabled="loading"
                  class="px-6 py-3.5 bg-white text-indigo-700 font-bold text-sm rounded-xl hover:bg-indigo-50 active:scale-95 transition-all duration-200 whitespace-nowrap disabled:opacity-70 shadow"
                >
                  <span v-if="loading">
                    <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                  </span>
                  <span v-else>Subscribe</span>
                </button>
              </form>
              <p class="text-white/40 text-xs mt-2.5 text-center lg:text-left">
                🔒 Kami tidak akan mengirim spam. Unsubscribe kapan saja.
              </p>
            </div>

            <!-- Success state -->
            <div v-else class="flex flex-col items-center gap-3 text-center p-6 bg-white/10 backdrop-blur rounded-2xl border border-white/20">
              <div class="w-14 h-14 bg-emerald-400/20 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-emerald-300">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
              </div>
              <p class="text-white font-bold text-base">Berhasil Subscribe!</p>
              <p class="text-white/60 text-sm">Cek email kamu untuk kode diskon 15%.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
