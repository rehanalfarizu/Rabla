<script setup>
const categories = [
  {
    name: 'Pakaian Wanita',
    img: 'https://images.unsplash.com/photo-1581044777550-4cfa60707c03?auto=format&fit=crop&w=600&q=80',
    count: '2.4K produk',
    gradient: 'from-pink-500/80 to-rose-600/80',
    link: '/products?cat=women'
  },
  {
    name: 'Pakaian Pria',
    img: 'https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&w=600&q=80',
    count: '1.8K produk',
    gradient: 'from-indigo-500/80 to-blue-600/80',
    link: '/products?cat=men'
  },
  {
    name: 'Sepatu & Sandal',
    img: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80',
    count: '980 produk',
    gradient: 'from-amber-500/80 to-orange-600/80',
    link: '/products?cat=shoes'
  },
  {
    name: 'Tas & Aksesoris',
    img: 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&w=600&q=80',
    count: '1.2K produk',
    gradient: 'from-emerald-500/80 to-teal-600/80',
    link: '/products?cat=bags'
  },
  {
    name: 'Kecantikan',
    img: 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=600&q=80',
    count: '740 produk',
    gradient: 'from-fuchsia-500/80 to-purple-600/80',
    link: '/products?cat=beauty'
  },
  {
    name: 'Olahraga',
    img: 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=600&q=80',
    count: '620 produk',
    gradient: 'from-cyan-500/80 to-sky-600/80',
    link: '/products?cat=sport'
  }
]
</script>

<template>
  <section class="py-16 lg:py-20 bg-gray-50">
    <div class="container mx-auto px-5 lg:px-8 max-w-7xl">
      <!-- Header -->
      <div class="flex items-end justify-between mb-10">
        <div>
          <p class="text-xs font-semibold text-indigo-600 uppercase tracking-widest mb-2">Browse</p>
          <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Kategori Produk</h2>
        </div>
        <router-link to="/products" class="hidden sm:flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
          Semua Kategori
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
        </router-link>
      </div>

      <!-- Grid -->
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        <router-link
          v-for="cat in categories"
          :key="cat.name"
          :to="cat.link"
          class="group relative rounded-2xl overflow-hidden aspect-[3/4] block shadow-sm hover:shadow-xl transition-all duration-400"
        >
          <!-- Image -->
          <img
            :src="cat.img"
            :alt="cat.name"
            class="absolute inset-0 w-full h-full object-cover object-center transform group-hover:scale-110 transition-transform duration-500"
          />
          <!-- Gradient -->
          <div :class="`absolute inset-0 bg-gradient-to-t ${cat.gradient} opacity-60 group-hover:opacity-75 transition-opacity duration-300`"></div>
          <!-- Content -->
          <div class="absolute bottom-0 left-0 right-0 p-3.5">
            <p class="text-white font-bold text-sm leading-tight">{{ cat.name }}</p>
            <p class="text-white/70 text-xs mt-0.5">{{ cat.count }}</p>
          </div>
          <!-- Hover ring -->
          <div class="absolute inset-0 ring-0 group-hover:ring-2 ring-white/40 rounded-2xl transition-all duration-300 pointer-events-none"></div>
        </router-link>
      </div>
    </div>
  </section>
</template>
