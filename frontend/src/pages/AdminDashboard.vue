<script setup>
import { ref } from 'vue'
import AdminSidebar from '../layouts/AdminSidebar.vue'
import StatsCards from '../components/dashboard/StatsCards.vue'
import SalesChart from '../components/dashboard/SalesChart.vue'
import RecentOrders from '../components/dashboard/RecentOrders.vue'
import OrderStatusChart from '../components/dashboard/OrderStatusChart.vue'
import TopProducts from '../components/dashboard/TopProducts.vue'
import ActivityFeed from '../components/dashboard/ActivityFeed.vue'

const sidebarOpen = ref(true)
const toggleSidebar = () => { sidebarOpen.value = !sidebarOpen.value }

// Simulated current date
const today = new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })
</script>

<template>
  <div class="min-h-screen bg-slate-50">
    <AdminSidebar :sidebar-open="sidebarOpen" @toggle="toggleSidebar" />

    <!-- Main content -->
    <main
      class="transition-all duration-300"
      :style="{ paddingLeft: sidebarOpen ? '250px' : '80px' }"
    >
      <div class="p-6 lg:p-8 max-w-[1600px]">

        <!-- ── Header ─────────────────────────────────────────── -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-8">
          <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard</h1>
            <p class="text-sm text-slate-400 mt-0.5">{{ today }}</p>
          </div>

          <!-- Quick actions -->
          <div class="flex items-center gap-2">
            <button class="inline-flex items-center justify-center bg-gray-900 hover:bg-gray-800 text-white rounded-xl px-5 py-2.5 text-sm font-medium transition-colors shadow-sm whitespace-nowrap">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
              </svg>
              Export CSV
            </button>
          </div>
        </div>

        <!-- ── Row 1: Stats Cards ──────────────────────────────── -->
        <StatsCards />

        <!-- ── Row 2: Sales Chart (full width) ───────────────── -->
        <div class="mt-6">
          <SalesChart />
        </div>

        <!-- ── Row 3: Recent Orders + Order Status Chart ─────── -->
        <div class="mt-6 grid grid-cols-1 xl:grid-cols-5 gap-6">
          <div class="xl:col-span-3">
            <RecentOrders />
          </div>
          <div class="xl:col-span-2">
            <OrderStatusChart />
          </div>
        </div>

        <!-- ── Row 4: Top Products + Activity Feed ───────────── -->
        <div class="mt-6 grid grid-cols-1 xl:grid-cols-2 gap-6 pb-8">
          <TopProducts />
          <ActivityFeed />
        </div>

      </div>
    </main>
  </div>
</template>
