<template>
    <main class="appoint-doctor-container">
        <h1 class="appoint-title">Buat Janji Temu</h1>
        <div v-if="doctor" class="doctor-info">
            <div><b>Dokter:</b>{{ doctor.name }}</div>
            <div><b>Spesialis:</b>{{ doctor.speciality }}</div>
            <div><b>Rumah Sakit:</b>{{ doctor.hospital }}</div>
        </div>
        <form @submit.prevent="submitAppointment" class="appoint-form">
            <label>
                Tanggal & Waktu Janji:
                <Flatpickr
                v-model="form.appointment_date"
                :config="{ enableTime: true, dateFormat: 'Y-m-d H:i'}"
                placeholder="Pilih tanggal dan waktu"
                required
                />
            </label>
            <label>
                Catatan (opsional):
                <textarea
                    v-model="form.notes"
                    rows="2"
                    placeholder="Tulis catatan yang perlu diperhatikan (opsional)"></textarea>
            </label>
            <button
                type="submit"
                class="appoint-btn"
                :disabled="loading">
            {{ loading ? 'Memproses...' : 'Buat Janji' }}
            </button>
        </form>
    </main>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import Appointment from './services/Appointment.js'
import { getDoctorById } from './services/Doctor.js'
import Flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

const Route = useRoute()
const router = useRouter()
const doctor = ref(null)
const loading = ref(false)
const form = ref({
    appointment_date: '',
    notes: ''
})

onMounted(async () => {
    const res = await getDoctorById(route.params.doctorId)
    doctor.value = res.doctor
})

async function submitAppointment(){
    loading.value = true
    const res = await Appointment.create({
        doctor_id: route.params.doctorId,
        appointment_date: form.value.appointment_date,
        notes: form.value.notes
    })
    loading.value = false
    if (res.success) {
        log.message('Janji temu berhasil dibuat!', 'success')
        router.push('/AppointmentList')
    }else{
        log.message('Gagal membuat janji temu!', 'error')
    }
}
</script>

<style scoped>
.appoint-doctor-container{
    max-width: 32rem;
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.appoint-title{
    color: #800000;
    font-size: 2rem;
    text-align: center;
    margin-bottom: 2rem;
}

.doctor-info{
    background: #faf9f9;
    border: 2px solid #800000;
    border-radius: 1rem;
    padding: 1rem 2rem;
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

.appoint-form{
    display:flex;
    flex-direction: column;
    gap: 1.5rem;
}

.appoint-form label{
    font-weight: 500;
    color:#333;
}

.appoint-form input,
.appoint-form textarea
{
    width: 100%;
    padding: 0.75em 1em;
    border: 1.5px solid #800000;
    border-radius: 0.75rem;
    font-size: 1rem;
    margin-top: 0.5rem;
}

.appoint-btn{
    background: #800000;
    color: white;
    padding: 0.75em 2em;
    border: none;
    border-radius: 1rem;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: background 0.2s;
}

.appoint-btn:disabled{
    background: #ccc;
    color: #888;
    cursor: not-allowed;
}

.appoint-btn:hover:enabled{
    background: #a83232;
}
</style>