<template>
  <main class="profile-component grid">
    <h1 class="profile-title m-5">Profil Akun</h1>
    <div class="profile-card border-2 m-2 w-3xl flex">
      <div class="profile-photo border-r-2 p-2 object-center">
        <h2 class="text-2xl">Foto Profil</h2>
        <img class="h-30 w-30" src="../assets/profile-default-svgrepo-com.svg">
      </div>
      <div class="text-left p-2">
        <h5>Nama Pengguna:</h5><h5>{{profile.name}}</h5>
        <br>
        <h5>Domisili:</h5><h5>{{profile.domicile}}</h5>
        <br>
        <h5>Nomor Telepon:</h5><h5>{{profile.phone}}</h5>
        <br>
        <h5>Email:</h5><h5>{{profile.email}}</h5>
        <br>
        <h5>Tanggal Lahir:</h5><h5>{{profile.birthdate}}</h5>
        <br>
        <h5>Jenis Kelamin:</h5><h5>{{profile.gender}}</h5>
        <br>
      </div>
    </div>
    <a href="/EditProfile">Edit Profil</a>

    <div v-if="loading">Memuat data profil...</div>
  </main>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import User from './services/User.js';

const profile = ref({
  name: '',
  domicile: '',
  phone: '',
  email: '',
  birthdate: '',
  gender: '',
  photo: ''
});

onMounted(async () => {
  const res = await User.getProfile();
  if (res.success) {
    Object.assign(profile.value, res.profile);

    if (res.user) {
      profile.value.name = res.user.name;
      profile.value.domicile = res.user.domicile;
      profile.value.phone = res.user.phone;
      profile.value.email = res.user.email;
      profile.value.birthdate = res.user.birthdate;
      profile.value.gender = res.user.gender;
      profile.value.photo = res.user.photo;
    }

    console.log('Data profil berhasil dimuat:', profile.value);
  } else {
    console.log('Data profil gagal dimuat:', res.message);
  }
});
</script>

<style>
.profile-component {
  max-width: 48rem;
  margin: 2rem auto;
  padding: 2rem;
  background: #fff;
  border-radius: 1.5rem;
  box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.profile-title {
  color: #800000;
  font-size: 2rem;
  text-align: center;
  margin-bottom: 2rem;
}

.profile-card {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  background: #faf9f9;
  border: 2px solid #800000;
  border-radius: 1rem;
  padding: 2rem;
  margin-bottom: 2rem;
}

.profile-photo {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  min-width: 10rem;
  max-width: 14rem;
  border-right: 2px solid #800000;
  padding-right: 2rem;
}

.profile-photo img {
  width: 8rem;
  height: 8rem;
  object-fit: cover;
  border-radius: 50%;
  border: 2px solid #800000;
  margin-top: 1rem;
}

.text-left {
  flex: 1;
  padding-left: 2rem;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.text-left h5 {
  font-size: 1.1rem;
  margin: 0.25rem 0;
  color: #333;
}

a[href="/EditProfile"] {
  display: inline-block;
  background: #800000;
  color: #fff;
  padding: 0.75em 2em;
  border-radius: 1rem;
  text-decoration: none;
  font-weight: 600;
  margin: 0 auto 1rem auto;
  transition: background 0.2s;
  text-align: center;
}

a[href="/EditProfile"]:hover {
  background: #a83232;
}

@media (max-width: 700px) {
  .profile-card {
    flex-direction: column;
    align-items: center;
    padding: 1rem;
  }
  .profile-photo {
    border-right: none;
    border-bottom: 2px solid #800000;
    padding-right: 0;
    padding-bottom: 1rem;
    max-width: 100%;
  }
  .text-left {
    padding-left: 0;
    padding-top: 1rem;
  }
}
</style>