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

    <!-- Featured Products -->
    <section class="py-16">
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
                <span class="text-lg font-semibold text-green-600">Rp129.00</span>
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
                <span class="text-lg font-semibold text-green-600">Rp89.99</span>
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
