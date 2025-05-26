<template>
  <form class="register-content" @submit.prevent="register">
    <h1>Yuk Buat Akun Di Sini</h1>
    <div>
        <h4>Nama Pengguna</h4>
        <input v-model="form.name" class="username-input" type="text" placeholder="Buat nama pengguna Anda" maxlength="30" size="30">
    </div>
    <div>
        <h4>Surel</h4>
        <input v-model="form.email" class="email-input" type="email" placeholder="Tulis surel Anda" maxlength="30" size="30">
    </div>
    <div>
        <h4>Kata Sandi</h4>
        <div class="password-input">
          <input :class="{'invalid': errors.password}" v-model="form.password" :type="showPassword ? 'text' : 'password'" placeholder="Buat kata sandi Anda" maxlength="25">
          <span @click="togglePassword" class="toggle-password">{{ showPassword ? '🙈' : '👁️'}}</span>
        </div>
    </div>
    <button class="signup-signup" type="submit">Buat akun</button>
    <p>
      <router-link to="/Login">Sudah punya akun? Masuk di sini</router-link>
    </p>
  </form>
</template>

<script>
import axios from 'axios';

export default {
  data(){
    return{
      form: {
        name: '',
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async register() {
      try {
        const res = await axios.post('http://localhost:8000/api/register', this.form)
        alert('Pendaftaran Berhasil! Silakan Masuk ke Akun Anda.')
        this.$router.push('/Login');
      } catch (error) {
        console.error('Error during registration:', error);
        alert('Pendaftaran Gagal! Silakan coba lagi.');
      }
    }
  }
}
</script>

<style>
.register-content{
  display: flex;
  flex-direction: column;
  gap: 5rem;
}

.username-input, .email-input, .password-input{
  width: 500px;
  height: 50px;
  border: 1px black solid;
  border-radius: 20px;
  text-align: center;
}

.signup-signup{
  width: 300px;
  margin-left: auto;
  margin-right: auto;
  background: #800000;
  color: white;
}
</style>