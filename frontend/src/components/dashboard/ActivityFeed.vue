<script setup>
const activities = [
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" /></svg>`,
    color: 'bg-indigo-100 text-indigo-600',
    title: 'Order baru masuk',
    desc: 'Budi Santoso — #ORD-7821 · Rp 450.000',
    time: '5 menit lalu'
  },
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>`,
    color: 'bg-emerald-100 text-emerald-600',
    title: 'User baru mendaftar',
    desc: 'maya.putri@email.com telah bergabung',
    time: '18 menit lalu'
  },
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" /></svg>`,
    color: 'bg-rose-100 text-rose-500',
    title: 'Permintaan refund',
    desc: 'Ahmad Fauzi · #ORD-7804 — Rp 320.000',
    time: '42 menit lalu'
  },
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" /></svg>`,
    color: 'bg-indigo-100 text-indigo-600',
    title: 'Order baru masuk',
    desc: 'Eko Wijaya — #ORD-7815 · Rp 180.000',
    time: '1 jam lalu'
  },
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>`,
    color: 'bg-emerald-100 text-emerald-600',
    title: 'User baru mendaftar',
    desc: 'rizky.pratama@email.com telah bergabung',
    time: '2 jam lalu'
  },
  {
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" /></svg>`,
    color: 'bg-rose-100 text-rose-500',
    title: 'Permintaan refund',
    desc: 'Dewi Lestari · #ORD-7799 — Rp 875.000',
    time: '3 jam lalu'
  },
]
</script>

<template>
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full">
    <div class="flex items-center justify-between mb-5">
      <div>
        <h3 class="text-base font-semibold text-slate-900">Aktivitas Terkini</h3>
        <p class="text-xs text-slate-400 mt-0.5">Notifikasi real-time</p>
      </div>
      <span class="relative flex h-2.5 w-2.5">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
      </span>
    </div>

    <ul class="space-y-3">
      <li
        v-for="(item, i) in activities"
        :key="i"
        class="flex items-start gap-3 group"
      >
        <!-- Icon -->
        <div :class="`flex-shrink-0 w-8 h-8 rounded-xl flex items-center justify-center ${item.color}`" v-html="item.icon"></div>

        <!-- Content -->
        <div class="flex-1 min-w-0">
          <p class="text-sm font-medium text-slate-800 leading-snug">{{ item.title }}</p>
          <p class="text-xs text-slate-400 truncate mt-0.5">{{ item.desc }}</p>
        </div>

        <!-- Time -->
        <span class="flex-shrink-0 text-xs text-slate-300 whitespace-nowrap">{{ item.time }}</span>
      </li>
    </ul>
  </div>
</template>
