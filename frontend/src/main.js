import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'

document.documentElement.classList.add('scrollbar-none')
document.body?.classList.add('scrollbar-none')

createApp(App).use(router).mount('#app')
