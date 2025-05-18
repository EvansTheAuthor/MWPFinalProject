<template>
  <main class="doc-list-container">
    <h1>Daftar Dokter</h1>
    <div>
        <div class="doc-list">
            <div class="doc-card" v-for="doctor in doctors" :key="doctor.id">
            <img :src="doctor.image" alt="Doctor Image" />
            <h2>{{ doctor.name }}</h2>
            <p>{{ doctor.specialty }}</p>
            <p>{{ doctor.experience }} years of experience</p>
            <p>RS {{ doctor.hospital }}</p>
            <button @click="bookAppointment(doctor.id)">Buat Janji</button>
            </div>
        </div>
    </div>
  </main>
</template>

<script>
export default {
    data() {
        return {
            doctors: [
                {
                    id: 1,
                    name: 'Dr. John Doe',
                    specialty: 'Sp. Paru',
                    experience: 10,
                    hospital: 'RSU A',
                    image: 'doctor1.jpg'
                },
                {
                    id: 2,
                    name: 'Dr. Jane Smith',
                    specialty: 'Sp. Jantung',
                    experience: 8,
                    hospital: 'RSU B',
                    image: 'doctor2.jpg'
                },
                {
                    id: 3,
                    name: 'Dr. Emily Johnson',
                    specialty: 'Sp. Saraf',
                    experience: 12,
                    hospital: 'RSU C',
                    image: 'doctor3.jpg'
                }
            ]
        }
    },
    methods: {
        bookAppointment(doctorId) {
            console.log(`Booking appointment for doctor with ID: ${doctorId}`);
        }
    }
  }
</script>

<style>

</style>