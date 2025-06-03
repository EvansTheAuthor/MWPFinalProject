<template>
  <main class="doc-list-container p-8">
    <h1>Daftar Dokter</h1>
    <div class="doc-list flex gap-4 flex-wrap justify-center">
      <div
      v-for="doctor in doctors"
      :key="doctor.id"
      class="doc-card w-64 p-4 bg-white rounded-2x1 shadow-md flex flex-col items-center text-center hover:shadow-lg transition-shadow">
        <img
        :src="doctor.image"
        alt="Doctor Image"
        class="w-24 h-24 object-cover rounded-full mb-2"
        @error="handleImageError" />
        <h2 class="text-lg font-semibold">{{ doctor.name }}</h2>
        <p class="text-sm text-gray-600">{{ doctor.specialty }}</p>
        <p class="text-sm text-gray-600">{{ doctor.hospital }}</p>
        <p class="text-sm text-gray-600">{{ doctor.city }}</p>
        <button
        class="doclist-appoint"
        @click="bookAppointment(doctor.id)">Buat Janji</button>
      </div>

      <div class="flex justify-center gap-4 mt-8">
        <button @click="prevPage" :disabled="page === 1">Sebelumnya</button>
        <span class="self-center font-semibold">Halaman {{ page }}</span>
        <button @click="nextPage" :disabled="!hasMore">Berikutnya</button>
      </div>
    </div>

    <div class="flex justify-center gap-4 mt-6">
      <button @click="prevPage" :disabled="page === 1">Sebelumnya</button>
      <span>Halaman {{ page }}</span>
      <button @click="nextPage" :disabled="!hasMore">Berikutnya</button>
    </div>

    <div v-if="loading" class="text-center mt-4 text-blue-600 font-medium">
        Memuat data dokter...
    </div>
  </main>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import { getDoctorsByCategory } from '@/services/Doctor.js'

const route = useRoute()
const doctors = ref([])
const page = ref(1)
const hasMore = ref(true)
const loading = ref(false)
const slug = ref(route.params.slug)

function fetchDoctors(){
    loading.value = true
    const res = await getDoctorsByCategory(slug.value, page.value)
    if(page.value === 1){
        doctors.value = res.data
    } else {
        doctors.value = [...doctors.value, ...res.doctors]
    }
    hasMore.value = res.hasMore
    loading.value = false
}

function nextPage(){
    if(hasMore.value){
        page.value++
        fetchDoctors()
    }
}

function prevPage(){
    if(page.value > 1){
        page.value--
        fetchDoctors()
    }
}

function bookAppointment(id){
    console.log(`Buat janji dengan dokter ID: ${id}`)
}

function handleImageError(e){
    e.target.src='/default-doctor.jpg'
}

watch(() => route.params.slug, (newSlug) => {
    slug.value=newSlug
    page.value=1
    fetchDoctors()
})

onMounted(fetchDoctors)
</script>

<style scoped>
.doclist-appoint{
    width: 300px;
    margin-left: auto;
    margin-right: auto;
    background: #800000;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 15px;
    cursor: pointer;
}
</style>