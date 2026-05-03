<script setup>
import { ref, onUnmounted } from 'vue'

// Countdown to midnight
const getTimeLeft = () => {
  const now = new Date()
  const end = new Date()
  end.setHours(23, 59, 59, 999)
  const diff = end - now
  return {
    h: String(Math.floor(diff / 3600000)).padStart(2, '0'),
    m: String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0'),
    s: String(Math.floor((diff % 60000) / 1000)).padStart(2, '0')
  }
}

const timer = ref(getTimeLeft())
const interval = setInterval(() => { timer.value = getTimeLeft() }, 1000)
onUnmounted(() => clearInterval(interval))
</script>

<template>
  <section class="py-10 px-5 lg:px-8">
    <div class="container mx-auto max-w-7xl">
      <div class="relative rounded-3xl overflow-hidden">
        <!-- Background -->
        <img
          src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=1600&q=80"
          alt="Flash Sale"
          class="absolute inset-0 w-full h-full object-cover object-center"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-rose-600/90 via-orange-500/80 to-amber-400/60"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8 px-8 py-12 lg:px-16 lg:py-14">
          <!-- Left: text -->
          <div class="text-center lg:text-left">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur border border-white/30 text-white text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-4">
              <span class="animate-ping w-1.5 h-1.5 rounded-full bg-white inline-block"></span>
              Flash Sale Aktif
            </div>
            <h2 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight drop-shadow-md">
              Diskon Gila-gilaan<br />
              <span class="text-yellow-300">Hingga 70% OFF</span>
            </h2>
            <p class="text-white/80 mt-3 max-w-sm text-base leading-relaxed">
              Penawaran terbatas hanya untuk hari ini! Jangan sampai kehabisan — stok sangat terbatas.
            </p>
            <router-link to="/products" class="inline-flex items-center gap-2 mt-6 bg-white text-rose-600 font-bold text-sm px-7 py-3.5 rounded-full hover:bg-yellow-50 hover:scale-105 transition-all duration-300 shadow-lg">
              Belanja Flash Sale
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
              </svg>
            </router-link>
          </div>

          <!-- Right: countdown -->
          <div class="text-center">
            <p class="text-white/70 text-sm font-medium uppercase tracking-widest mb-4">Berakhir Dalam</p>
            <div class="flex items-center gap-3">
              <div v-for="(val, label) in { Jam: timer.h, Mnt: timer.m, Det: timer.s }" :key="label" class="flex flex-col items-center">
                <div class="w-20 h-20 lg:w-24 lg:h-24 rounded-2xl bg-white/20 backdrop-blur border border-white/30 flex items-center justify-center">
                  <span class="text-4xl lg:text-5xl font-extrabold text-white tabular-nums">{{ val }}</span>
                </div>
                <span class="text-white/60 text-xs uppercase tracking-wider mt-2">{{ label }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
