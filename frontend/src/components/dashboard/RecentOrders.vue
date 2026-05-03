<script setup>
const orders = [
  { id: '#ORD-7821', customer: 'Budi Santoso', date: '3 Mei 2026', total: 'Rp 450.000', status: 'Shipped' },
  { id: '#ORD-7820', customer: 'Siti Rahayu', date: '3 Mei 2026', total: 'Rp 1.200.000', status: 'Completed' },
  { id: '#ORD-7819', customer: 'Ahmad Fauzi', date: '2 Mei 2026', total: 'Rp 320.000', status: 'Pending' },
  { id: '#ORD-7818', customer: 'Dewi Lestari', date: '2 Mei 2026', total: 'Rp 875.000', status: 'Paid' },
  { id: '#ORD-7817', customer: 'Rizky Pratama', date: '1 Mei 2026', total: 'Rp 2.100.000', status: 'Completed' },
  { id: '#ORD-7816', customer: 'Maya Putri', date: '1 Mei 2026', total: 'Rp 560.000', status: 'Pending' },
  { id: '#ORD-7815', customer: 'Eko Wijaya', date: '30 Apr 2026', total: 'Rp 180.000', status: 'Shipped' },
]

const statusConfig = {
  Pending:   { classes: 'bg-amber-50 text-amber-700 border-amber-200',   dot: 'bg-amber-500'   },
  Paid:      { classes: 'bg-sky-50 text-sky-700 border-sky-200',         dot: 'bg-sky-500'     },
  Shipped:   { classes: 'bg-indigo-50 text-indigo-700 border-indigo-200',dot: 'bg-indigo-500'  },
  Completed: { classes: 'bg-emerald-50 text-emerald-700 border-emerald-200', dot: 'bg-emerald-500' },
  Cancelled: { classes: 'bg-rose-50 text-rose-700 border-rose-200',     dot: 'bg-rose-500'    },
}
</script>

<template>
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
    <div class="flex items-center justify-between mb-5">
      <div>
        <h3 class="text-base font-semibold text-slate-900">Recent Orders</h3>
        <p class="text-xs text-slate-400 mt-0.5">7 transaksi terbaru</p>
      </div>
      <router-link to="/admin/orders" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
        Lihat semua →
      </router-link>
    </div>

    <div class="overflow-x-auto -mx-2">
      <table class="min-w-full">
        <thead>
          <tr class="text-left">
            <th class="px-3 pb-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Order ID</th>
            <th class="px-3 pb-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Customer</th>
            <th class="px-3 pb-3 text-xs font-semibold text-slate-400 uppercase tracking-wide hidden sm:table-cell">Tanggal</th>
            <th class="px-3 pb-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Total</th>
            <th class="px-3 pb-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Status</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          <tr v-for="order in orders" :key="order.id" class="hover:bg-slate-50 transition-colors group">
            <td class="px-3 py-3 text-xs font-mono font-medium text-slate-500">{{ order.id }}</td>
            <td class="px-3 py-3 text-sm font-medium text-slate-800">{{ order.customer }}</td>
            <td class="px-3 py-3 text-xs text-slate-400 hidden sm:table-cell">{{ order.date }}</td>
            <td class="px-3 py-3 text-sm font-semibold text-slate-800">{{ order.total }}</td>
            <td class="px-3 py-3">
              <span
                :class="`inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full border ${statusConfig[order.status].classes}`"
              >
                <span :class="`w-1.5 h-1.5 rounded-full ${statusConfig[order.status].dot}`"></span>
                {{ order.status }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
