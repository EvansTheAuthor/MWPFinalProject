<template>
  <form @submit.prevent="submitProfile">
    <h1 class="welcome-main mb-25">Edit Profil</h1>
    <br>
    <div class="form-group">
      <label for="username">
        Nama Pengguna:
        <input
            id="username"
            v-model="form.name"
            :class="{ 'input-error': errors.name }"
            type="text"
            placeholder="Masukkan nama pengguna Anda"
            maxlength="30" size="30" autocomplete="off" />
    </label>
    <label for="domicile">
      Domisili Terkini:
      <input
          id="domicile"
          v-model="form.domicile"
          type="text"
          placeholder="Masukkan domisili terkini Anda"
          maxlength="50"
          size="50"
          autocomplete="off"
      />
    </label>
    <label for="phone">
      Nomor Telepon:
      <input
          id="phone"
          v-model="form.phone"
          type="text"
          placeholder="Masukkan nomor telepon Anda"
          maxlength="15"
          size="15"
          autocomplete="off"
      />
    </label>
    <label for="email">
      Alamat Surel:
      <input
          id="email"
          v-model="form.email"
          :class="{ 'input-error': errors.email }"
          type="email"
          placeholder="Masukkan alamat surel Anda"
          maxlength="50"
          size="50"
          autocomplete="off"
      />
    </label>
    <label for="birthdate">
        Tanggal Lahir:
        <Flatpickr
                v-model="form.appointment_date"
                :config="{ enableTime: true, dateFormat: 'Y-m-d H:i'}"
                placeholder="Pilih tanggal dan waktu"
                required
                />
    </label>
    <label for="gender">
        Jenis Kelamin:
        <select id="gender" v-model="form.gender">
            <option value="" disabled selected>Pilih jenis kelamin</option>
            <option value="male">Laki-laki</option>
            <option value="female">Perempuan</option>
            <option value="other">Tidak ingin menjawab</option>
        </select>
    </label>
    </div>
    <br>
    <button type="submit">Simpan Perubahan</button>
  </form>
</template>

<script setup>
import { ref,onMounted } from 'vue'
import { useRouter } from 'vue-router'
import User from '@/services/User.js'
import Flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

const router = useRouter()

const form = ref({
  name: '',
  domicile: '',
  phone: '',
  email: '',
  birthdate: '',
  gender: ''
})

const errors = ref({
  name: false,
  domicile: false,
  phone: false,
  email: false,
  birthdate: false,
  gender: false
})

onMounted(async ()=> {
    const res = await User.getProfile()
    if (res.success) Object.assign(form.value, res.profile)
    else alert(res.message)
})

async function submitProfile() {
    errors.value = {
        name: false,
        domicile: false,
        phone: false,
        email: false,
        birthdate: false,
        gender: false
    }

    if (!form.email.includes('@')) {
        errors.value.email = true;
        log.message("Email tidak valid", "error");
        return;
      }

    const res = await User.updateProfile(form.value)
    if (res.success) {
        log.message('Profil berhasil diperbarui!', 'success')
        router.push('/Profile')
    } else {
        log.message(`Gagal memperbarui profil: ${res.message}`, 'error')
    }
}
</script>

<style>
.input-error{
  border: 2px solid #b91c1c;
  background: #fff0f0;
}

.cancel-btn, .load-more-btn, button[type="submit"] {
  background: #800000;
  color: #fff;
  border: none;
  border-radius: 0.75rem;
  padding: 0.75em 2em;
  font-size: 1rem;
  cursor: pointer;
  margin-top: 1rem;
}
.cancel-btn:hover, .load-more-btn:hover, button[type="submit"]:hover {
  background: #a83232;
}
</style>