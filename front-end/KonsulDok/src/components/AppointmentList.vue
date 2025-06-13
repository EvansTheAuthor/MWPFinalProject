<template>
    <main class="appointment-list p-8">
        <h1 class="appointment-list-title">Daftar Janji Temu</h1>
        <div v-if="loading">Memuat data janji temu terjadwal...</div>
        <div v-else>
            <div v-if="appointments.length === 0">Belum ada janji temu</div>
            <div
                v-for="appt in appointments"
                :key="appt.id"
                class="appointment-card border p-4 mb-4 rounded">
            <div><b>Dokter:</b> {{ appt.doctor?.name || '-' }}</div>
            <div><b>Spesialis:</b> {{ appt.doctor?.speciality || '-' }}</div>
            <div><b>Rumah Sakit:</b> {{ appt.doctor?.hospital || '-' }}</div>
            <div><b>Tanggal:</b> {{ appt.date || '-' }}</div>
            <div><b>Status:</b> {{ statusLabel(appt.status) }}</div>
            <div><b>Catatan:</b> {{ appt.notes || '-' }}</div>
            <button
                v-if="canCancel(appt)"
                @click="cancelAppointment(appt.id)"
                class="cancel-btn">
                Batalkan
            </button>
        </div>
        <button
            v-if="hasMore && !loading"
            @click="loadMore"
            class="load-more-btn"
        >
            Muat Lebih Banyak</button>
        </div>
    </main>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Appointment from '@/services/Appointment.js'

const appointments = ref([])
const loading = ref(true)
const hasMore = ref(true)
const limit = 10

async function fetchAppointments(reset = false){
    loading.value = true
    const res = await Appointment.getAll(page.value, limit)
    if (reset) {
        appointments.value = res.appointments || []
    } else {
        appointments.value.push(...(res.appointments || []))
    }
    hasMore.value = res.hasMore
    loading.value = false
}

onMounted(async () => fetchAppointments(true))

function loadMore() {
    if (hasMore.value) {
        page.value++
        fetchAppointments()
    }
}

function statusLabel(status){
    if (status == 'pending') return 'Menunggu Antrian';
    if (status == 'cancelled') return 'Dibatalkan';
    if (status == 'confirmed') return 'Dikonfirmasi';
    return status;	
}

function canCancel(appt) {
    if (appt.status !== 'pending') return false;

    const today = new Date()
    const apptDate = new Date(appt.appointment_date)
    const diff = (apptDate - today) / (1000 * 60 * 60 * 24)
    return diff >= 3
}

async function cancelAppointment(id) {
    if(!confirm('Yakin ingin membatalkan janji temu ini?')) return
    const res = await Appointment.cancel(id)
    if (res.success) {
        log.message('Janji berhasil dibatalkan!', 'success')
        // Refresh list pakai fetchAppointments lagi
        page.value = 1
        fetchAppointments(true)
    } else {
        log.message('Gagal membatalkan janji temu')
    }
}
</script>

<style scoped>
.appointment-list-title{
    color: #800000;
    font-size: 2rem;
    margin-bottom: 1.5rem;
}

.cancel-btn{
    background: #800000;
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 0.75em 2em;
    margin-top: 0.5rem;
    cursor: pointer;
    font-size: 1rem;
}

.load-more-btn{
    background: #800000;
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 0.75em 2em;
    margin: 1rem auto;
    display: block;
    cursor: pointer;
    font-size: 1rem;
}
</style>