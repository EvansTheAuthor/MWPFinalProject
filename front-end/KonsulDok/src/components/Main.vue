<template>
  <form class="main-component grid">
    <h1 class="welcome-main mb-25">Selamat datang kembali, user!</h1>
    <div class="button-main flex justify-center">
        <button class="profile-main m-5 h-40 w-40" @click="toProfile">Profil Akun</button>
        <button class="order-main m-5 h-40 w-40">Pesan Layanan</button>
    </div>
  </form>
</template>

<script>
import { useRouter } from 'vue-router';

const router = useRouter()

function toProfile() {
    router.push('/Profile')
}

function toOrder() {
    router.push()
}
</script>

<style>
.welcome-main{
    color: #800000;
}

.profile-main{
    border: 3px #800000 solid;
    color: #800000;
}

.order-main{
    background-color: #800000;
    color: #fff;
}
</style>