<template>
  <main class="profile-component grid">
    <h1 class="profile-title m-5">Profil Akun</h1>
    <div class="profile-card border-2 m-2 w-3xl flex">
      <div class="profile-photo border-r-2 p-2 object-center">
        <h2 class="text-2xl">Foto Profil</h2>
        <img class="h-30 w-30" src="../assets/profile-default-svgrepo-com.svg">
      </div>
      <div class="text-left p-2">
        <h5>Nama Pengguna:</h5><h5>User</h5>
        <br>
        <h5>Domisili:</h5><h5>Dom</h5>
        <br>
        <h5>Nomor Telepon:</h5><h5></h5>
        <br>
        <h5>Email:</h5><h5>email</h5>
        <br>
        <h5>Tanggal Lahir:</h5><dd-mm-yyyy>01-01-2001</dd-mm-yyyy>
        <br>
        <h5>Jenis Kelamin:</h5><h5>gender</h5>
        <br>
        <h5>Riwayat Penyakit:</h5><h5>diseases</h5>
        <br>
        <h5>Riwayat Alergi:</h5><h5>allergies</h5>
        <br>
      </div>
    </div>
    <a href="/EditProfile">Edit Profil</a>
  </main>
</template>

<script>
export default {

}
</script>

<style>
.profile-title{
  color: #800000;
}
</style>