<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import ApexCharts from 'apexcharts'

const chartRef = ref(null)
let chart = null

const categories = ['Sen, 27 Apr', 'Sel, 28 Apr', 'Rab, 29 Apr', 'Kam, 30 Apr', 'Jum, 1 Mei', 'Sab, 2 Mei', 'Min, 3 Mei']
const data = [1200000, 2000000, 900000, 3000000, 2500000, 1800000, 2200000]

const formatRupiah = (val) => {
  if (val >= 1000000) return 'Rp ' + (val / 1000000).toFixed(1) + 'M'
  if (val >= 1000) return 'Rp ' + (val / 1000).toFixed(0) + 'K'
  return 'Rp ' + val
}

onMounted(() => {
  const options = {
    chart: {
      type: 'area',
      height: 300,
      fontFamily: 'inherit',
      toolbar: { show: false },
      zoom: { enabled: false },
      sparkline: { enabled: false }
    },
    series: [{ name: 'Revenue', data }],
    colors: ['#6366f1'],
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 2.5 },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.4,
        opacityTo: 0.0,
        stops: [0, 100],
        colorStops: [
          { offset: 0, color: '#6366f1', opacity: 0.4 },
          { offset: 100, color: '#6366f1', opacity: 0.0 }
        ]
      }
    },
    xaxis: {
      categories,
      axisBorder: { show: false },
      axisTicks: { show: false },
      labels: { style: { colors: '#94a3b8', fontSize: '12px', fontFamily: 'inherit' } }
    },
    yaxis: {
      labels: {
        style: { colors: '#94a3b8', fontSize: '12px', fontFamily: 'inherit' },
        formatter: formatRupiah
      }
    },
    grid: {
      borderColor: '#f1f5f9',
      strokeDashArray: 4,
      xaxis: { lines: { show: false } },
      yaxis: { lines: { show: true } },
      padding: { top: 0, right: 16, bottom: 0, left: 10 }
    },
    tooltip: {
      theme: 'light',
      y: { formatter: (val) => 'Rp ' + val.toLocaleString('id-ID') }
    },
    markers: {
      size: 4,
      colors: ['#6366f1'],
      strokeColors: '#fff',
      strokeWidth: 2,
      hover: { size: 6 }
    }
  }

  chart = new ApexCharts(chartRef.value, options)
  chart.render()
})

onUnmounted(() => chart?.destroy())
</script>

<template>
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
    <div class="flex items-center justify-between mb-1">
      <div>
        <h3 class="text-base font-semibold text-slate-900">Sales Overview</h3>
        <p class="text-xs text-slate-400 mt-0.5">Revenue 7 hari terakhir</p>
      </div>
      <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-600 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-full">
        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" /></svg>
        +14.2%
      </span>
    </div>
    <div ref="chartRef" class="w-full mt-4"></div>
  </div>
</template>
