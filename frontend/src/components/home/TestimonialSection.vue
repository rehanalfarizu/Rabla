<script setup>
const testimonials = [
  {
    name: 'Siti Rahayu',
    role: 'Fashion Enthusiast',
    avatar: 'https://randomuser.me/api/portraits/women/44.jpg',
    rating: 5,
    comment: 'Produknya benar-benar berkualitas! Kemeja yang saya beli jahitannya rapi banget dan bahannya adem. Packaging juga sangat aman dan pengirimannya super cepat. Pasti beli lagi!',
    verified: true
  },
  {
    name: 'Budi Hartono',
    role: 'Pelanggan Setia',
    avatar: 'https://randomuser.me/api/portraits/men/36.jpg',
    rating: 5,
    comment: 'Sudah lebih dari 10 kali belanja di sini dan tidak pernah kecewa. Harganya kompetitif, kualitasnya premium, dan customer service-nya responsif banget. Highly recommended!',
    verified: true
  },
  {
    name: 'Maya Putri',
    role: 'Beauty Blogger',
    avatar: 'https://randomuser.me/api/portraits/women/68.jpg',
    rating: 5,
    comment: 'Saya suka variety produknya yang lengkap dan fotonya sesuai dengan aslinya. Pernah ada masalah tapi langsung diselesaikan dengan cepat. Toko terpercaya!',
    verified: true
  }
]
</script>

<template>
  <section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-5 lg:px-8 max-w-7xl">
      <!-- Header -->
      <div class="text-center mb-12">
        <p class="text-xs font-semibold text-indigo-600 uppercase tracking-widest mb-2">Testimoni</p>
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Kata Pelanggan Kami</h2>
        <div class="flex items-center justify-center gap-3 mt-4">
          <div class="flex">
            <svg v-for="i in 5" :key="i" class="w-5 h-5 fill-amber-400" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          </div>
          <span class="text-sm font-semibold text-slate-700">4.9 / 5</span>
          <span class="text-sm text-slate-400">dari 12.400+ ulasan</span>
        </div>
      </div>

      <!-- Testimonial grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div
          v-for="t in testimonials"
          :key="t.name"
          class="group bg-slate-50 hover:bg-white border border-gray-100 hover:border-indigo-100 hover:shadow-md rounded-2xl p-6 transition-all duration-300 flex flex-col"
        >
          <!-- Stars -->
          <div class="flex gap-0.5 mb-4">
            <svg v-for="i in 5" :key="i" class="w-4 h-4" :class="i <= t.rating ? 'fill-amber-400' : 'fill-gray-200'" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          </div>

          <!-- Quote mark -->
          <svg class="w-8 h-8 text-indigo-100 fill-current mb-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179z"/>
          </svg>

          <!-- Comment -->
          <p class="text-sm text-slate-600 leading-relaxed flex-1">{{ t.comment }}</p>

          <!-- Profile -->
          <div class="flex items-center gap-3 mt-5 pt-4 border-t border-gray-100">
            <img :src="t.avatar" :alt="t.name" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow" />
            <div class="flex-1 min-w-0">
              <p class="text-sm font-bold text-slate-900 flex items-center gap-1.5">
                {{ t.name }}
                <svg v-if="t.verified" class="w-3.5 h-3.5 text-indigo-500 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" /></svg>
              </p>
              <p class="text-xs text-slate-400">{{ t.role }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
