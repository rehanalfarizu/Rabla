<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import ApexCharts from 'apexcharts'

const chartRef = ref(null)
let chart = null

onMounted(() => {
  const options = {
    chart: {
      type: 'donut',
      height: 300,
      fontFamily: 'inherit'
    },
    series: [348, 1204, 2876, 7612, 443],
    labels: ['Pending', 'Paid', 'Shipped', 'Completed', 'Cancelled'],
    colors: ['#f59e0b', '#38bdf8', '#818cf8', '#10b981', '#f43f5e'],
    stroke: { width: 0 },
    dataLabels: {
      enabled: false
    },
    plotOptions: {
      pie: {
        donut: {
          size: '72%',
          labels: {
            show: true,
            total: {
              show: true,
              label: 'Total Orders',
              fontSize: '12px',
              fontFamily: 'inherit',
              color: '#94a3b8',
              formatter: (w) => {
                return w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString('id-ID')
              }
            },
            value: {
              fontSize: '22px',
              fontWeight: '700',
              fontFamily: 'inherit',
              color: '#0f172a',
              offsetY: 4
            }
          }
        }
      }
    },
    legend: {
      position: 'bottom',
      fontFamily: 'inherit',
      fontSize: '12px',
      labels: { colors: '#64748b' },
      markers: { width: 8, height: 8, radius: 4 },
      itemMargin: { horizontal: 10, vertical: 4 }
    },
    tooltip: {
      theme: 'light',
      y: { formatter: (val) => val.toLocaleString('id-ID') + ' orders' }
    }
  }

  chart = new ApexCharts(chartRef.value, options)
  chart.render()
})

onUnmounted(() => chart?.destroy())
</script>

<template>
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full">
    <div class="mb-4">
      <h3 class="text-base font-semibold text-slate-900">Order Status</h3>
      <p class="text-xs text-slate-400 mt-0.5">Distribusi status order keseluruhan</p>
    </div>
    <div ref="chartRef" class="w-full"></div>
  </div>
</template>
