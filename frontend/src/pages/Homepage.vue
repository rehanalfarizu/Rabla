<script setup>
</script>

<template>
  <div class="bg-white">
    <!-- Hero Section -->
    <section class="hero-section relative w-full min-h-screen flex items-center justify-center overflow-hidden">
      <img 
        src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
        alt="Fashion Sale" 
        class="absolute inset-0 w-full h-full object-cover object-center"
        loading="lazy"
      />
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="container mx-auto px-4 py-24 md:py-32 w-full relative z-10">
        <div class="max-w-lg">
          <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
            Summer Collection 2025
          </h1>
          <p class="text-lg text-gray-100 mb-8">
            Discover our latest arrivals designed for comfort and style. Premium quality that lasts.
          </p>
          <div class="flex flex-wrap gap-4">
           <a href="#" class="py-3 px-6 bg-black text-white font-medium rounded-full transition-all duration-300 whitespace-nowrap
hover:bg-gray-900 hover:text-orange-400 hover:shadow-lg hover:scale-105">
  Shop Now
</a>
            <a href="#" class="py-3 px-6 bg-white/30 backdrop-blur-md border border-white/20 shadow-sm font-medium rounded-full text-white transition-all duration-300 whitespace-nowrap
hover:bg-white/50 hover:border-white/40 hover:shadow-lg hover:scale-105">
  Explore Collection
