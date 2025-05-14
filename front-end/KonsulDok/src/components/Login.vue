<template>
  <form class="login-content">
    <h1>Selamat Datang</h1>
    <div>
        <h4>Nama Pengguna</h4>
        <input class="username-input" type="text" placeholder="Buat nama pengguna Anda" maxlength="30" size="30">
    </div>
    <div>
        <h4>Kata Sandi</h4>
        <input class="password-input" type="password" placeholder="Buat kata sandi Anda" max="12" maxlength="25">
    </div>
    <button class="login-login" @click="loggedIn">Masuk</button>
    <p>
      <router-link to="/SignUp">Belum punya akun? Buat dulu</router-link>
    </p>
  </form>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter()

function loggedIn() {
  router.push('/Main')
}
</script>

<style>
.login-content{
  display: flex;
  flex-direction: column;
  gap: 5rem;
}

.username-input, .password-input{
  width: 500px;
  height: 50px;
  border: 1px black solid;
  border-radius: 20px;
  text-align: center;
}

.login-login{
  width: 300px;
  margin-left: auto;
  margin-right: auto;
  background: #800000;
  color: white;
}
</style>