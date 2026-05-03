<script setup>
const stats = [
  {
    label: 'Total Revenue',
    value: 'Rp 128,4M',
    sub: '+12.4% dari bulan lalu',
    positive: true,
    bg: 'from-violet-500 to-indigo-600',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>`
  },
  {
    label: 'Total Orders',
    value: '12.483',
    sub: '+8.1% dari bulan lalu',
    positive: true,
    bg: 'from-sky-500 to-cyan-600',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" /></svg>`
  },
  {
    label: 'Total Customers',
    value: '8.921',
    sub: '+4.7% dari bulan lalu',
    positive: true,
    bg: 'from-emerald-500 to-teal-600',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>`
  },
  {
    label: 'Pending Orders',
    value: '348',
    sub: '-2.3% dari bulan lalu',
    positive: false,
    bg: 'from-orange-500 to-amber-600',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>`
  }
]
</script>

<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
    <div
      v-for="stat in stats"
      :key="stat.label"
      class="relative overflow-hidden rounded-2xl bg-white border border-gray-100 shadow-sm p-5 flex flex-col gap-3 group hover:shadow-md transition-shadow duration-300"
    >
      <!-- Gradient accent bar top -->
      <div :class="`absolute top-0 left-0 right-0 h-1 bg-gradient-to-r ${stat.bg}`"></div>

      <!-- Icon + label -->
      <div class="flex items-center justify-between">
        <p class="text-sm font-medium text-slate-500">{{ stat.label }}</p>
        <div :class="`bg-gradient-to-br ${stat.bg} text-white rounded-xl p-2 shadow-sm`" v-html="stat.icon"></div>
      </div>

      <!-- Value -->
      <h2 class="text-2xl font-bold text-slate-900 tracking-tight">{{ stat.value }}</h2>

      <!-- Sub label -->
      <p class="text-xs font-medium" :class="stat.positive ? 'text-emerald-600' : 'text-rose-500'">
        <span>{{ stat.positive ? '▲' : '▼' }}</span>
        {{ stat.sub }}
      </p>
    </div>
  </div>
</template>
