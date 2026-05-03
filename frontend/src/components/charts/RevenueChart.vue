<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue'
import ApexCharts from 'apexcharts'

const props = defineProps({
  series: { type: Array, required: true },
  categories: { type: Array, required: true }
})

const chartRef = ref(null)
let chart = null

const getBrandColor = () => {
  if (typeof window === 'undefined') return '#111827'
  const color = getComputedStyle(document.documentElement).getPropertyValue('--color-fg-brand').trim()
  return color || '#111827'
}

onMounted(() => {
  const options = {
    chart: {
      type: 'area',
      fontFamily: 'inherit',
      height: 320,
      toolbar: { show: false },
      zoom: { enabled: false }
    },
    series: props.series,
    colors: [getBrandColor()],
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 2 },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.45,
        opacityTo: 0.05,
        stops: [20, 100]
      }
    },
    xaxis: {
      categories: props.categories,
      axisBorder: { show: false },
      axisTicks: { show: false },
      labels: { style: { colors: '#6b7280', fontFamily: 'inherit' } },
      crosshairs: { stroke: { color: '#e5e7eb' } }
    },
    yaxis: {
      labels: { style: { colors: '#6b7280', fontFamily: 'inherit' } },
    },
    grid: {
      borderColor: '#f3f4f6',
      strokeDashArray: 4,
      xaxis: { lines: { show: false } },
      yaxis: { lines: { show: true } },
      padding: { top: 0, right: 0, bottom: 0, left: 10 }
    },
    tooltip: { theme: 'light' }
  }

  chart = new ApexCharts(chartRef.value, options)
  chart.render()
})

watch(() => props.series, (newSeries) => chart?.updateSeries(newSeries), { deep: true })
watch(() => props.categories, (newCategories) => chart?.updateOptions({ xaxis: { categories: newCategories } }), { deep: true })

onUnmounted(() => chart?.destroy())
</script>

<template>
  <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h3 class="text-gray-900 font-semibold mb-4">Revenue Overview</h3>
    <div ref="chartRef" class="w-full"></div>
  </div>
</template>
