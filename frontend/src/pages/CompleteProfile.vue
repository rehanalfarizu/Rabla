<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// Ambil data user yang sudah tersimpan saat register
const authUser = JSON.parse(localStorage.getItem('auth_user') || '{}')

const fullName = ref(authUser.name || '')
const phone = ref('')
const address = ref('')
const city = ref('')
const province = ref('')
const postalCode = ref('')
const gender = ref('')
const birthDate = ref('')

const errorMsg = ref('')
const isLoading = ref(false)

// Jika belum login sama sekali, redirect ke register
onMounted(() => {
  if (!localStorage.getItem('auth_token')) {
    router.push('/register')
  }
})

const handleSubmit = async (e) => {
  e.preventDefault()
  errorMsg.value = ''

  if (!phone.value || !address.value || !city.value || !province.value || !postalCode.value) {
    errorMsg.value = 'Harap lengkapi semua field yang wajib diisi.'
    return
  }

  isLoading.value = true
  try {
    // Gabungkan data profil dengan data user yang sudah ada
    const updatedUser = {
      ...authUser,
      name: fullName.value,
      phone: phone.value,
      address: address.value,
      city: city.value,
      province: province.value,
      postalCode: postalCode.value,
      gender: gender.value,
      birthDate: birthDate.value,
      profileCompleted: true,
    }

    // Simpan kembali ke localStorage dalam format JSON (sesi saat ini)
    localStorage.setItem('auth_user', JSON.stringify(updatedUser))

    // Simpan permanen ke database lokal berdasarkan email agar tidak hilang saat logout
    const allProfiles = JSON.parse(localStorage.getItem('user_profiles') || '{}')
    allProfiles[updatedUser.email] = updatedUser
    localStorage.setItem('user_profiles', JSON.stringify(allProfiles))

    router.push('/')
  } catch (err) {
    errorMsg.value = 'Gagal menyimpan profil. Silakan coba lagi.'
    console.error(err)
  } finally {
    isLoading.value = false
  }
}

const handleSkip = () => {
  // Tandai profil belum lengkap, tapi tetap bisa lanjut
  const updatedUser = { ...authUser, profileCompleted: false }
  localStorage.setItem('auth_user', JSON.stringify(updatedUser))
  router.push('/')
}
</script>

