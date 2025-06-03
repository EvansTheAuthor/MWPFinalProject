<template>
    <main class="doc-category-container">
        <h1 class="doc-list-title">Daftar Kategori Dokter</h1>
        <div>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('pulmonologist')">Sp. Paru</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('cardiologist')">Sp. Jantung</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('neurologist')">Sp. Saraf</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('dermato-venereologist')">Sp. Kulit dan Kelamin</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('pediatrician')">Sp. Anak</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('dokter-gigi')">Dokter Gigi</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('dokter-umum')">Dokter Umum</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('ear-nose-andthroat')">Sp. THT</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('ophthalmologist')">Sp. Mata</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('urologist')">Sp. Urologi</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('obstetrics-and-gynecologist')">Sp. Kandungan dan Kebidanan</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('psychiatrist')">Sp. Jiwa</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('internist')">Sp. Penyakit Dalam</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('general-surgeon')">Sp. Bedah Umum</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('clinical-nutritionist')">Sp. Gizi Klinik</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('orthopedic-trauma-surgeon')">Sp. Orthopaedi dan Traumatologi</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('cardiovascular-physician')">Sp. PD Kardiovaskular</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('anesthesiologist')">Sp. Anestesiologi</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList('clinical-pathologist')">Sp. Patologi Klinik</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList('midwife')">Bidan</button>
        </div>
    </main>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

function toDoctorList(slug) {
    router.push(`/DoctorList/${slug}`)
}
</script>

<style>
.doc-list-title{
    color: #800000;
    text-align: center;
    margin-top: 5rem;
}

.doc-category-button-1 {
    margin: 5rem;
    border: 3px solid #800000;
    border-radius: 10px;
    padding: 10px 20px;
    background-color: white;
    color: #800000;
    font-weight: bold;
}

.doc-category-button-2 {
    margin: 5rem;
    border: 3px solid #800000;
    border-radius: 10px;
    padding: 10px 20px;
    background-color: #800000;
    color: white;
    font-weight: bold;
}
</style>