<template>
  <form class="main-component grid">
    <h1 class="welcome-main mb-25">Selamat datang kembali, user!</h1>
    <div class="button-main flex justify-center">
        <button class="profile-main main-btn" @click="toProfile">Profil Akun</button>
        <button class="order-main main-btn" @click="toDocCategory">Pesan Layanan</button>
        <button class="list-main main-btn" @click="toAppointmentList">Daftar Janji Terjadwal</button>
        <button class="logout-main main-btn" @click="logout">Keluar</button>
    </div>
    <a href="/PrivacyPolicy" class="policy-link">Kebijakan Layanan</a>
  </form>
</template>

<script setup>
import { useRouter } from 'vue-router'
import User from '@/services/User'

const router = useRouter()

function toProfile() {
    router.push('/Profile')
}

function toDocCategory() {
    router.push('/DocCategory')
    
}

async function logout() {
    const result = await User.logout();
    router.push('/Login');
    alert(result.message);
}
</script>

<style>
.welcome-main{
    color: #800000;
    font-size: 2rem;
    margin-bottom: 2.5rem;
    text-align: center;
}

.button-main{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 2.5rem;
}

.main-btn{
    min-width: 12rem;
    min-height: 12rem;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 1rem;
    margin:0.5rem;
    padding: 1em 2em;
    border: 0.2rem solid #800000;
    cursor: pointer;
    transition: background-color 0.2s, color 0.2s, border 0.2s;
}

.profile-main, .list-main
{
    color: #800000;
}

.profile-main:hover, .list-main:hover{
    background: #f3e5e5;
}

.order-main, .logout-main
{
    background-color: #800000;
    color: #fff;
    border: 0.2rem solid #800000;
}

.order-main:hover, .logout-main:hover{
    background: #a83232;
    color: #a83232;
}

.policy-link {
    display: block;
    text-align: center;
    margin-top: 2rem;
    color: #800000;
    text-decoration: underline;
    font-size: 1rem;
}
</style>