</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Special Offer Banner -->
    <section>
      <div class="bg-white py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl lg:max-w-none">
            <div class="text-center">
              <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Empowering Businesses Globally</h2>
              <p class="mt-4 text-lg leading-8 text-gray-600">
                Our platform is trusted by organizations worldwide to boost productivity, streamline operations, and enhance
                customer experiences.
              </p>
            </div>
            <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
              <div class="flex flex-col bg-gray-200/50 p-8">
                <dt class="text-sm font-semibold leading-6 text-gray-600">Active Users</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">12,345</dd>
              </div>
              <div class="flex flex-col bg-gray-200/50 p-8">
                <dt class="text-sm font-semibold leading-6 text-gray-600">Transactions Today</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">1.23M</dd>
              </div>
              <div class="flex flex-col bg-gray-200/50 p-8">
                <dt class="text-sm font-semibold leading-6 text-gray-600">Total Revenue</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">Rp5.6B</dd>
              </div>
              <div class="flex flex-col bg-gray-200/50 p-8">
                <dt class="text-sm font-semibold leading-6 text-gray-600">Happy Customers</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">98%</dd>
              </div>
            </dl>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Products -->
    <section class="py-2">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-12">Featured Products</h2>
        
        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
          <!-- Product Card 1 -->
           <a href="/product/1" class="block">
          <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition overflow-hidden group">
            <div class="relative">
              <img src="https://plus.unsplash.com/premium_photo-1680346529160-549ad950bd1f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Product Image" class="w-full h-60 object-cover group-hover:scale-105 transition-transform" />
              <span class="absolute top-3 right-3 bg-black text-white text-xs px-2 py-1 rounded">NEW</span>
            </div>
            <div class="p-5">
              <h3 class="text-lg font-bold text-gray-900 mb-1">Noise Cancelling Headphones</h3>
              <p class="text-sm text-gray-500 mb-2">30hr Battery · Bluetooth 5.3</p>
              <div class="flex justify-between items-center mt-4">
                <span class="text-lg font-semibold text-black ">Rp129.00</span>
                <button class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800">Buy</button>
              </div>
            </div>
          </div>
          </a>

          <!-- Product Card 2 -->
           <a href="/product/1" class="block">
          <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition overflow-hidden group">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1709258228137-19a8c193be39?q=80&w=2011&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Product Image" class="w-full h-60 object-cover group-hover:scale-105 transition-transform" />
              <span class="absolute top-3 right-3 bg-red-600 text-white text-xs px-2 py-1 rounded">SALE</span>
            </div>
            <div class="p-5">
              <h3 class="text-lg font-bold text-gray-900 mb-1">Running Shoes Pro</h3>
              <p class="text-sm text-gray-500 mb-2">Lightweight · Breathable</p>
              <div class="flex justify-between items-center mt-4">
                <span class="text-lg font-semibold text-black">Rp89.99</span>
                <button class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800">Buy</button>
              </div>
            </div>
          </div>
          </a>

          <!-- Product Card 3 -->
          <a href="/product/1" class="block"> 
          <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition overflow-hidden group">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1718309602791-8f3cc83840b7?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Product Image" class="w-full h-60 object-cover group-hover:scale-105 transition-transform" />
            </div>
            <div class="p-5">
              <h3 class="text-lg font-bold text-gray-900 mb-1">Smart Fitness Watch</h3>
              <p class="text-sm text-gray-500 mb-2">Heart Rate · Sleep Tracking</p>
              <div class="flex justify-between items-center mt-4">
                <span class="text-lg font-semibold text-green-600">Rp149.00</span>
                
                <button class="bg-black text-white px-4 py-2 text-center rounded-lg hover:bg-gray-800">Buy</button>
              </div>
            </div>
          </div>
          </a>
        </div>
      </div>
    </section>

    <section class="py-16 px-4 md:px-8 mt-6">
      <div class="max-w-7xl mx-auto">
          <div class="max-w-3xl mb-12 md:mb-16">
            <h2 class="text-3xl font-bold text-slate-900 mb-6 md:text-4xl">Work Easier Today</h2>
            <p class="text-base text-slate-600 leading-relaxed">Unlock a world of possibilities with
                our exclusive
                features. Explore how our unique offerings can transform your journey and empower you to achieve more.</p>
          </div>

          <div class="grid gap-6 max-w-lg lg:grid-cols-3 md:grid-cols-2 md:gap-8 md:max-w-full">

            <div
                class="bg-white border border-slate-300 shadow-xs rounded-lg p-6">
                <div class="flex items-center w-10 h-10 rounded-lg p-2.5 bg-gray-100 mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-full fill-slate-900"
                      viewBox="0 0 100 100" aria-hidden="true">
                      <path
                        d="M65.156 4.42c-8.327 0-15.13 6.855-15.13 15.202s6.803 15.165 15.13 15.165c7.017 0 12.924-4.863 14.626-11.382h13.843a3.8 3.8 0 0 0 3.791-3.805 3.8 3.8 0 0 0-3.79-3.8h-13.86C78.053 9.294 72.16 4.42 65.156 4.42M6.391 15.8a3.8 3.8 0 0 0-3.79 3.805 3.8 3.8 0 0 0 3.79 3.8h36.397c-.21-1.234-.348-2.493-.348-3.783 0-1.304.134-2.575.348-3.821zm28.47 18.987c-7.018 0-12.92 4.89-14.619 11.418H6.392a4 4 0 0 0-.363 0 3.8 3.8 0 0 0-3.52 4.062 3.8 3.8 0 0 0 3.882 3.535H20.25c1.71 6.511 7.604 11.382 14.61 11.382 8.328 0 15.167-6.848 15.167-15.195s-6.84-15.202-15.166-15.202m22.383 11.418c.21 1.234.347 2.494.347 3.784 0 1.3-.134 2.57-.347 3.813h36.381a3.795 3.795 0 0 0 3.874-3.714 3.796 3.796 0 0 0-3.874-3.883zm7.912 18.979c-8.327 0-15.13 6.855-15.13 15.202S56.83 95.58 65.157 95.58c7.007 0 12.907-4.87 14.618-11.382h13.851a3.796 3.796 0 0 0 3.706-3.883 3.795 3.795 0 0 0-3.706-3.714H79.782c-1.701-6.527-7.608-11.418-14.626-11.418zM6.029 76.602a3.8 3.8 0 0 0-3.52 4.062 3.8 3.8 0 0 0 3.882 3.535h36.412a22.5 22.5 0 0 1-.348-3.813c0-1.29.138-2.55.348-3.784H6.39a4 4 0 0 0-.362 0z"
                        data-original="#000000" />
                  </svg>
                </div>
                <div class="mb-4">
                  <h3 class="text-slate-900 text-lg font-semibold mb-3">Customization</h3>
                  <p class="text-slate-600 text-base leading-relaxed">Easily tailor every aspect of the
                      platform to suit your business needs.</p>
                </div>
                <a href="#"
                  class="inline-flex items-center text-blue-700 text-sm font-semibold focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded">
                  Learn more <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 ml-2.5 fill-current"
                      viewBox="0 0 24 24">
                      <path
                        d="m23.564 11.235-7.56-7.56a1.08 1.08 0 0 0-1.528 1.528l5.717 5.716H1.2a1.08 1.08 0 0 0 0 2.16h18.993l-5.717 5.716a1.08 1.08 0 1 0 1.528 1.528l7.56-7.56a1.08 1.08 0 0 0 0-1.528z"
                        data-original="#000000"></path>
                  </svg>
                </a>
            </div>

            <div
                class="bg-white border border-slate-300 shadow-xs rounded-lg p-6">
                <div class="flex items-center w-10 h-10 rounded-lg p-2.5 bg-gray-100 mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-full fill-slate-900"
                      viewBox="0 0 682.667 682.667" aria-hidden="true">
                      <defs>
                        <clipPath id="a" clipPathUnits="userSpaceOnUse">
                            <path d="M0 512h512V0H0Z" data-original="#000000" />
                        </clipPath>
                      </defs>
                      <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-miterlimit="10" stroke-width="40" clip-path="url(#a)"
                        transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                        <path
                            d="M256 492 60 410.623v-98.925C60 183.674 137.469 68.38 256 20c118.53 48.38 196 163.674 196 291.698v98.925z"
                            data-original="#000000" />
                        <path d="M178 271.894 233.894 216 334 316.105" data-original="#000000" />
                      </g>
                  </svg>
                </div>
                <div class="mb-4">
                  <h3 class="text-slate-900 text-lg font-semibold mb-3">Security</h3>
                  <p class="text-slate-600 text-base leading-relaxed">Your data is protected by the
                      latest security
                      measures.
                  </p>
                </div>
                <a href="#"
                  class="inline-flex items-center text-blue-700 text-sm font-semibold focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded">
                  Learn more <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 ml-2.5 fill-current"
                      viewBox="0 0 24 24" aria-hidden="true">
                      <path
                        d="m23.564 11.235-7.56-7.56a1.08 1.08 0 0 0-1.528 1.528l5.717 5.716H1.2a1.08 1.08 0 0 0 0 2.16h18.993l-5.717 5.716a1.08 1.08 0 1 0 1.528 1.528l7.56-7.56a1.08 1.08 0 0 0 0-1.528z"
                        data-original="#000000"></path>
                  </svg>
                </a>
            </div>

            <div
                class="bg-white border border-slate-300 shadow-xs rounded-lg p-6">
                <div class="flex items-center w-10 h-10 rounded-lg p-2.5 bg-gray-100 mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-full fill-slate-900"
                      viewBox="0 0 512 512" aria-hidden="true">
                      <path
                        d="M495.984 252.588c-17.119-14.109-44.177-15.319-61.936 3.74l-44.087 47.327c-5.7-18.319-22.809-31.658-42.977-31.658h-78.675c-5.97 0-7.969-2.28-18.339-10.269-39.538-34.468-98.924-34.358-138.342.33L82.71 287.516c-12.999-6.88-28.178-7.05-41.248-.52L8.294 303.575c-7.41 3.71-10.409 12.719-6.71 20.129l89.995 179.989c3.71 7.41 12.719 10.409 20.129 6.71l33.168-16.589c16.349-8.169 25.448-24.849 24.858-41.827h177.249c32.868 0 64.276-15.699 83.995-41.997l72.006-96.014c13.969-18.61 11.759-45.899-7-61.388zM131.456 466.985l-19.749 9.879-76.585-153.16 19.759-9.879c7.41-3.7 16.409-.71 20.119 6.71l63.166 126.332c3.7 7.409.7 16.408-6.71 20.118zm347.529-171.009L406.98 391.99c-14.089 18.789-36.518 29.998-59.996 29.998H159.265l-56.207-112.423 28.388-24.988c28.248-24.849 70.846-24.849 99.094 0 16.639 14.649 26.988 17.419 37.768 17.419h78.675c8.27 0 14.999 6.73 14.999 14.999s-6.73 14.999-14.999 14.999h-76.605c-8.28 0-14.999 6.72-14.999 14.999s6.72 14.999 14.999 14.999h86.655c12.449 0 24.449-5.22 32.928-14.329l66.036-70.886c6.04-6.48 15.299-5.94 20.979-.97 5.939 5.199 6.58 14.089 2.009 20.169zm-163.6-193.609c10.269-10.769 16.599-25.328 16.599-41.358 0-33.018-26.678-60.996-59.996-60.996-33.068 0-60.996 27.928-60.996 60.996 0 15.539 6.09 30.208 17.149 41.478-27.428 15.379-47.147 44.897-47.147 79.515v14.999c0 8.279 6.72 14.999 14.999 14.999h150.991c8.279 0 14.999-6.72 14.999-14.999v-14.999c-.001-33.938-18.668-63.916-46.598-79.635zm-43.397-72.355c16.259 0 29.998 14.199 29.998 30.998 0 16.539-13.459 29.998-29.998 29.998-16.799 0-30.998-13.739-30.998-29.998 0-16.509 14.489-30.998 30.998-30.998zm-60.996 151.99c0-33.068 27.928-60.996 60.996-60.996 33.078 0 59.996 27.358 59.996 60.996H210.992z"
                        data-original="#000000" />
                  </svg>
                </div>
                <div class="mb-4">
                  <h3 class="text-slate-900 text-lg font-semibold mb-3">Support</h3>
                  <p class="text-slate-600 text-base leading-relaxed">Our expert support team is
                      available around the clock to assist you.</p>
                </div>
                <a href="#"
                  class="inline-flex items-center text-blue-700 text-sm font-semibold focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded">
                  Learn more
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 ml-2.5 fill-current" viewBox="0 0 24 24"
                      aria-hidden="true">
                      <path
                        d="m23.564 11.235-7.56-7.56a1.08 1.08 0 0 0-1.528 1.528l5.717 5.716H1.2a1.08 1.08 0 0 0 0 2.16h18.993l-5.717 5.716a1.08 1.08 0 1 0 1.528 1.528l7.56-7.56a1.08 1.08 0 0 0 0-1.528z"
                        data-original="#000000"></path>
                  </svg>
                </a>
            </div>

            <div
                class="bg-white border border-slate-300 shadow-xs rounded-lg p-6">
                <div class="flex items-center w-10 h-10 rounded-lg p-2.5 bg-gray-100 mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-full fill-slate-900"
                      viewBox="0 0 512 512" aria-hidden="true">
                      <path
                        d="M451 257v215c0 22.5-14.1 40-32.1 40H375c-18 0-32.1-17.6-32.1-40V257c0-22.5 14.1-40 32.1-40h43.9c17.9 0 32.1 17.6 32.1 40zm.7-126.1c-3 2.1-6.9 2.2-10.1.3l-30-18C362.2 195 292.5 272 157.9 272c-28.4 0-59.7-3.4-94.3-11-5-1.1-8.2-6-7.2-11.1 1-4.6 5.2-7.7 9.9-7.3 8.4.7 203.6 13.8 285.6-166.7L321.2 61c-4.6-2.2-6.6-7.8-4.4-12.4 1-2.1 2.7-3.7 4.8-4.6L423.5.7c4.7-2 10.2.2 12.2 4.9.3.7.5 1.4.6 2.1l19.3 113.9c.7 3.6-.9 7.3-3.9 9.3zM310.1 336v136c0 22.5-14.1 40-32.1 40h-44c-18 0-32.1-17.6-32.1-40V336c0-22.5 14.1-40 32.1-40h43.9c18.1-.1 32.2 17.5 32.2 40zm-137.8 65.8V472c0 22.4-14.1 40-32.1 40h-44c-18 0-32.1-17.6-32.1-40v-70.2c0-22.5 14.1-40 32.1-40h43.9c18.1-.1 32.2 17.5 32.2 40z"
                        data-original="#000000" />
                  </svg>
                </div>
                <div class="mb-4">
                  <h3 class="text-slate-900 text-lg font-semibold mb-3">Performance</h3>
                  <p class="text-slate-600 text-base leading-relaxed">Experience blazing-fast
                      performance with our product.
                  </p>
                </div>
                <a href="#"
                  class="inline-flex items-center text-blue-700 text-sm font-semibold focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded">
                  Learn more <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 ml-2.5 fill-current"
                      viewBox="0 0 24 24" aria-hidden="true">
                      <path
                        d="m23.564 11.235-7.56-7.56a1.08 1.08 0 0 0-1.528 1.528l5.717 5.716H1.2a1.08 1.08 0 0 0 0 2.16h18.993l-5.717 5.716a1.08 1.08 0 1 0 1.528 1.528l7.56-7.56a1.08 1.08 0 0 0 0-1.528z"
                        data-original="#000000"></path>
                  </svg>
                </a>
            </div>

            <div
                class="bg-white border border-slate-300 shadow-xs rounded-lg p-6">
                <div class="flex items-center w-10 h-10 rounded-lg p-2.5 bg-gray-100 mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-full fill-slate-900"
                      viewBox="0 0 25 25" aria-hidden="true">
                      <path
                        d="M19.794 17.078a9.94 9.94 0 0 0 1.705-5.578c0-5.513-4.487-10-10-10s-10 4.487-10 10 4.486 10 10 10a9.94 9.94 0 0 0 5.573-1.702l3.14 3.14c.75.75 1.97.75 2.72 0 .76-.75.76-1.97 0-2.73zM11.499 19.5c-4.412 0-8-3.589-8-8s3.588-8 8-8 8 3.59 8 8-3.59 8-8 8"
                        data-original="#000000" />
                      <path d="M6.493 9.507h2v5.987h-2zm4.006-2h2v7.987h-2zm4.005 3.993h2v3.994h-2z"
                        data-original="#000000" />
                  </svg>
                </div>
                <div class="mb-4">
                  <h3 class="text-slate-900 text-lg font-semibold mb-3">Global Reach</h3>
                  <p class="text-slate-600 text-base leading-relaxed">Whether you're a startup or
                      enterprise. Add users,
                      features.</p>
                </div>
                <a href="#"
                  class="inline-flex items-center text-blue-700 text-sm font-semibold focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded">
                  Learn more
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 ml-2.5 fill-current" viewBox="0 0 24 24"
                      aria-hidden="true">
                      <path
                        d="m23.564 11.235-7.56-7.56a1.08 1.08 0 0 0-1.528 1.528l5.717 5.716H1.2a1.08 1.08 0 0 0 0 2.16h18.993l-5.717 5.716a1.08 1.08 0 1 0 1.528 1.528l7.56-7.56a1.08 1.08 0 0 0 0-1.528z"
                        data-original="#000000"></path>
                  </svg>
                </a>
            </div>

            <div
                class="bg-white border border-slate-300 shadow-xs rounded-lg p-6">
                <div class="flex items-center w-10 h-10 rounded-lg p-2.5 bg-gray-100 mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-full fill-slate-900"
                      viewBox="0 0 24 24" aria-hidden="true">
                      <path fill-rule="evenodd"
                        d="M12 3.5A8.5 8.5 0 0 0 3.5 12v7.75c0 .414.335.75.75.75H12a8.5 8.5 0 0 0 0-17M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.478 10-10 10H4.25A2.25 2.25 0 0 1 2 19.75zm5.25-2.266a.75.75 0 0 1 .75-.75h8a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75m0 4.532a.75.75 0 0 1 .75-.75h4.508a.75.75 0 1 1 0 1.5H8a.75.75 0 0 1-.75-.75"
                        clip-rule="evenodd" data-original="#000000" />
                  </svg>
                </div>
                <div class="mb-4">
                  <h3 class="text-slate-900 text-lg font-semibold mb-3">Communication</h3>
                  <p class="text-slate-600 text-base leading-relaxed">Seamless communication for your
                      team. Keep everyone connected instantly.</p>
                </div>
                <a href="#"
                  class="inline-flex items-center text-blue-700 text-sm font-semibold focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded">
                  Learn more
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5 ml-2.5 fill-current" viewBox="0 0 24 24"
                      aria-hidden="true">
                      <path
                        d="m23.564 11.235-7.56-7.56a1.08 1.08 0 0 0-1.528 1.528l5.717 5.716H1.2a1.08 1.08 0 0 0 0 2.16h18.993l-5.717 5.716a1.08 1.08 0 1 0 1.528 1.528l7.56-7.56a1.08 1.08 0 0 0 0-1.528z"
                        data-original="#000000"></path>
                  </svg>
                </a>
            </div>
          </div>
      </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Shop by Category</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <a href="#" class="group">
            <div class="relative overflow-hidden rounded-xl aspect-[3/4]">
              <img
                src="https://readdy.ai/api/search-image?query=elegant%20womens%20clothing%20collection%2C%20minimal%20background%2C%20professional%20fashion%20photography%2C%20soft%20lighting%2C%20high-end%20apparel%20displayed%20neatly&width=400&height=500&seq=cat1&orientation=portrait"
                alt="Women's Collection"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              />
              <div class="absolute inset-0 bg-black/20 flex items-end p-6">
                <div>
                  <h3 class="text-xl font-semibold text-white mb-1">Women</h3>
                  <p class="text-white/80 text-sm">View Collection</p>
                </div>
              </div>
            </div>
          </a>
          <a href="#" class="group">
            <div class="relative overflow-hidden rounded-lg aspect-[3/4]">
              <img
                src="https://readdy.ai/api/search-image?query=stylish%20mens%20clothing%20collection%2C%20minimal%20background%2C%20professional%20fashion%20photography%2C%20soft%20lighting%2C%20high-end%20apparel%20displayed%20neatly&width=400&height=500&seq=cat2&orientation=portrait"
                alt="Men's Collection"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              />
              <div class="absolute inset-0 bg-black/20 flex items-end p-6">
                <div>
                  <h3 class="text-xl font-semibold text-white mb-1">Men</h3>
                  <p class="text-white/80 text-sm">View Collection</p>
                </div>
              </div>
            </div>
          </a>
          <a href="#" class="group">
            <div class="relative overflow-hidden rounded-lg aspect-[3/4]">
              <img
                src="https://readdy.ai/api/search-image?query=premium%20accessories%20collection%20including%20bags%2C%20jewelry%2C%20watches%2C%20minimal%20background%2C%20professional%20product%20photography%2C%20soft%20lighting%2C%20high-end%20items%20displayed%20neatly&width=400&height=500&seq=cat3&orientation=portrait"
                alt="Accessories Collection"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              />
              <div class="absolute inset-0 bg-black/20 flex items-end p-6">
                <div>
                  <h3 class="text-xl font-semibold text-white mb-1">
                    Accessories
                  </h3>
                  <p class="text-white/80 text-sm">View Collection</p>
                </div>
              </div>
            </div>
          </a>
          <a href="#" class="group">
            <div class="relative overflow-hidden rounded-lg aspect-[3/4]">
              <img
                src="https://readdy.ai/api/search-image?query=luxury%20footwear%20collection%20including%20shoes%2C%20boots%2C%20sneakers%2C%20minimal%20background%2C%20professional%20product%20photography%2C%20soft%20lighting%2C%20high-end%20items%20displayed%20neatly&width=400&height=500&seq=cat4&orientation=portrait"
                alt="Footwear Collection"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              />
              <div class="absolute inset-0 bg-black/20 flex items-end p-6">
                <div>
                  <h3 class="text-xl font-semibold text-white mb-1">
                    Footwear
                  </h3>
                  <p class="text-white/80 text-sm">View Collection</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>

    <section>
      <div class="p-4">
      <div class="text-center max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold text-slate-900 !leading-tight">What our happy client say</h2>
        <p class="text-[15px] mt-6 leading-relaxed text-slate-600">See what our happy clients have to say. They’ve shared how our templates helped them launch quickly, look professional, and grow with ease.</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-20 max-w-6xl max-lg:max-w-3xl max-md:max-w-md mx-auto mt-24">
        <div class="w-full p-6 rounded-md mx-auto shadow-md border border-gray-200 bg-white relative">
          <div class="w-[76px] h-[76px] rounded-full overflow-hidden absolute right-0 left-0 mx-auto -top-10 border-2 border-orange-400">
            <img src="https://readymadeui.com/team-2.webp" class="w-full h-full" />
          </div>
          <div class="mt-8 text-center">
            <p class="text-[15px] text-slate-700 font-normal leading-relaxed">ReadymadeUI made it so easy to launch my website. The components are clean, fast to use, and saved me hours of development time.</p>
          </div>

          <div class="mt-4 text-center">
            <h4 class="text-slate-900 text-[15px] whitespace-nowrap font-semibold">John Doe</h4>
          </div>
          <div class="flex justify-center space-x-1 mt-3">
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-4 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
          </div>
        </div>

        <div class="w-full p-6 rounded-md mx-auto shadow-md border border-gray-200 bg-white relative">
          <div class="w-[76px] h-[76px] rounded-full overflow-hidden absolute right-0 left-0 mx-auto -top-10 border-2 border-orange-400">
            <img src="https://readymadeui.com/team-3.webp" class="w-full h-full" />
          </div>
          <div class="mt-8 text-center">
            <p class="text-[15px] text-slate-700 font-normal leading-relaxed">I love how professional everything looks with ReadymadeUI. The templates are modern, responsive, and easy to customize.</p>
          </div>

          <div class="mt-4 text-center">
            <h4 class="text-slate-900 text-[15px] whitespace-nowrap font-semibold">Karolina Adair</h4>
          </div>
          <div class="flex justify-center space-x-1 mt-3">
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-4 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
          </div>
        </div>

        <div class="w-full p-6 rounded-md mx-auto shadow-md border border-gray-200 bg-white relative">
          <div class="w-[76px] h-[76px] rounded-full overflow-hidden absolute right-0 left-0 mx-auto -top-10 border-2 border-orange-400">
            <img src="https://readymadeui.com/team-4.webp" class="w-full h-full" />
          </div>
          <div class="mt-8 text-center">
            <p class="text-[15px] text-slate-700 font-normal leading-relaxed">ReadymadeUI gave my project a polished look without the hassle. The layouts are beautifully designed and ready to go.</p>
          </div>

          <div class="mt-4 text-center">
            <h4 class="text-slate-900 text-[15px] whitespace-nowrap font-semibold">Simon Konecki</h4>
          </div>
          <div class="flex justify-center space-x-1 mt-3">
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-4 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
          </div>
        </div>

        <div class="w-full p-6 rounded-md mx-auto shadow-md border border-gray-200 bg-white relative">
          <div class="w-[76px] h-[76px] rounded-full overflow-hidden absolute right-0 left-0 mx-auto -top-10 border-2 border-orange-400">
            <img src="https://readymadeui.com/team-5.webp" class="w-full h-full" />
          </div>
          <div class="mt-8 text-center">
            <p class="text-[15px] text-slate-700 font-normal leading-relaxed">Amazing quality and attention to detail! Every component is thoughtfully crafted, and it made my site look like it was built by a pro.</p>
          </div>

          <div class="mt-4 text-center">
            <h4 class="text-slate-900 text-[15px] whitespace-nowrap font-semibold">Emily Chen</h4>
          </div>
          <div class="flex justify-center space-x-1 mt-3">
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
          </div>
        </div>

        <div class="w-full p-6 rounded-md mx-auto shadow-md border border-gray-200 bg-white relative">
          <div class="w-[76px] h-[76px] rounded-full overflow-hidden absolute right-0 left-0 mx-auto -top-10 border-2 border-orange-400">
            <img src="https://readymadeui.com/team-6.webp" class="w-full h-full" />
          </div>
          <div class="mt-8 text-center">
            <p class="text-[15px] text-slate-700 font-normal leading-relaxed">So many design options! ReadymadeUI has something for every use case, and it’s super easy to mix and match components.</p>
          </div>

          <div class="mt-4 text-center">
            <h4 class="text-slate-900 text-[15px] whitespace-nowrap font-semibold">Marcus Rodriguez</h4>
          </div>
          <div class="flex justify-center space-x-1 mt-3">
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
          </div>
        </div>

        <div class="w-full p-6 rounded-md mx-auto shadow-md border border-gray-200 bg-white relative">
          <div class="w-[76px] h-[76px] rounded-full overflow-hidden absolute right-0 left-0 mx-auto -top-10 border-2 border-orange-400">
            <img src="https://readymadeui.com/team-1.webp" class="w-full h-full" />
          </div>
          <div class="mt-8 text-center">
            <p class="text-[15px] text-slate-700 font-normal leading-relaxed">As a repeat user, I’m always impressed by the updates and new layouts. ReadymadeUI just keeps getting better and better.</p>
          </div>

          <div class="mt-4 text-center">
            <h4 class="text-slate-900 text-[15px] whitespace-nowrap font-semibold">Sarah Thompson</h4>
          </div>
          <div class="flex justify-center space-x-1 mt-3">
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
            <svg class="w-3.5 h-3.5 fill-orange-400" viewBox="0 0 14 13" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
            </svg>
          </div>
        </div>
      </div>
    </div>
    </section>

    <section>
      <div class="max-w-screen-xl mx-auto p-4 py-24">
    <div class="mb-12 max-w-4xl">
        <h2 class="text-2xl font-bold text-slate-900">Frequently Asked Questions</h2>
        <p class="text-[15px] text-slate-600 leading-relaxed mt-6">
            Explore common questions about using our platform, managing your account, billing, and accessing support.
            Whether you're a developer or a new user, this section helps you get quick answers without the hassle.
        </p>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        <div class="space-y-6">
            <div class="accordion bg-white [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] rounded-lg">
                <button type="button"
                    class="toggle-button cursor-pointer p-6 w-full text-base font-semibold text-left text-slate-900 flex items-center">
                    <span class="mr-4">How do I deploy my app to production?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-[14px] h-[14px] fill-current ml-auto shrink-0">
                        <path
                            d="M40.421 215.579H471.579C493.868 215.579 512 233.711 512 256s-18.132 40.421-40.421 40.421H40.421C18.132 296.421 0 278.289 0 256s18.132-40.421 40.421-40.421z" />
                        <path class="plus hidden"
                            d="M215.579 40.421C215.579 18.132 233.711 0 256 0s40.421 18.132 40.421 40.421v431.158C296.421 493.868 278.289 512 256 512s-40.421-18.132-40.421-40.421V40.421z" />
                    </svg>
                </button>
                <div class="content max-h-[1000px] px-6 pb-6 overflow-hidden transition-all duration-300">
                    <p class="text-[15px] text-slate-600 leading-relaxed">
                        You can deploy your app using platforms like Vercel, Netlify, or your own server. Make sure to
                        configure environment variables and use a production build (`npm run build`) before deployment.
                    </p>
                </div>
            </div>

            <div class="accordion bg-white [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] rounded-lg">
                <button type="button"
                    class="toggle-button cursor-pointer p-6 w-full text-base font-medium text-left text-slate-900 flex items-center">
                    <span class="mr-4">Can I use a custom domain with my project?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-[14px] h-[14px] fill-current ml-auto shrink-0">
                        <path
                            d="M40.421 215.579H471.579C493.868 215.579 512 233.711 512 256s-18.132 40.421-40.421 40.421H40.421C18.132 296.421 0 278.289 0 256s18.132-40.421 40.421-40.421z" />
                        <path class="plus"
                            d="M215.579 40.421C215.579 18.132 233.711 0 256 0s40.421 18.132 40.421 40.421v431.158C296.421 493.868 278.289 512 256 512s-40.421-18.132-40.421-40.421V40.421z" />
                    </svg>
                </button>
                <div class="content invisible max-h-0 px-6 overflow-hidden transition-all duration-300">
                    <p class="text-[15px] text-slate-600 leading-relaxed">
                        Yes, you can connect a custom domain via your DNS provider. Most platforms like Vercel or
                        Netlify offer simple guides to point your domain to your deployed site.
                    </p>
                </div>
            </div>

            <div class="accordion bg-white [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] rounded-lg">
                <button type="button"
                    class="toggle-button cursor-pointer p-6 w-full text-base font-medium text-left text-slate-900 flex items-center">
                    <span class="mr-4">How do I contribute or suggest improvements to the platform?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-[14px] h-[14px] fill-current ml-auto shrink-0">
                        <path
                            d="M40.421 215.579H471.579C493.868 215.579 512 233.711 512 256s-18.132 40.421-40.421 40.421H40.421C18.132 296.421 0 278.289 0 256s18.132-40.421 40.421-40.421z" />
                        <path class="plus"
                            d="M215.579 40.421C215.579 18.132 233.711 0 256 0s40.421 18.132 40.421 40.421v431.158C296.421 493.868 278.289 512 256 512s-40.421-18.132-40.421-40.421V40.421z" />
                    </svg>
                </button>
                <div class="content invisible max-h-0 px-6 overflow-hidden transition-all duration-300">
                    <p class="text-[15px] text-slate-600 leading-relaxed">
                        You can contribute by submitting feedback through our contact form or GitHub issues (if
                        applicable). We welcome ideas and suggestions to improve our UI components and developer
                        experience.
                    </p>
                </div>
            </div>

            <div class="accordion bg-white [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] rounded-lg">
                <button type="button"
                    class="toggle-button cursor-pointer p-6 w-full text-base font-medium text-left text-slate-900 flex items-center">
                    <span class="mr-4">Is the codebase optimized for SEO and performance?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-[14px] h-[14px] fill-current ml-auto shrink-0">
                        <path
                            d="M40.421 215.579H471.579C493.868 215.579 512 233.711 512 256s-18.132 40.421-40.421 40.421H40.421C18.132 296.421 0 278.289 0 256s18.132-40.421 40.421-40.421z" />
                        <path class="plus"
                            d="M215.579 40.421C215.579 18.132 233.711 0 256 0s40.421 18.132 40.421 40.421v431.158C296.421 493.868 278.289 512 256 512s-40.421-18.132-40.421-40.421V40.421z" />
                    </svg>
                </button>
                <div class="content invisible max-h-0 px-6 overflow-hidden transition-all duration-300">
                    <p class="text-[15px] text-slate-600 leading-relaxed">
                        Yes, our components are built with performance and SEO in mind. HTML is semantic, images are
                        optimized, and we follow best practices like lazy loading, accessibility, and Open Graph
                        support.
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="accordion bg-white [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] rounded-lg">
                <button type="button"
                    class="toggle-button cursor-pointer p-6 w-full text-base font-medium text-left text-slate-900 flex items-center">
                    <span class="mr-4">How do I manage API keys securely?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-[14px] h-[14px] fill-current ml-auto shrink-0">
                        <path
                            d="M40.421 215.579H471.579C493.868 215.579 512 233.711 512 256s-18.132 40.421-40.421 40.421H40.421C18.132 296.421 0 278.289 0 256s18.132-40.421 40.421-40.421z" />
                        <path class="plus"
                            d="M215.579 40.421C215.579 18.132 233.711 0 256 0s40.421 18.132 40.421 40.421v431.158C296.421 493.868 278.289 512 256 512s-40.421-18.132-40.421-40.421V40.421z" />
                    </svg>
                </button>
                <div class="content invisible max-h-0 px-6 overflow-hidden transition-all duration-300">
                    <p class="text-[15px] text-slate-600 leading-relaxed">
                        Never expose API keys on the client side. Store them in environment variables and use them only
                        on the server. Platforms like Next.js support `.env.local` files to manage this securely.
                    </p>
                </div>
            </div>

            <div class="accordion bg-white [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] rounded-lg">
                <button type="button"
                    class="toggle-button cursor-pointer p-6 w-full text-base font-medium text-left text-slate-900 flex items-center">
                    <span class="mr-4">Do you offer technical support for developers?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-[14px] h-[14px] fill-current ml-auto shrink-0">
                        <path
                            d="M40.421 215.579H471.579C493.868 215.579 512 233.711 512 256s-18.132 40.421-40.421 40.421H40.421C18.132 296.421 0 278.289 0 256s18.132-40.421 40.421-40.421z" />
                        <path class="plus"
                            d="M215.579 40.421C215.579 18.132 233.711 0 256 0s40.421 18.132 40.421 40.421v431.158C296.421 493.868 278.289 512 256 512s-40.421-18.132-40.421-40.421V40.421z" />
                    </svg>
                </button>
                <div class="content invisible max-h-0 px-6 overflow-hidden transition-all duration-300">
                    <p class="text-[15px] text-slate-600 leading-relaxed">
                        Yes, we provide developer-focused support through our documentation, community Discord, and
                        priority email support for pro accounts. Feel free to reach out anytime.
                    </p>
                </div>
            </div>

            <div class="accordion bg-white [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] rounded-lg">
                <button type="button"
                    class="toggle-button cursor-pointer p-6 w-full text-base font-medium text-left text-slate-900 flex items-center">
                    <span class="mr-4">Can I use these components in commercial projects?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-[14px] h-[14px] fill-current ml-auto shrink-0">
                        <path
                            d="M40.421 215.579H471.579C493.868 215.579 512 233.711 512 256s-18.132 40.421-40.421 40.421H40.421C18.132 296.421 0 278.289 0 256s18.132-40.421 40.421-40.421z" />
                        <path class="plus"
                            d="M215.579 40.421C215.579 18.132 233.711 0 256 0s40.421 18.132 40.421 40.421v431.158C296.421 493.868 278.289 512 256 512s-40.421-18.132-40.421-40.421V40.421z" />
                    </svg>
                </button>
                <div class="content invisible max-h-0 px-6 overflow-hidden transition-all duration-300">
                    <p class="text-[15px] text-slate-600 leading-relaxed">
                        Absolutely! All components are designed to be production-ready and can be used in both personal
                        and commercial projects. Just follow the license guidelines if mentioned.
                    </p>
                </div>
            </div>

            <div class="accordion bg-white [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] rounded-lg">
                <button type="button"
                    class="toggle-button cursor-pointer p-6 w-full text-base font-medium text-left text-slate-900 flex items-center">
                    <span class="mr-4">Do you provide updates or new components regularly?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-[14px] h-[14px] fill-current ml-auto shrink-0">
                        <path
                            d="M40.421 215.579H471.579C493.868 215.579 512 233.711 512 256s-18.132 40.421-40.421 40.421H40.421C18.132 296.421 0 278.289 0 256s18.132-40.421 40.421-40.421z" />
                        <path class="plus"
                            d="M215.579 40.421C215.579 18.132 233.711 0 256 0s40.421 18.132 40.421 40.421v431.158C296.421 493.868 278.289 512 256 512s-40.421-18.132-40.421-40.421V40.421z" />
                    </svg>
                </button>
                <div class="content invisible max-h-0 px-6 overflow-hidden transition-all duration-300">
                    <p class="text-[15px] text-slate-600 leading-relaxed">
                        Yes, we continuously release new components, improvements, and bug fixes based on user feedback
                        and modern UI/UX trends. Stay tuned for regular updates!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>
  </div>
</template>
