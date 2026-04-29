<script setup>
import { ref } from 'vue'
import AdminSidebar from '../layouts/AdminSidebar.vue'

const sidebarOpen = ref(true)

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value
}

const stats = [
  { label: 'Revenue', value: 'Rp128.4M', change: '+12.4%' },
  { label: 'Orders', value: '12,483', change: '+8.1%' },
  { label: 'Customers', value: '8,921', change: '+4.7%' },
  { label: 'Products', value: '1,204', change: '+2.3%' }
]

</script>

<template>
  <div class="min-h-screen bg-slate-50">
    <AdminSidebar :sidebar-open="sidebarOpen" @toggle="toggleSidebar" />

    <main :style="{ paddingLeft: sidebarOpen ? '250px' : '80px' }">
      <div class="p-6 lg:p-8">
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-slate-900">Admin Dashboard</h1>
          <p class="text-slate-500 mt-2">Overview of sales, orders, and store activity.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
          <div v-for="stat in stats" :key="stat.label" class="rounded-2xl bg-white p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-slate-500">{{ stat.label }}</p>
            <div class="mt-3 flex items-end justify-between gap-4">
              <h2 class="text-2xl font-bold text-slate-900">{{ stat.value }}</h2>
              <span class="text-sm font-medium text-green-600">{{ stat.change }}</span>
            </div>
          </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-2">
          <div class="lg:col-span-2 rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
              <div>
                <h2 class="text-lg font-semibold text-slate-900">Recent Orders</h2>
                <p class="text-sm text-slate-500 mt-1">Latest transactions from your store.</p>
              </div>
              <router-link to="/order-history" class="text-sm font-medium text-blue-600 hover:text-blue-700">View history</router-link>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-100">
              <table class="min-w-full bg-white">
                <thead class="whitespace-nowrap bg-gray-50">
                  <tr>
                    <th class="w-8 pl-4">
                      <input id="checkbox" type="checkbox" class="peer hidden" />
                      <label
                        for="checkbox"
                        class="relative flex h-5 w-5 cursor-pointer items-center justify-center overflow-hidden rounded border border-gray-400 bg-blue-500 p-0.5 before:absolute before:block before:h-full before:w-full before:bg-white peer-checked:before:hidden"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                          <path
                            d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z"
                          />
                        </svg>
                      </label>
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                      <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 inline h-4 w-4 fill-gray-500" viewBox="0 0 512 512">
                          <path
                            d="M337.711 241.3a16 16 0 0 0-11.461 3.988c-18.739 16.561-43.688 25.682-70.25 25.682s-51.511-9.121-70.25-25.683a16.007 16.007 0 0 0-11.461-3.988c-78.926 4.274-140.752 63.672-140.752 135.224v107.152C33.537 499.293 46.9 512 63.332 512h385.336c16.429 0 29.8-12.707 29.8-28.325V376.523c-.005-71.552-61.831-130.95-140.757-135.223zM446.463 480H65.537V376.523c0-52.739 45.359-96.888 104.351-102.8C193.75 292.63 224.055 302.97 256 302.97s62.25-10.34 86.112-29.245c58.992 5.91 104.351 50.059 104.351 102.8zM256 234.375a117.188 117.188 0 1 0-117.188-117.187A117.32 117.32 0 0 0 256 234.375zM256 32a85.188 85.188 0 1 1-85.188 85.188A85.284 85.284 0 0 1 256 32z"
                          />
                        </svg>
                        Full Name
                      </div>
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                      <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 inline h-4 w-4 fill-gray-500" viewBox="0 0 512 512">
                          <path d="M467 76H45C20.238 76 0 96.149 0 121v270c0 24.86 20.251 45 45 45h422c24.762 0 45-20.149 45-45V121c0-24.857-20.248-45-45-45zm-6.91 30L267.624 299.094c-5.864 5.882-17.381 5.886-23.248 0L51.91 106h408.18zM30 385.485v-258.97L159.065 256 30 385.485zM51.91 406l128.334-128.752 42.885 43.025c17.574 17.631 48.175 17.624 65.743 0l42.885-43.024L460.09 406H51.91zM482 385.485 352.935 256 482 126.515v258.97z" />
                        </svg>
                        Email
                      </div>
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                      <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 inline h-4 w-4 fill-gray-500" fill-rule="evenodd" viewBox="0 0 24 24">
                          <g transform="matrix(1.08 0 0 1.08 -.96 -.96)">
                            <path d="M11.5 20.263H2.95a.2.2 0 0 1-.2-.2v-1.45c0-.831.593-1.563 1.507-2.185 1.632-1.114 4.273-1.816 7.243-1.816a.75.75 0 0 0 0-1.5c-3.322 0-6.263.831-8.089 2.076-1.393.95-2.161 2.157-2.161 3.424v1.451a1.7 1.7 0 0 0 1.7 1.7h8.55a.75.75 0 1 0 0-1.5zm0-19.013C8.464 1.25 6 3.714 6 6.75s2.464 5.5 5.5 5.5S17 9.786 17 6.75s-2.464-5.5-5.5-5.5zm0 1.5c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm5.25 14.75V20a.75.75 0 0 0 1.5 0v-2.5a.75.75 0 0 0-1.5 0z" />
                            <circle cx="17.5" cy="15.25" r="1" />
                            <path d="M17.5 12.25c-2.898 0-5.25 2.352-5.25 5.25s2.352 5.25 5.25 5.25 5.25-2.352 5.25-5.25-2.352-5.25-5.25-5.25zm0 1.5c2.07 0 3.75 1.68 3.75 3.75s-1.68 3.75-3.75 3.75-3.75-1.68-3.75-3.75 1.68-3.75 3.75-3.75z" />
                          </g>
                        </svg>
                        Role
                      </div>
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                      <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 inline h-4 w-4 fill-gray-500" viewBox="0 0 24 24">
                          <path d="M15.24 23.61H8.76c-5.864 0-8.37-2.506-8.37-8.37V8.76C.39 2.896 2.896.39 8.76.39h6.48c5.864 0 8.37 2.506 8.37 8.37v6.48c0 5.864-2.506 8.37-8.37 8.37zM8.76 2.01c-4.979 0-6.75 1.771-6.75 6.75v6.48c0 4.979 1.771 6.75 6.75 6.75h6.48c4.979 0 6.75-1.771 6.75-6.75V8.76c0-4.979-1.771-6.75-6.75-6.75z" />
                          <path d="M6.956 15.5a.795.795 0 0 1-.496-.174.809.809 0 0 1-.152-1.134l2.57-3.337c.314-.4.757-.659 1.264-.723a1.886 1.886 0 0 1 1.404.388l1.977 1.556a.23.23 0 0 0 .205.054c.043 0 .119-.022.184-.108l2.494-3.219a.8.8 0 0 1 1.134-.14c.357.27.422.777.14 1.134l-2.494 3.218c-.313.4-.756.659-1.264.713a1.873 1.873 0 0 1-1.404-.389l-1.976-1.555a.238.238 0 0 0-.205-.054c-.043 0-.119.022-.184.108l-2.57 3.337a.732.732 0 0 1-.627.324z" />
                        </svg>
                        Status
                      </div>
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                      <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 inline h-4 w-4 fill-gray-500" viewBox="0 0 24 24">
                          <g transform="matrix(1.05 0 0 1.05 -.6 -.6)">
                            <path d="M19 22.75H5c-2.07 0-3.75-1.68-3.75-3.75V7c0-2.07 1.68-3.75 3.75-3.75h14c2.07 0 3.75 1.68 3.75 3.75v12c0 2.07-1.68 3.75-3.75 3.75zm-14-18C3.76 4.75 2.75 5.76 2.75 7v12c0 1.24 1.01 2.25 2.25 2.25h14c1.24 0 2.25-1.01 2.25-2.25V7c0-1.24-1.01-2.25-2.25-2.25z" />
                            <path d="M22 9.75H2c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h20c.41 0 .75.34.75.75s-.34.75-.75.75zm-5-5c-.41 0-.75-.34-.75-.75V2c0-.41.34-.75.75-.75s.75.34.75.75v2c0 .41-.34.75-.75.75zm-10 0c-.41 0-.75-.34-.75-.75V2c0-.41.34-.75.75-.75s.75.34.75.75v2c0 .41-.34.75-.75.75z" />
                            <circle cx="7" cy="13" r="1" />
                            <circle cx="12" cy="13" r="1" />
                            <circle cx="17" cy="13" r="1" />
                          </g>
                        </svg>
                        Joined date
                      </div>
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                      <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 inline h-4 w-4 fill-gray-500" viewBox="0 0 24 24">
                          <path d="M12 23.5C5.675 23.5.5 18.325.5 12S5.675.5 12 .5c.69 0 1.15.46 1.15 1.15S12.69 2.8 12 2.8c-5.06 0-9.2 4.14-9.2 9.2s4.14 9.2 9.2 9.2 9.2-4.14 9.2-9.2c0-.69.46-1.15 1.15-1.15s1.15.46 1.15 1.15c0 6.325-5.175 11.5-11.5 11.5z" />
                          <path d="M12 18.325c-3.45 0-6.325-2.875-6.325-6.325S8.55 5.675 12 5.675c.69 0 1.15.46 1.15 1.15s-.46 1.15-1.15 1.15c-2.185 0-4.025 1.84-4.025 4.025s1.84 4.025 4.025 4.025 4.025-1.84 4.025-4.025c0-.69.46-1.15 1.15-1.15s1.15.46 1.15 1.15c0 3.45-2.875 6.325-6.325 6.325z" />
                          <path d="M12 13.15c-.345 0-.575-.115-.805-.345-.46-.46-.46-1.15 0-1.61l3.68-3.68c.46-.46 1.15-.46 1.61 0s.46 1.15 0 1.61l-3.565 3.68c-.345.23-.575.345-.92.345z" />
                        </svg>
                        Action
                      </div>
                    </th>
                  </tr>
                </thead>

                <tbody class="whitespace-nowrap divide-y divide-gray-200">
                  <tr>
                    <td class="w-8 pl-4">
                      <input id="checkbox9" type="checkbox" class="peer hidden" />
                      <label
                        for="checkbox9"
                        class="relative flex h-5 w-5 cursor-pointer items-center justify-center overflow-hidden rounded border border-gray-400 bg-blue-500 p-0.5 before:absolute before:block before:h-full before:w-full before:bg-white peer-checked:before:hidden"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                          <path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z" />
                        </svg>
                      </label>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-900">
                      <div class="flex w-max cursor-pointer items-center">
                        <img src="https://readymadeui.com/team-1.webp" alt="team-1" class="h-9 w-9 shrink-0 rounded-full" />
                        <div class="ml-2">
                          <p>Tim Jones</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <a href="mailto:timj1456@gmail.com" class="underline">timj1456@gmail.com</a>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">Product Owner</td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <span class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-2 py-1">
                        <span class="h-2 w-2 rounded-full bg-green-600"></span>
                        Active
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">04 April 2025, 8:20 pm</td>
                    <td class="flex gap-3 px-4 py-3 text-sm font-medium">
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-blue-50 px-3 py-1 text-blue-600">
                        Edit
                      </button>
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-red-50 px-3 py-1 text-red-600">
                        Delete
                      </button>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-8 pl-4">
                      <input id="checkbox2" type="checkbox" class="peer hidden" />
                      <label
                        for="checkbox2"
                        class="relative flex h-5 w-5 cursor-pointer items-center justify-center overflow-hidden rounded border border-gray-400 bg-blue-500 p-0.5 before:absolute before:block before:h-full before:w-full before:bg-white peer-checked:before:hidden"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                          <path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z" />
                        </svg>
                      </label>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-900">
                      <div class="flex w-max cursor-pointer items-center">
                        <img src="https://readymadeui.com/team-2.webp" alt="team-2" class="h-9 w-9 shrink-0 rounded-full" />
                        <div class="ml-2">
                          <p>Olivia Smith</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <a href="mailto:olivia.smith@email.com" class="underline">olivia.smith@email.com</a>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">UI Designer</td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <span class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-2 py-1">
                        <span class="h-2 w-2 rounded-full bg-green-600"></span>
                        Active
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">12 March 2025, 10:45 am</td>
                    <td class="flex gap-3 px-4 py-3 text-sm font-medium">
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-blue-50 px-3 py-1 text-blue-600">
                        Edit
                      </button>
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-red-50 px-3 py-1 text-red-600">
                        Delete
                      </button>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-8 pl-4">
                      <input id="checkbox3" type="checkbox" class="peer hidden" />
                      <label
                        for="checkbox3"
                        class="relative flex h-5 w-5 cursor-pointer items-center justify-center overflow-hidden rounded border border-gray-400 bg-blue-500 p-0.5 before:absolute before:block before:h-full before:w-full before:bg-white peer-checked:before:hidden"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                          <path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z" />
                        </svg>
                      </label>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-900">
                      <div class="flex w-max cursor-pointer items-center">
                        <img src="https://readymadeui.com/team-3.webp" alt="team-3" class="h-9 w-9 shrink-0 rounded-full" />
                        <div class="ml-2">
                          <p>Ava Thompson</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <a href="mailto:ava.thompson@email.com" class="underline">ava.thompson@email.com</a>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">QA Engineer</td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <span class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-2 py-1">
                        <span class="h-2 w-2 rounded-full bg-red-600"></span>
                        Inactive
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">01 April 2025, 9:00 am</td>
                    <td class="flex gap-3 px-4 py-3 text-sm font-medium">
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-blue-50 px-3 py-1 text-blue-600">
                        Edit
                      </button>
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-red-50 px-3 py-1 text-red-600">
                        Delete
                      </button>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-8 pl-4">
                      <input id="checkbox4" type="checkbox" class="peer hidden" />
                      <label
                        for="checkbox4"
                        class="relative flex h-5 w-5 cursor-pointer items-center justify-center overflow-hidden rounded border border-gray-400 bg-blue-500 p-0.5 before:absolute before:block before:h-full before:w-full before:bg-white peer-checked:before:hidden"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                          <path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z" />
                        </svg>
                      </label>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-900">
                      <div class="flex w-max cursor-pointer items-center">
                        <img src="https://readymadeui.com/team-4.webp" alt="team-4" class="h-9 w-9 shrink-0 rounded-full" />
                        <div class="ml-2">
                          <p>Noah Davis</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <a href="mailto:noah.davis@email.com" class="underline">noah.davis@email.com</a>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">DevOps Engineer</td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <span class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-2 py-1">
                        <span class="h-2 w-2 rounded-full bg-green-600"></span>
                        Active
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">22 March 2025, 4:30 pm</td>
                    <td class="flex gap-3 px-4 py-3 text-sm font-medium">
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-blue-50 px-3 py-1 text-blue-600">
                        Edit
                      </button>
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-red-50 px-3 py-1 text-red-600">
                        Delete
                      </button>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-8 pl-4">
                      <input id="checkbox5" type="checkbox" class="peer hidden" />
                      <label
                        for="checkbox5"
                        class="relative flex h-5 w-5 cursor-pointer items-center justify-center overflow-hidden rounded border border-gray-400 bg-blue-500 p-0.5 before:absolute before:block before:h-full before:w-full before:bg-white peer-checked:before:hidden"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                          <path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z" />
                        </svg>
                      </label>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-900">
                      <div class="flex w-max cursor-pointer items-center">
                        <img src="https://readymadeui.com/team-5.webp" alt="team-5" class="h-9 w-9 shrink-0 rounded-full" />
                        <div class="ml-2">
                          <p>Sophia Martinez</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <a href="mailto:sophia.martinez@email.com" class="underline">sophia.martinez@email.com</a>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">Project Manager</td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <span class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-2 py-1">
                        <span class="h-2 w-2 rounded-full bg-green-600"></span>
                        Active
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">10 April 2025, 8:10 am</td>
                    <td class="flex gap-3 px-4 py-3 text-sm font-medium">
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-blue-50 px-3 py-1 text-blue-600">
                        Edit
                      </button>
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-red-50 px-3 py-1 text-red-600">
                        Delete
                      </button>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-8 pl-4">
                      <input id="checkbox6" type="checkbox" class="peer hidden" />
                      <label
                        for="checkbox6"
                        class="relative flex h-5 w-5 cursor-pointer items-center justify-center overflow-hidden rounded border border-gray-400 bg-blue-500 p-0.5 before:absolute before:block before:h-full before:w-full before:bg-white peer-checked:before:hidden"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                          <path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z" />
                        </svg>
                      </label>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-900">
                      <div class="flex w-max cursor-pointer items-center">
                        <img src="https://readymadeui.com/team-6.webp" alt="team-6" class="h-9 w-9 shrink-0 rounded-full" />
                        <div class="ml-2">
                          <p>Liam Johnson</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <a href="mailto:liam.johnson@email.com" class="underline">liam.johnson@email.com</a>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">Frontend Developer</td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <span class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-2 py-1">
                        <span class="h-2 w-2 rounded-full bg-green-600"></span>
                        Active
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">17 March 2025, 2:15 pm</td>
                    <td class="flex gap-3 px-4 py-3 text-sm font-medium">
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-blue-50 px-3 py-1 text-blue-600">
                        Edit
                      </button>
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-red-50 px-3 py-1 text-red-600">
                        Delete
                      </button>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-8 pl-4">
                      <input id="checkbox7" type="checkbox" class="peer hidden" />
                      <label
                        for="checkbox7"
                        class="relative flex h-5 w-5 cursor-pointer items-center justify-center overflow-hidden rounded border border-gray-400 bg-blue-500 p-0.5 before:absolute before:block before:h-full before:w-full before:bg-white peer-checked:before:hidden"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                          <path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z" />
                        </svg>
                      </label>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-900">
                      <div class="flex w-max cursor-pointer items-center">
                        <img src="https://readymadeui.com/profile_2.webp" alt="profile_2" class="h-9 w-9 shrink-0 rounded-full" />
                        <div class="ml-2">
                          <p>Mason Wilson</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <a href="mailto:mason.wilson@email.com" class="underline">mason.wilson@email.com</a>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">Product Owner</td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <span class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-2 py-1">
                        <span class="h-2 w-2 rounded-full bg-red-600"></span>
                        Inactive
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">28 March 2025, 11:55 am</td>
                    <td class="flex gap-3 px-4 py-3 text-sm font-medium">
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-blue-50 px-3 py-1 text-blue-600">
                        Edit
                      </button>
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-red-50 px-3 py-1 text-red-600">
                        Delete
                      </button>
                    </td>
                  </tr>

                  <tr>
                    <td class="w-8 pl-4">
                      <input id="checkbox8" type="checkbox" class="peer hidden" />
                      <label
                        for="checkbox8"
                        class="relative flex h-5 w-5 cursor-pointer items-center justify-center overflow-hidden rounded border border-gray-400 bg-blue-500 p-0.5 before:absolute before:block before:h-full before:w-full before:bg-white peer-checked:before:hidden"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                          <path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z" />
                        </svg>
                      </label>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-900">
                      <div class="flex w-max cursor-pointer items-center">
                        <img src="https://readymadeui.com/profile_3.webp" alt="profile_3" class="h-9 w-9 shrink-0 rounded-full" />
                        <div class="ml-2">
                          <p>Isabella Brown</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <a href="mailto:isabella.brown@email.com" class="underline">isabella.brown@email.com</a>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">Software Engineer</td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">
                      <span class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-2 py-1">
                        <span class="h-2 w-2 rounded-full bg-green-600"></span>
                        Active
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-medium text-slate-600">19 April 2025, 7:45 pm</td>
                    <td class="flex gap-3 px-4 py-3 text-sm font-medium">
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-blue-50 px-3 py-1 text-blue-600">
                        Edit
                      </button>
                      <button type="button" class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-red-50 px-3 py-1 text-red-600">
                        Delete
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>

              <div class="m-4 md:flex">
                <p class="flex-1 text-sm text-slate-600">Showind 1 to 10 of 100 entries</p>

                <div class="flex items-center max-md:mt-4">
                  <p class="text-sm text-slate-600">Display</p>
                  <select class="mx-4 h-9 rounded-md border border-gray-300 px-1 text-sm text-slate-900 outline-none">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                  </select>

                  <ul class="flex justify-center space-x-3">
                    <li class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-gray-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400" viewBox="0 0 55.753 55.753">
                        <path
                          d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
                        />
                      </svg>
                    </li>
                    <li class="flex h-9 shrink-0 cursor-pointer items-center justify-center rounded-md border border-blue-500 bg-blue-500 px-3.5 text-sm font-medium text-white hover:border-blue-500">
                      1
                    </li>
                    <li class="flex h-9 shrink-0 cursor-pointer items-center justify-center rounded-md border border-gray-300 px-3.5 text-sm font-medium text-slate-900 hover:border-blue-500">
                      2
                    </li>
                    <li class="flex h-9 shrink-0 cursor-pointer items-center justify-center rounded-md border border-gray-300 px-3.5 text-sm font-medium text-slate-900 hover:border-blue-500">
                      3
                    </li>
                    <li class="flex h-9 shrink-0 cursor-pointer items-center justify-center rounded-md border border-gray-300 px-3.5 text-sm font-medium text-slate-900 hover:border-blue-500">
                      4
                    </li>
                    <li class="flex h-9 w-9 shrink-0 cursor-pointer items-center justify-center rounded-md border border-gray-300 hover:border-blue-500">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-3 rotate-180 fill-gray-400" viewBox="0 0 55.753 55.753">
                        <path
                          d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
                        />
                      </svg>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
