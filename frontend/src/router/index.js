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
    component: Cart
  },
  {
    path: '/checkout',
    name: 'Checkout',
    component: Checkout
  },
  {
    path: '/order-history',
    name: 'OrderHistory',
    component: OrderHistory
  },
  {
    path: '/order-summary',
    name: 'OrderSummary',
    component: OrderSummary
  },
  {
    path: '/order-track',
    name: 'OrderTrack',
    component: OrderTrack
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
    path: '/admin',
    name: 'AdminDashboard',
    component: AdminDashboard
  },
  {
    path: '/admin/products',
    name: 'AdminProducts',
    component: AdminProducts
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
