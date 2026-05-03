import { createRouter, createWebHistory } from 'vue-router'
import Homepage from '../pages/Homepage.vue'
import Products from '../pages/Products.vue'
import ProductDetail from '../pages/ProductDetail.vue'
import Cart from '../pages/Cart.vue'
import Checkout from '../pages/Checkout.vue'
import OrderHistory from '../pages/OrderHistory.vue'
import OrderSummary from '../pages/OrderSummary.vue'
import OrderTrack from '../pages/OrderTrack.vue'
import AdminDashboard from '../pages/AdminDashboard.vue'
import AdminProducts from '../pages/AdminProducts.vue'
import Login from '../pages/Login.vue'
import Register from '../pages/Register.vue'
import CompleteProfile from '../pages/CompleteProfile.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Homepage
  },
  {
    path: '/products',
    name: 'Products',
    component: Products
  },
  {
    path: '/products/:id',
    name: 'ProductDetail',
    component: ProductDetail
  },
  {
    path: '/cart',
    name: 'Cart',
    component: Cart,
    meta: { requiresAuth: true }
  },
  {
    path: '/checkout',
    name: 'Checkout',
    component: Checkout,
    meta: { requiresAuth: true }
  },
  {
    path: '/order-history',
    name: 'OrderHistory',
    component: OrderHistory,
    meta: { requiresAuth: true }
  },
  {
    path: '/order-summary',
    name: 'OrderSummary',
    component: OrderSummary,
    meta: { requiresAuth: true }
  },
  {
    path: '/order-track',
    name: 'OrderTrack',
    component: OrderTrack,
    meta: { requiresAuth: true }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/complete-profile',
    name: 'CompleteProfile',
    component: CompleteProfile,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin',
    name: 'AdminDashboard',
    component: AdminDashboard,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/products',
    name: 'AdminProducts',
    component: AdminProducts,
    meta: { requiresAuth: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// Navigation guard — cek apakah user sudah login sebelum akses halaman terproteksi
router.beforeEach((to, from, next) => {
  const isLoggedIn = !!localStorage.getItem('auth_token')

  if (to.meta.requiresAuth && !isLoggedIn) {
    // Simpan halaman yang ingin dituju agar bisa redirect setelah login
    next({ name: 'Login', query: { redirect: to.fullPath } })
  } else {
    next()
  }
})

export default router
