<template>
  <form class="login-content" @submit.prevent="login">
    <h1>Selamat Datang</h1>
    <div>
        <h4>Nama Pengguna</h4>
        <input class="username-input" v-model="form.name" type="text" placeholder="Buat nama pengguna Anda" maxlength="30" size="30">
    </div>
    <div>
        <h4>Kata Sandi</h4>
        <div class="password-wrapper">
          <input class="password-input" :class="{'invalid': errors.password}" v-model="form.password" :type="showPassword ? 'text' : 'password'" placeholder="Buat kata sandi Anda" maxlength="25">
          <span @click="togglePassword" class="toggle-password">{{ showPassword ? '🙈' : '👁️'}}</span>
        </div>
    </div>
    <button class="login-login" type="submit">Masuk</button>
    <p>
      <router-link to="/SignUp">Belum punya akun? Buat dulu</router-link>
    </p>

    <div v-if="notif.message" class="notif" :class="notif.type">{{ notif.message }}</div>
  </form>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        name: '',
        password: ''
      },
      showPassword: false,
      notif: {
        message: '',
        type: ''
      },
      errors:{
        name: false,
        password: false
      }
    }
  },
  methods: {
    async login() {
      this.errors = { name: false, password: false };

        if (!this.form.name || !this.form.password) {
          if (!this.form.name) this.errors.name = true;
          if (!this.form.password) this.errors.password = true;
          this.showNotif('Semua kolom harus diisi!', 'error');
          return;
        }

      try {
        const res = await axios.post('http://localhost:8000/api/login', this.form);
        if (res.data.success) {
          this.showNotif('Login Berhasil!', 'success');
          localStorage.setItem('token', res.data.token);
          this.$router.push('/Dashboard');
        } else {
          this.showNotif('Login Gagal! Periksa nama pengguna dan kata sandi Anda.', 'error');
        }
      } catch (error) {
        console.error('Error during login:', error);
        alert('Login Gagal! Silakan coba lagi.');
      }
    },
    togglePassword() {
      this.showPassword = !this.showPassword;
    },
    showNotif(message, type) {
      this.notif.message = message;
      this.notif.type = type;
      setTimeout(() => {
        this.notif.message = '';
      }, 3000);
    }
  }
}
</script>

<style scoped>
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

.password-wrapper{
  position: relative;
}

.toggle-password{
  position: absolute;
  right: 20px;
  top: 12px;
  cursor: pointer;
  font-size: 20px;
}

.invalid {
  border: 2px solid red;
}

.login-login{
  width: 300px;
  margin: 0 auto;
  background: #800000;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 10px;
  cursor: pointer;
}

.notif{
  width: 100%;
  text-align: center;
  padding: 10px;
  margin-top: 10px;
  border-radius: 5px;
  font-weight: bold;
}

.notif.success {
  background-color: #d4edda;
  color: #155724;
}
.notif.error {
  background-color: #f8d7da;
  color: #721c24;
}
</style>