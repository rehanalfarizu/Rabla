import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue'

// Firebase config for production
const firebaseConfig = {
  apiKey: 'AIzaSyCCWsUlgUQxjzXKD1qfVT0npnkMC_yN0is',
  authDomain: 'rabla-5c715.firebaseapp.com',
  projectId: 'rabla-5c715',
  storageBucket: 'rabla-5c715.firebasestorage.app',
  messagingSenderId: '818629355654',
  appId: '1:818629355654:web:e336935b5df8d910c08907',
}

const apiUrl = 'https://rabla-8ed2dbdd54f4.herokuapp.com'

// https://vite.dev/config/
export default defineConfig(({ command, mode }) => {
  return {
    plugins: [vue(), tailwindcss()],
    define: {
      'import.meta.env.VITE_API_URL': JSON.stringify(apiUrl),
      'import.meta.env.VITE_FIREBASE_API_KEY': JSON.stringify(firebaseConfig.apiKey),
      'import.meta.env.VITE_FIREBASE_AUTH_DOMAIN': JSON.stringify(firebaseConfig.authDomain),
      'import.meta.env.VITE_FIREBASE_PROJECT_ID': JSON.stringify(firebaseConfig.projectId),
      'import.meta.env.VITE_FIREBASE_STORAGE_BUCKET': JSON.stringify(firebaseConfig.storageBucket),
      'import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID': JSON.stringify(firebaseConfig.messagingSenderId),
      'import.meta.env.VITE_FIREBASE_APP_ID': JSON.stringify(firebaseConfig.appId),
    },
    build: {
      outDir: 'dist',
      assetsDir: 'assets',
      rollupOptions: {
        output: {
          manualChunks: undefined,
        },
      },
    },
  }
})
