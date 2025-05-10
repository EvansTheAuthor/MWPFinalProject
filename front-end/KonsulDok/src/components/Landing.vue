<template>
  <div class="landing-component">
    <h1>Selamat datang di KonsulDok!</h1>
    <h4>Masuk dulu yuk ke akunmu untuk mengakses seluruh fitur dan manfaat dari KonsulDok.</h4>
    <button class="landing-login" @click="goToLogin">Masuk</button>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter()

function goToLogin() {
  router.push('/Login')
}
</script>

<style>
.landing-component{
  display: flex;
  flex-direction: column;
  gap: 5rem;
}

.landing-login{
  width: 300px;
  margin-left: auto;
  margin-right: auto;
  background: #800000;
  color: white;
}
</style>