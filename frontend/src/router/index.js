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
import AdminCustomers from '../pages/AdminCustomers.vue'
import AdminOrders from '../pages/AdminOrders.vue'
import AdminPromotions from '../pages/AdminPromotions.vue'
import Login from '../pages/Login.vue'
import Register from '../pages/Register.vue'
import CompleteProfile from '../pages/CompleteProfile.vue'
import UserProfile from '../pages/UserProfile.vue'
import NotFound from '../pages/NotFound.vue'
import OTPVerification from '../pages/OTPVerification.vue'
import RegisterVerify from '../pages/RegisterVerify.vue'

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
    path: '/register-verify',
    name: 'RegisterVerify',
    component: RegisterVerify
  },
  {
    path: '/complete-profile',
    name: 'CompleteProfile',
    component: CompleteProfile,
    meta: { requiresAuth: true }
  },
  {
    path: '/otp-verification',
    name: 'OTPVerification',
    component: OTPVerification
  },
  {
    path: '/profile',
    name: 'UserProfile',
    component: UserProfile,
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
  },
  {
    path: '/admin/customers',
    name: 'AdminCustomers',
    component: AdminCustomers,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/orders',
    name: 'AdminOrders',
    component: AdminOrders,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/promotions',
    name: 'AdminPromotions',
    component: AdminPromotions,
    meta: { requiresAuth: true }
  },
  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    component: NotFound
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// Navigation guard — cek apakah user sudah login sebelum akses halaman terproteksi
router.beforeEach((to, from, next) => {
  const isLoggedIn = !!localStorage.getItem('auth_token')
  const userData = JSON.parse(localStorage.getItem('user') || '{}')
  const isAdmin = userData?.is_admin === true

  if (isLoggedIn && (to.name === 'Login' || to.name === 'Register')) {
    next({ name: 'Home' })
  } else if (to.meta.requiresAuth && !isLoggedIn) {
    next({ name: 'Login', query: { redirect: to.fullPath } })
  } else if (to.path.startsWith('/admin') && !isAdmin) {
    // Admin routes require admin privileges
    next({ name: 'Home' })
  } else {
    next()
  }
})

export default router
