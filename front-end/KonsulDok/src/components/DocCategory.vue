<template>
    <main class="doc-category-container">
        <h1 class="doc-list-title">Daftar Kategori Dokter</h1>
        <div>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Sp. Paru</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Sp. Jantung</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Sp. Saraf</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Sp. Kulit dan Kelamin</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Sp. Anak</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Dokter Gigi</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Dokter Umum</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Sp. THT</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Sp. Mata</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Sp. Urologi</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Sp. Kandungan dan Kebidanan</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Sp. Jiwa</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Sp. Penyakit Dalam</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Sp. Bedah Umum</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Sp. Gizi Klinik</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Sp. Orthopaedi dan Traumatologi</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Sp. PD Kardiovaskular</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Sp. Anestesiologi</button>
            <button class="doc-category-button-1 h-40 w-40" @click="toDoctorList">Sp. Patologi Klinik</button>
            <button class="doc-category-button-2 h-40 w-40" @click="toDoctorList">Dokter Hewan</button>
        </div>
    </main>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

function toDoctorList() {
    router.push('/DocList')
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