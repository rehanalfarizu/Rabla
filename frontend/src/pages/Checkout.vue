<template>
  <div class="bg-white sm:px-8 px-4 py-6 pt-28 min-h-screen">
    <div class="max-w-7xl max-md:max-w-xl mx-auto">
      <div class="flex items-start mb-16">
        <div class="w-full">
          <div class="flex items-center w-full">
            <div class="w-8 h-8 shrink-0 -mx-px bg-blue-600 p-1.5 flex items-center justify-center rounded-full">
              <span class="text-sm text-white font-semibold">1</span>
            </div>
            <div class="w-full h-0.75 mx-4 rounded-lg bg-blue-600"></div>
          </div>
          <div class="mt-2 mr-4">
            <h6 class="text-sm font-semibold text-slate-900">Cart</h6>
          </div>
        </div>
        <div class="w-full">
          <div class="flex items-center w-full">
            <div class="w-8 h-8 shrink-0 -mx-px bg-blue-600 p-1.5 flex items-center justify-center rounded-full">
              <span class="text-sm text-white font-semibold">2</span>
            </div>
            <div class="w-full h-0.75 mx-4 rounded-lg bg-slate-300"></div>
          </div>
          <div class="mt-2 mr-4">
            <h6 class="text-sm font-semibold text-slate-900">Checkout</h6>
          </div>
        </div>
        <div>
          <div class="flex items-center">
            <div class="w-8 h-8 shrink-0 -mx-px bg-slate-300 p-1.5 flex items-center justify-center rounded-full">
              <span class="text-sm text-white font-semibold">3</span>
            </div>
          </div>
          <div class="mt-2">
            <h6 class="text-sm font-semibold text-slate-400">Order</h6>
          </div>
        </div>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8 lg:gap-x-12">
        <div class="lg:col-span-2">
          <form>
            <div>
              <h2 class="text-xl text-slate-900 font-semibold mb-6">Delivery Details</h2>
              <div class="grid lg:grid-cols-2 gap-y-6 gap-x-4">
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">First Name</label>
                  <input type="text" placeholder="Enter First Name" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Last Name</label>
                  <input type="text" placeholder="Enter Last Name" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Email</label>
                  <input type="email" placeholder="Enter Email" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Phone No.</label>
                  <input type="number" placeholder="Enter Phone No." class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Address Line</label>
                  <input type="text" placeholder="Enter Address Line" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">City</label>
                  <input type="text" placeholder="Enter City" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">State</label>
                  <input type="text" placeholder="Enter State" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
                <div>
                  <label class="text-sm text-slate-900 font-medium block mb-2">Zip Code</label>
                  <input type="text" placeholder="Enter Zip Code" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                </div>
              </div>
            </div>

            <div class="mt-12">
              <h2 class="text-xl text-slate-900 font-semibold mb-6">Payment</h2>
              <div class="grid gap-4 lg:grid-cols-2">
                <div class="bg-gray-100 p-4 rounded-md border border-gray-300 max-w-sm">
                  <div>
                    <div class="flex items-center">
                      <input type="radio" name="method" class="w-5 h-5 cursor-pointer" id="card" checked />
                      <label for="card" class="ml-4 flex gap-2 cursor-pointer">
                        <img src="https://readymadeui.com/images/visa.webp" class="w-12" alt="card1" />
                        <img src="https://readymadeui.com/images/american-express.webp" class="w-12" alt="card2" />
                        <img src="https://readymadeui.com/images/master.webp" class="w-12" alt="card3" />
                      </label>
                    </div>
                  </div>
                  <p class="mt-4 text-sm text-slate-500 font-medium">Pay with your debit or credit card</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-md border border-gray-300 max-w-sm">
                  <div>
                    <div class="flex items-center">
                      <input type="radio" name="method" class="w-5 h-5 cursor-pointer" id="paypal" />
                      <label for="paypal" class="ml-4 flex gap-2 cursor-pointer">
                        <img src="https://readymadeui.com/images/paypal.webp" class="w-20" alt="paypalCard" />
                      </label>
                    </div>
                  </div>
                  <p class="mt-4 text-sm text-slate-500 font-medium">Pay with your paypal account</p>
                </div>
              </div>
            </div>

            <div class="mt-12 max-w-md">
              <p class="text-slate-900 text-sm font-medium mb-2">Do you have a promo code?</p>
              <div class="flex gap-4">
                <input type="email" placeholder="Promo code" class="px-4 py-2.5 bg-white border border-gray-400 text-slate-900 w-full text-sm rounded-md focus:outline-blue-600" />
                <button type="button" class="flex items-center justify-center font-medium tracking-wide bg-blue-600 hover:bg-blue-700 px-4 py-2.5 rounded-md text-sm text-white cursor-pointer">
                  Apply
                </button>
              </div>
            </div>
          </form>
        </div>

        <div class="relative">
          <h2 class="text-xl text-slate-900 font-semibold mb-6">Order Summary</h2>
          <ul class="text-slate-500 font-medium space-y-4">
            <li class="flex flex-wrap gap-4 text-sm">Subtotal <span class="ml-auto font-semibold text-slate-900">Rp72.00</span></li>
            <li class="flex flex-wrap gap-4 text-sm">Discount <span class="ml-auto font-semibold text-slate-900">Rp0.00</span></li>
            <li class="flex flex-wrap gap-4 text-sm">Shipping <span class="ml-auto font-semibold text-slate-900">Rp6.00</span></li>
            <li class="flex flex-wrap gap-4 text-sm">Tax <span class="ml-auto font-semibold text-slate-900">Rp5.00</span></li>
            <hr class="border-slate-300" />
            <li class="flex flex-wrap gap-4 text-[15px] font-semibold text-slate-900">Total <span class="ml-auto">Rp83.00</span></li>
          </ul>
          <div class="space-y-4 mt-8">
            <router-link to="/order-summary" class="block rounded-md px-4 py-2.5 w-full text-sm font-medium tracking-wide bg-blue-600 hover:bg-blue-700 text-white cursor-pointer text-center">
              Complete Purchase
            </router-link>
            <router-link to="/cart" class="block rounded-md px-4 py-2.5 w-full text-sm font-medium tracking-wide bg-gray-100 hover:bg-gray-200 border border-gray-300 text-slate-900 cursor-pointer text-center">
              Continue Shopping
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