<template>
  <main class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 px-4 py-16 md:px-8">
    <div class="mx-auto max-w-2xl">

      <!-- Header -->
      <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-600 shadow-lg shadow-blue-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 fill-white" viewBox="0 0 512 512" aria-hidden="true">
            <path d="M253.414 103.434c48.556 0 87.919 40.52 87.919 90.505s-39.363 90.505-87.919 90.505-87.919-40.521-87.919-90.505 39.363-90.505 87.919-90.505m0 36.202c-28.324 0-51.717 24.081-51.717 54.303s23.393 54.303 51.717 54.303 51.717-24.081 51.717-54.303-23.393-54.303-51.717-54.303" />
            <path d="M253.414 0c139.957 0 253.414 113.457 253.414 253.414 0 94.285-51.491 176.544-127.886 220.19-35.728 20.575-77.036 32.582-121.104 33.199l-4.423.025C113.457 506.828 0 393.371 0 253.414S113.457 0 253.414 0m-23.676 346.505c-46.331 0-87.479 29.378-102.607 73.008l-2.339 7.571c35.919 27.232 80.165 42.893 126.504 43.522l5.709-.009c38.24-.62 74.079-11.122 105.072-29.064l19.977-13.243-2.237-6.866c-14.371-44.046-55.062-74.052-101.239-74.901zm23.676-310.303c-119.963 0-217.212 97.249-217.212 217.212 0 57.493 22.337 109.77 58.807 148.624 21.668-55.072 74.965-91.735 134.73-91.735h46.831c59.905 0 113.311 36.835 134.885 92.121 36.686-38.892 59.172-91.325 59.172-149.01-.001-119.963-97.25-217.212-217.213-217.212" />
          </svg>
        </div>
        <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Lengkapi Profil Kamu</h1>
        <p class="mt-2 text-slate-500">
          Isi data di bawah agar pengalaman belanja kamu lebih mudah dan cepat.
        </p>
      </div>

      <!-- Card -->
      <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        <form @submit="handleSubmit" class="space-y-6">

          <!-- Nama Lengkap -->
          <div>
            <label for="fullName" class="mb-1.5 block text-sm font-medium text-slate-700">
              Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <input
              v-model="fullName"
              id="fullName"
              type="text"
              placeholder="Masukkan nama lengkap"
              required
              class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
            />
          </div>

          <!-- No. Telepon & Jenis Kelamin -->
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label for="phone" class="mb-1.5 block text-sm font-medium text-slate-700">
                No. Telepon <span class="text-red-500">*</span>
              </label>
              <input
                v-model="phone"
                id="phone"
                type="tel"
                placeholder="08xxxxxxxxxx"
                required
                class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
              />
            </div>
            <div>
              <label for="gender" class="mb-1.5 block text-sm font-medium text-slate-700">Jenis Kelamin</label>
              <select
                v-model="gender"
                id="gender"
                class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
              >
                <option value="" disabled>Pilih jenis kelamin</option>
                <option value="male">Laki-laki</option>
                <option value="female">Perempuan</option>
              </select>
            </div>
          </div>

          <!-- Tanggal Lahir -->
          <div>
            <label for="birthDate" class="mb-1.5 block text-sm font-medium text-slate-700">Tanggal Lahir</label>
            <input
              v-model="birthDate"
              id="birthDate"
              type="date"
              class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
            />
          </div>

          <!-- Divider -->
          <div class="relative">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
            <div class="relative flex justify-center">
              <span class="bg-white px-3 text-xs font-medium text-slate-400 uppercase tracking-wider">Alamat Pengiriman</span>
            </div>
          </div>

          <!-- Alamat -->
          <div>
            <label for="address" class="mb-1.5 block text-sm font-medium text-slate-700">
              Alamat Lengkap <span class="text-red-500">*</span>
            </label>
            <textarea
              v-model="address"
              id="address"
              rows="3"
              placeholder="Jl. Contoh No. 123, RT/RW, Kelurahan, Kecamatan"
              required
              class="w-full resize-none rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
            ></textarea>
          </div>

          <!-- Kota & Provinsi -->
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label for="city" class="mb-1.5 block text-sm font-medium text-slate-700">
                Kota / Kabupaten <span class="text-red-500">*</span>
              </label>
              <input
                v-model="city"
                id="city"
                type="text"
                placeholder="Contoh: Bandung"
                required
                class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
              />
            </div>
            <div>
              <label for="province" class="mb-1.5 block text-sm font-medium text-slate-700">
                Provinsi <span class="text-red-500">*</span>
              </label>
              <select
                v-model="province"
                id="province"
                required
                class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
              >
                <option value="" disabled>Pilih provinsi</option>
                <option>Aceh</option>
                <option>Bali</option>
                <option>Banten</option>
                <option>Bengkulu</option>
                <option>DI Yogyakarta</option>
                <option>DKI Jakarta</option>
                <option>Gorontalo</option>
                <option>Jambi</option>
                <option>Jawa Barat</option>
                <option>Jawa Tengah</option>
                <option>Jawa Timur</option>
                <option>Kalimantan Barat</option>
                <option>Kalimantan Selatan</option>
                <option>Kalimantan Tengah</option>
                <option>Kalimantan Timur</option>
                <option>Kalimantan Utara</option>
                <option>Kepulauan Bangka Belitung</option>
                <option>Kepulauan Riau</option>
                <option>Lampung</option>
                <option>Maluku</option>
                <option>Maluku Utara</option>
                <option>Nusa Tenggara Barat</option>
                <option>Nusa Tenggara Timur</option>
                <option>Papua</option>
                <option>Papua Barat</option>
                <option>Riau</option>
                <option>Sulawesi Barat</option>
                <option>Sulawesi Selatan</option>
                <option>Sulawesi Tengah</option>
                <option>Sulawesi Tenggara</option>
                <option>Sulawesi Utara</option>
                <option>Sumatera Barat</option>
                <option>Sumatera Selatan</option>
                <option>Sumatera Utara</option>
              </select>
            </div>
          </div>

          <!-- Kode Pos -->
          <div>
            <label for="postalCode" class="mb-1.5 block text-sm font-medium text-slate-700">
              Kode Pos <span class="text-red-500">*</span>
            </label>
            <input
              v-model="postalCode"
              id="postalCode"
              type="text"
              maxlength="5"
              placeholder="Contoh: 40123"
              required
              class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100"
            />
          </div>

          <!-- Error Message -->
          <p v-if="errorMsg" class="rounded-lg bg-red-50 px-4 py-3 text-sm text-red-600 border border-red-200">
            {{ errorMsg }}
          </p>

          <!-- Actions -->
          <div class="flex flex-col gap-3 pt-2 sm:flex-row">
            <button
              type="submit"
              :disabled="isLoading"
              class="flex-1 rounded-lg border border-blue-600 bg-blue-600 px-5 py-2.5 text-sm font-semibold tracking-wide text-white transition-all hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 disabled:cursor-not-allowed disabled:opacity-60"
            >
              <span v-if="isLoading">Menyimpan...</span>
              <span v-else>Simpan & Lanjutkan</span>
            </button>
            <button
              type="button"
              @click="handleSkip"
              class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition-all hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-400"
            >
              Lewati untuk sekarang
            </button>
          </div>

        </form>
      </div>

      <!-- Step indicator -->
      <div class="mt-6 flex items-center justify-center gap-2">
        <span class="h-2 w-8 rounded-full bg-blue-600"></span>
        <span class="h-2 w-8 rounded-full bg-blue-600"></span>
        <span class="h-2 w-2 rounded-full bg-slate-300"></span>
      </div>
      <p class="mt-2 text-center text-xs text-slate-400">Langkah 2 dari 3 — Lengkapi data diri</p>
    </div>
  </main>
</template>
