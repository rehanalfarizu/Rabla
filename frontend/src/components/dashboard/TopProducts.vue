<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import ApexCharts from 'apexcharts'

const chartRef = ref(null)
let chart = null

const products = ['Kaos Basic', 'Sneakers X Pro', 'Hoodie Streetwear', 'Running Elite', 'Classic Boots']
const sold = [210, 320, 448, 540, 690]

onMounted(() => {
  const options = {
    chart: {
      type: 'bar',
      height: 260,
      fontFamily: 'inherit',
      toolbar: { show: false }
    },
    series: [{ name: 'Terjual', data: sold }],
    colors: ['#6366f1'],
    plotOptions: {
      bar: {
        horizontal: true,
        borderRadius: 6,
        barHeight: '55%',
        distributed: true
      }
    },
    colors: ['#818cf8', '#6366f1', '#4f46e5', '#4338ca', '#3730a3'],
    dataLabels: {
      enabled: true,
      formatter: (val) => val + ' pcs',
      style: { fontSize: '11px', fontFamily: 'inherit', fontWeight: '500', colors: ['#fff'] }
    },
    xaxis: {
      categories: products,
      labels: {
        style: { colors: '#94a3b8', fontSize: '12px', fontFamily: 'inherit' }
      },
      axisBorder: { show: false },
      axisTicks: { show: false }
    },
    yaxis: {
      labels: {
        style: { colors: '#64748b', fontSize: '12px', fontFamily: 'inherit' }
      }
    },
    grid: {
      borderColor: '#f1f5f9',
      strokeDashArray: 4,
      xaxis: { lines: { show: true } },
      yaxis: { lines: { show: false } },
      padding: { left: 0, right: 10 }
    },
    legend: { show: false },
    tooltip: {
      theme: 'light',
      y: { formatter: (val) => val.toLocaleString('id-ID') + ' pcs terjual' }
    }
  }

  chart = new ApexCharts(chartRef.value, options)
  chart.render()
})

onUnmounted(() => chart?.destroy())
</script>

<template>
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h3 class="text-base font-semibold text-slate-900">Top Selling Products</h3>
        <p class="text-xs text-slate-400 mt-0.5">5 produk terlaris</p>
      </div>
      <router-link to="/admin/products" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
        Lihat semua →
      </router-link>
    </div>
    <div ref="chartRef" class="w-full"></div>
  </div>
</template>
