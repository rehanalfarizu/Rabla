<script setup>
const features = [
  {
    title: 'Gratis Ongkir',
    desc: 'Gratis ongkos kirim untuk semua pembelian di atas Rp 200.000 ke seluruh Indonesia.',
    gradient: 'from-indigo-500 to-violet-600',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>`
  },
  {
    title: 'Pembayaran Aman',
    desc: '100% transaksi terenkripsi SSL. Berbagai metode pembayaran tersedia untuk kenyamananmu.',
    gradient: 'from-emerald-500 to-teal-600',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>`
  },
  {
    title: 'Garansi Refund',
    desc: 'Tidak puas dengan produk? Kami menjamin pengembalian penuh dalam 30 hari tanpa syarat.',
    gradient: 'from-amber-500 to-orange-600',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" /></svg>`
  },
  {
    title: 'Support 24/7',
    desc: 'Tim customer service kami siap membantu kamu kapan saja melalui chat, email, atau telepon.',
    gradient: 'from-rose-500 to-pink-600',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" /></svg>`
  }
]
</script>

<template>
  <section class="py-16 lg:py-20 bg-slate-50">
    <div class="container mx-auto px-5 lg:px-8 max-w-7xl">
      <!-- Header -->
      <div class="text-center mb-12">
        <p class="text-xs font-semibold text-indigo-600 uppercase tracking-widest mb-2">Keunggulan Kami</p>
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Kenapa Pilih Kami?</h2>
        <p class="text-slate-500 mt-3 max-w-lg mx-auto text-sm leading-relaxed">Ribuan pelanggan mempercayai kami. Kami berkomitmen memberikan pengalaman belanja terbaik.</p>
      </div>

      <!-- Feature cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
          v-for="feat in features"
          :key="feat.title"
          class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 text-center"
        >
          <!-- Icon -->
          <div :class="`w-14 h-14 rounded-2xl bg-gradient-to-br ${feat.gradient} text-white flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300`" v-html="feat.icon"></div>
          <h3 class="text-base font-bold text-slate-900 mb-2">{{ feat.title }}</h3>
          <p class="text-sm text-slate-500 leading-relaxed">{{ feat.desc }}</p>
        </div>
      </div>
    </div>
  </section>
</template>
