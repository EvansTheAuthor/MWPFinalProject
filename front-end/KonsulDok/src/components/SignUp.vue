<template>
  <form class="login-content">
    <h1>Yuk Buat Akun Di Sini</h1>
    <div>
        <h4>Nama Pengguna</h4>
        <input class="username-input" type="text" placeholder="Buat nama pengguna Anda" maxlength="30" size="30">
    </div>
    <div>
        <h4>Surel</h4>
        <input class="email-input" type="text" placeholder="Tulis surel Anda" maxlength="30" size="30">
    </div>
    <div>
        <h4>Kata Sandi</h4>
        <input class="password-input" type="password" placeholder="Buat kata sandi Anda" max="12" maxlength="25">
    </div>
    <button class="signup-signup" @click="loggedIn">Buat akun</button>
    <p>
      <router-link to="/Login">Sudah punya akun? Masuk di sini</router-link>
    </p>
  </form>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter()

function loggedIn() {
  router.push('/HelloWorld')
}
</script>

<style>
.login-content{
  display: flex;
  flex-direction: column;
  gap: 5rem;
}

.username-input, .email-input, .password-input{
  border: 1px black solid;
  border-radius: 20px;
  text-align: center;
}

.signup-signup{
  background: #800000;
  color: white;
}
</style>