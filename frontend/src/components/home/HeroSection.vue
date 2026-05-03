<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const slides = [
  {
    img: 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1600&q=80',
    tag: 'Koleksi Summer 2026',
    title: 'Tampil Stylish\nSetiap Hari',
    sub: 'Temukan ribuan pilihan fashion premium dengan diskon hingga 50% untuk koleksi terbaru kami.',
    cta: 'Belanja Sekarang',
    ctaLink: '/products',
    ctaSec: 'Lihat Koleksi',
    accent: 'from-violet-600 to-pink-500'
  },
  {
    img: 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&w=1600&q=80',
    tag: 'Flash Sale Hari Ini',
    title: 'Diskon Besar\nSampai 70%',
    sub: 'Jangan lewatkan penawaran terbatas kami. Hemat lebih banyak untuk produk pilihan terbaik.',
    cta: 'Grab the Deal',
    ctaLink: '/products',
    ctaSec: 'Pelajari Lebih',
    accent: 'from-orange-500 to-rose-500'
  },
  {
    img: 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?auto=format&fit=crop&w=1600&q=80',
    tag: 'Peluncuran Produk Baru',
    title: 'Koleksi Eksklusif\nHanya Di Sini',
    sub: 'Brand lokal premium berkualitas internasional, dikirim langsung ke pintu rumahmu.',
    cta: 'Temukan Sekarang',
    ctaLink: '/products',
    ctaSec: 'Tentang Kami',
    accent: 'from-emerald-500 to-cyan-500'
  }
]

const current = ref(0)
let timer = null

const next = () => { current.value = (current.value + 1) % slides.length }
const prev = () => { current.value = (current.value - 1 + slides.length) % slides.length }
const goTo = (i) => { current.value = i }

onMounted(() => { timer = setInterval(next, 5500) })
onUnmounted(() => clearInterval(timer))
</script>

<template>
  <section class="relative w-full h-screen min-h-[600px] max-h-[900px] overflow-hidden">
    <!-- Slides -->
    <div
      v-for="(slide, i) in slides"
      :key="i"
      class="absolute inset-0 transition-opacity duration-1000"
      :class="i === current ? 'opacity-100 z-10' : 'opacity-0 z-0'"
    >
      <!-- Background Image -->
      <img
        :src="slide.img"
        :alt="slide.title"
        class="absolute inset-0 w-full h-full object-cover object-center scale-105"
        :class="i === current ? 'animate-slowzoom' : ''"
        loading="lazy"
      />
      <!-- Gradient Overlay -->
      <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/40 to-transparent"></div>

      <!-- Content -->
      <div class="relative z-10 h-full flex items-center">
        <div class="container mx-auto px-6 lg:px-16">
          <div class="max-w-xl" :class="i === current ? 'animate-slidein' : ''">
            <!-- Tag -->
            <span :class="`inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-white bg-gradient-to-r ${slide.accent} px-3 py-1.5 rounded-full mb-5 shadow`">
              <span class="w-1.5 h-1.5 rounded-full bg-white/80 animate-pulse"></span>
              {{ slide.tag }}
            </span>

            <!-- Title -->
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight tracking-tight whitespace-pre-line mb-5 drop-shadow-lg">
              {{ slide.title }}
            </h1>

            <!-- Sub -->
            <p class="text-base md:text-lg text-white/80 leading-relaxed mb-8 max-w-md">
              {{ slide.sub }}
            </p>

            <!-- CTAs -->
            <div class="flex flex-wrap gap-3">
              <router-link
                :to="slide.ctaLink"
                :class="`inline-flex items-center gap-2 font-bold text-sm text-white bg-gradient-to-r ${slide.accent} px-6 py-3.5 rounded-full shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300`"
              >
                {{ slide.cta }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
              </router-link>
              <router-link
                :to="slide.ctaLink"
                class="inline-flex items-center gap-2 font-semibold text-sm text-white bg-white/15 backdrop-blur border border-white/30 px-6 py-3.5 rounded-full hover:bg-white/25 transition-all duration-300"
              >
                {{ slide.ctaSec }}
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Prev / Next arrows -->
    <button
      @click="prev"
      class="absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/20 backdrop-blur border border-white/30 text-white flex items-center justify-center hover:bg-white/35 transition-all"
      aria-label="Previous"
    >
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
      </svg>
    </button>
    <button
      @click="next"
      class="absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/20 backdrop-blur border border-white/30 text-white flex items-center justify-center hover:bg-white/35 transition-all"
      aria-label="Next"
    >
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
      </svg>
    </button>

    <!-- Dot indicators -->
    <div class="absolute bottom-7 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
      <button
        v-for="(_, i) in slides"
        :key="i"
        @click="goTo(i)"
        :class="[
          'transition-all duration-400 rounded-full',
          i === current ? 'w-8 h-2.5 bg-white' : 'w-2.5 h-2.5 bg-white/40 hover:bg-white/70'
        ]"
        :aria-label="`Slide ${i + 1}`"
      ></button>
    </div>

    <!-- Bottom stats bar -->
    <div class="absolute bottom-0 left-0 right-0 z-20 hidden md:block">
      <div class="bg-white/10 backdrop-blur-md border-t border-white/20">
        <div class="container mx-auto px-8 py-4 flex items-center justify-center gap-12">
          <div class="text-center">
            <p class="text-xl font-bold text-white">50K+</p>
            <p class="text-xs text-white/60 uppercase tracking-wide">Produk</p>
          </div>
          <div class="w-px h-8 bg-white/20"></div>
          <div class="text-center">
            <p class="text-xl font-bold text-white">200K+</p>
            <p class="text-xs text-white/60 uppercase tracking-wide">Customer</p>
          </div>
          <div class="w-px h-8 bg-white/20"></div>
          <div class="text-center">
            <p class="text-xl font-bold text-white">4.9 ⭐</p>
            <p class="text-xs text-white/60 uppercase tracking-wide">Rating</p>
          </div>
          <div class="w-px h-8 bg-white/20"></div>
          <div class="text-center">
            <p class="text-xl font-bold text-white">Free</p>
            <p class="text-xs text-white/60 uppercase tracking-wide">Ongkir</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
@keyframes slowzoom {
  0%   { transform: scale(1.05); }
  100% { transform: scale(1.12); }
}
.animate-slowzoom {
  animation: slowzoom 6s ease-in-out forwards;
}

@keyframes slidein {
  from { opacity: 0; transform: translateX(-32px); }
  to   { opacity: 1; transform: translateX(0); }
}
.animate-slidein {
  animation: slidein 0.7s ease-out both;
}
</style>
