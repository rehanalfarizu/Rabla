<script setup>
import { ref } from 'vue'
import ProductDetail from '../../pages/ProductDetail.vue'

const props = defineProps({
  title: { type: String, default: 'Produk Unggulan' },
  subtitle: { type: String, default: 'Pilihan terbaik yang paling diminati customer kami' },
  badge: { type: String, default: 'Terlaris' },
  products: { type: Array, required: true }
})

// ── Wishlist ────────────────────────────────────────────────
const wishlist = ref(new Set())
const toggleWish = (id, e) => {
  e.stopPropagation()
  if (wishlist.value.has(id)) wishlist.value.delete(id)
  else wishlist.value.add(id)
}

// ── Modal ────────────────────────────────────────────────────
const selectedProductId = ref(null)

const openModal = (product) => {
  selectedProductId.value = product.id
  document.body.style.overflow = 'hidden'
}

const closeModal = () => {
  selectedProductId.value = null
  document.body.style.overflow = ''
}

// ── Helpers ──────────────────────────────────────────────────
const formatPrice = (n) => 'Rp ' + n.toLocaleString('id-ID')
</script>

<template>
  <section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-5 lg:px-8 max-w-7xl">
      <!-- Header -->
      <div class="flex items-end justify-between mb-10">
        <div>
          <p class="text-xs font-semibold text-indigo-600 uppercase tracking-widest mb-2">{{ badge }}</p>
          <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">{{ title }}</h2>
          <p class="text-slate-500 text-sm mt-2 max-w-md">{{ subtitle }}</p>
        </div>
        <router-link to="/products" class="hidden sm:flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
          Lihat Semua
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
        </router-link>
      </div>

      <!-- Product Grid -->
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 lg:gap-6">
        <div
          v-for="product in products"
          :key="product.id"
          @click="openModal(product)"
          class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col cursor-pointer"
        >
          <!-- Badge -->
          <div v-if="product.badge" class="absolute top-3 left-3 z-10">
            <span :class="`text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full ${product.badgeClass}`">
              {{ product.badge }}
            </span>
          </div>

          <!-- Wishlist button -->
          <button
            @click.stop="toggleWish(product.id, $event)"
            class="absolute top-3 right-3 z-10 w-8 h-8 rounded-full bg-white shadow flex items-center justify-center transition-transform hover:scale-110"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 transition-colors"
              :class="wishlist.has(product.id) ? 'fill-rose-500 stroke-rose-500' : 'fill-none stroke-slate-400'"
              stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
          </button>

          <!-- Image -->
          <div class="overflow-hidden aspect-square bg-gray-50">
            <img
              :src="product.img"
              :alt="product.name"
              class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
            />
          </div>

          <!-- Info -->
          <div class="p-4 flex flex-col flex-1">
            <p class="text-xs text-slate-400 uppercase tracking-wide mb-1">{{ product.category }}</p>
            <p class="text-sm font-semibold text-slate-800 group-hover:text-indigo-600 transition-colors leading-snug line-clamp-2">
              {{ product.name }}
            </p>

            <!-- Stars -->
            <div class="flex items-center gap-1 mt-2">
              <div class="flex">
                <svg v-for="s in 5" :key="s" class="w-3.5 h-3.5" :class="s <= Math.round(product.rating) ? 'fill-amber-400' : 'fill-gray-200'" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              </div>
              <span class="text-xs text-slate-400">({{ product.reviews }})</span>
            </div>

            <!-- Price -->
            <div class="flex items-center gap-2 mt-3">
              <span class="text-base font-bold text-slate-900">{{ formatPrice(product.price) }}</span>
              <span v-if="product.originalPrice" class="text-xs text-slate-400 line-through">{{ formatPrice(product.originalPrice) }}</span>
              <span v-if="product.discount" class="ml-auto text-xs font-semibold text-rose-500">-{{ product.discount }}%</span>
            </div>

            <!-- Quick view button -->
            <button
              @click.stop="openModal(product)"
              class="mt-3 w-full py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold hover:bg-indigo-600 active:scale-95 transition-all duration-200 flex items-center justify-center gap-2"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
              Quick View
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Modal ──────────────────────────────────────────────── -->
    <Teleport to="body">
      <Transition name="modal">
        <div
          v-if="selectedProductId !== null"
          class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6"
        >
          <!-- Backdrop -->
          <div
            class="absolute inset-0 bg-black/60 backdrop-blur-sm"
            @click="closeModal"
          ></div>

          <!-- Modal Panel: render ProductDetail as modal -->
          <div class="relative z-10 w-full max-w-5xl max-h-[92vh] overflow-y-auto rounded-2xl shadow-2xl">
            <ProductDetail
              :product-id="selectedProductId"
              :is-modal="true"
              @close="closeModal"
            />
          </div>
        </div>
      </Transition>
    </Teleport>
  </section>
</template>

<style scoped>
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.2s ease;
}
.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-active .relative.z-10,
.modal-leave-active .relative.z-10 {
  transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.2s ease;
}
.modal-enter-from .relative.z-10,
.modal-leave-to .relative.z-10 {
  transform: scale(0.94) translateY(16px);
  opacity: 0;
}
</style>
