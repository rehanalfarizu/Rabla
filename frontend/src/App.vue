<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import Navbar from './layouts/Navbar.vue'
import Footer from './layouts/Footer.vue'

const route = useRoute()
const showNavbar = computed(() => !route.path.startsWith('/admin'))
</script>

<template>
  <Navbar v-if="showNavbar" />
  <router-view />
  <Footer v-if="route.name === 'Home'" />
</template>
