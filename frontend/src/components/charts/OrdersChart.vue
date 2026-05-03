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
      type: 'bar',
      fontFamily: 'inherit',
      height: 320,
      toolbar: { show: false }
    },
    series: props.series,
    colors: [getBrandColor()],
    plotOptions: {
      bar: {
        borderRadius: 4,
        columnWidth: '40%',
      }
    },
    dataLabels: { enabled: false },
    xaxis: {
      categories: props.categories,
      axisBorder: { show: false },
      axisTicks: { show: false },
      labels: { style: { colors: '#6b7280', fontFamily: 'inherit' } }
    },
    yaxis: {
      labels: { style: { colors: '#6b7280', fontFamily: 'inherit' } }
    },
    grid: {
      borderColor: '#f3f4f6',
      strokeDashArray: 4,
      xaxis: { lines: { show: false } },
      yaxis: { lines: { show: true } }
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
    <h3 class="text-gray-900 font-semibold mb-4">Orders</h3>
    <div ref="chartRef" class="w-full"></div>
  </div>
</template>
