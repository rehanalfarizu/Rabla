import { ref, computed, watch } from 'vue'

const cartItems = ref(JSON.parse(localStorage.getItem('cart') || '[]'))

// Watch for changes and save to localStorage
watch(cartItems, (newCart) => {
  localStorage.setItem('cart', JSON.stringify(newCart))
}, { deep: true })

export function useCart() {
  const itemCount = computed(() => {
    return cartItems.value.reduce((sum, item) => sum + item.quantity, 0)
  })

  const subtotal = computed(() => {
    return cartItems.value.reduce((sum, item) => sum + (item.price * item.quantity), 0)
  })

  function addToCart(product, quantity = 1) {
    const existing = cartItems.value.find(item => item.id === product.id)

    if (existing) {
      existing.quantity += quantity
    } else {
      cartItems.value.push({
        id: product._id || product.id,
        name: product.name,
        price: parseFloat(product.price),
        image: product.main_image || product.images?.[0] || '/placeholder.png',
        quantity,
      })
    }
  }

  function removeFromCart(productId) {
    cartItems.value = cartItems.value.filter(item => item.id !== productId)
  }

  function updateQuantity(productId, quantity) {
    const item = cartItems.value.find(item => item.id === productId)
    if (item) {
      if (quantity <= 0) {
        removeFromCart(productId)
      } else {
        item.quantity = quantity
      }
    }
  }

  function clearCart() {
    cartItems.value = []
  }

  return {
    cartItems,
    itemCount,
    subtotal,
    addToCart,
    removeFromCart,
    updateQuantity,
    clearCart,
  }
}
