<script setup>
import HeroSection       from '../components/home/HeroSection.vue'
import CategorySection   from '../components/home/CategorySection.vue'
import ProductSection    from '../components/home/ProductSection.vue'
import PromoBanner       from '../components/home/PromoBanner.vue'
import TrustSection      from '../components/home/TrustSection.vue'
import TestimonialSection from '../components/home/TestimonialSection.vue'
import NewsletterSection from '../components/home/NewsletterSection.vue'

// ── Dummy Data ─────────────────────────────────────────────────────────────────

const bestSellers = [
  {
    id: 1,
    name: 'Kemeja Oversize Premium Cotton',
    category: 'Pakaian Pria',
    img: 'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?auto=format&fit=crop&w=600&q=80',
    price: 285000,
    originalPrice: 399000,
    discount: 29,
    rating: 4.8,
    reviews: 234,
    badge: 'Best Seller',
    badgeClass: 'bg-amber-100 text-amber-700'
  },
  {
    id: 2,
    name: 'Sneakers Urban Runner V2',
    category: 'Sepatu',
    img: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80',
    price: 749000,
    originalPrice: 999000,
    discount: 25,
    rating: 4.9,
    reviews: 512,
    badge: 'Hot 🔥',
    badgeClass: 'bg-rose-100 text-rose-700'
  },
  {
    id: 3,
    name: 'Dress Floral Midi Elegan',
    category: 'Pakaian Wanita',
    img: 'https://images.unsplash.com/photo-1623609163859-ca93c959b98a?auto=format&fit=crop&w=600&q=80',
    price: 425000,
    originalPrice: 580000,
    discount: 27,
    rating: 4.7,
    reviews: 189,
    badge: null,
    badgeClass: ''
  },
  {
    id: 4,
    name: 'Tas Selempang Leather Canvas',
    category: 'Tas',
    img: 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&w=600&q=80',
    price: 315000,
    originalPrice: 450000,
    discount: 30,
    rating: 4.6,
    reviews: 97,
    badge: 'Sale',
    badgeClass: 'bg-indigo-100 text-indigo-700'
  },
  {
    id: 5,
    name: 'Hoodie Streetwear Unisex',
    category: 'Pakaian',
    img: 'https://images.unsplash.com/photo-1556821840-3a63f15732ce?auto=format&fit=crop&w=600&q=80',
    price: 375000,
    originalPrice: 525000,
    discount: 29,
    rating: 4.8,
    reviews: 341,
    badge: 'Best Seller',
    badgeClass: 'bg-amber-100 text-amber-700'
  },
  {
    id: 6,
    name: 'Serum Vitamin C Glow Booster',
    category: 'Kecantikan',
    img: 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=600&q=80',
    price: 189000,
    originalPrice: 250000,
    discount: 24,
    rating: 4.9,
    reviews: 678,
    badge: 'Terlaris',
    badgeClass: 'bg-rose-100 text-rose-700'
  },
  {
    id: 7,
    name: 'Celana Chino Slim Fit',
    category: 'Pakaian Pria',
    img: 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?auto=format&fit=crop&w=600&q=80',
    price: 259000,
    originalPrice: 359000,
    discount: 28,
    rating: 4.5,
    reviews: 156,
    badge: null,
    badgeClass: ''
  },
  {
    id: 8,
    name: 'Watch Minimalis Stainless',
    category: 'Aksesoris',
    img: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=600&q=80',
    price: 595000,
    originalPrice: 850000,
    discount: 30,
    rating: 4.7,
    reviews: 203,
    badge: 'New',
    badgeClass: 'bg-emerald-100 text-emerald-700'
  }
]

const newArrivals = [
  {
    id: 9,
    name: 'Blouse Linen Soft Touch',
    category: 'Pakaian Wanita',
    img: 'https://images.unsplash.com/photo-1598554747436-c9293d6a588f?auto=format&fit=crop&w=600&q=80',
    price: 220000,
    originalPrice: null,
    discount: null,
    rating: 4.6,
    reviews: 12,
    badge: 'New Arrival',
    badgeClass: 'bg-emerald-100 text-emerald-700'
  },
  {
    id: 10,
    name: 'Sepatu Loafers Casual',
    category: 'Sepatu',
    img: 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?auto=format&fit=crop&w=600&q=80',
    price: 465000,
    originalPrice: null,
    discount: null,
    rating: 4.8,
    reviews: 8,
    badge: 'New Arrival',
    badgeClass: 'bg-emerald-100 text-emerald-700'
  },
  {
    id: 11,
    name: 'Sunscreen SPF 50 PA++++',
    category: 'Kecantikan',
    img: 'https://images.unsplash.com/photo-1556228852-6d35a585d566?auto=format&fit=crop&w=600&q=80',
    price: 145000,
    originalPrice: null,
    discount: null,
    rating: 4.9,
    reviews: 34,
    badge: 'New Arrival',
    badgeClass: 'bg-emerald-100 text-emerald-700'
  },
  {
    id: 12,
    name: 'Tote Bag Canvas Ekstra Large',
    category: 'Tas',
    img: 'https://images.unsplash.com/photo-1591561954557-26941169b49e?auto=format&fit=crop&w=600&q=80',
    price: 175000,
    originalPrice: null,
    discount: null,
    rating: 4.7,
    reviews: 21,
    badge: 'New Arrival',
    badgeClass: 'bg-emerald-100 text-emerald-700'
  }
]
</script>

<template>
  <div class="bg-white">
    <!-- 1. Hero -->
    <HeroSection />

    <!-- 2. Kategori -->
    <CategorySection />

    <!-- 3. Produk Terlaris -->
    <ProductSection
      title="Produk Terlaris"
      subtitle="Ribuan pelanggan sudah membuktikan kualitasnya. Jangan sampai kehabisan!"
      badge="Best Sellers"
      :products="bestSellers"
    />

    <!-- 4. Promo Banner -->
    <PromoBanner />

    <!-- 5. Produk Terbaru -->
    <ProductSection
      title="Produk Terbaru"
      subtitle="Koleksi baru yang baru saja tiba. Jadilah yang pertama memilikinya!"
      badge="New Arrivals"
      :products="newArrivals"
    />

    <!-- 6. Trust Section -->
    <TrustSection />

    <!-- 7. Testimoni -->
    <TestimonialSection />

    <!-- 8. Newsletter -->
    <NewsletterSection />
  </div>
</template>
