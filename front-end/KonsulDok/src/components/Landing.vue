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
  gap: 3rem;
  align-items: center;
  justify-content: center;
  min-height: 60vh;
}

.landing-login{
  width: 18rem;
  margin-left: auto;
  margin-right: auto;
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

.landing-login:hover{
  background: #a83232;
}
</style>