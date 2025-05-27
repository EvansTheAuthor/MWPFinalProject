<template>
  <form class="register-content" @submit.prevent="register">
    <h1>Yuk Buat Akun Di Sini</h1>

    <div>
        <h4>Nama Pengguna</h4>
        <input v-model="form.name" class="username-input" type="text" placeholder="Buat nama pengguna Anda" maxlength="30" size="30" autocomplete="off" />
    </div>
    
    <div>
        <h4>Surel</h4>
        <input v-model="form.email" class="email-input" type="email" placeholder="Tulis surel Anda" maxlength="30" size="30" autocomplete="off" />
    </div>

    <div>
        <h4>Kata Sandi</h4>
        <div class="password-input">
          <input :class="{'invalid': errors.password}" v-model="form.password" :type="showPassword ? 'text' : 'password'" placeholder="Buat kata sandi Anda" maxlength="25" autocomplete="off"/>
          <span @click="togglePassword" class="toggle-password"> {{ showPassword ? '🙈' : '👁️'}} </span>
        </div>
    </div>

    <button class="signup-signup" type="submit" :disabled="loading">
      {{ loading ? 'Mendaftar...' : 'Buat Akun' }}
    </button>
    
    <p>
      <router-link to="/Login">Sudah punya akun? Masuk di sini</router-link>
    </p>

    <!-- Notifikasi -->
    <transition name="fade">
      <div v-if="notif.message" class="toast" :class="notif.type">{{ notif.message }}</div>
    </transition>
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
      },
      errors: {
        password: false
      },
      showPassword: false,
      notif: {
        message: "",
        type: ""
      },
      loading: false
    };
  },
  methods: {
    togglePassword() {
      this.showPassword = !this.showPassword;
    },
    showNotif(message, type= "error") {
      this.notif.message = message;
      this.notif.type = type;
      setTimeout(() => {
        this.notif.message = '';
      }, 3000);
    },
    async register() {
      if (!this.form.name.trim()) {
          this.showNotif("Nama pengguna tidak boleh kosong!");
          return;
        }

        if (!/^[a-zA-Z0-9_]+$/.test(this.form.name)) {
          this.showNotif("Nama pengguna hanya boleh mengandung huruf dan angka!");
          return;
        }

        if (!this.form.email.trim()) {
          this.showNotif("Surel tidak boleh kosong!");
          return;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
          this.showNotif("Format surel tidak valid!");
          return;
        }

        if (!this.form.password.trim()) {
          this.showNotif("Kata sandi tidak boleh kosong!");
          return;
        }

        if (this.form.password.length < 8) {
          this.errors.password = true;
          this.showNotif("Kata sandi harus minimal 8 karakter!");
          return;
        }
      
      try {
        this.loading = true;
        const res = await axios.post('http://localhost:8000/api/register', this.form)
        this.showNotif('Pendaftaran Berhasil!', 'success');

        setTimeout(() => {
          this.$router.push('/Login');
        }, 1000);
      } catch (error) {
        console.error('Error during registration:', error);
        this.showNotif('Pendaftaran Gagal! Silakan coba lagi.');
      }finally {
        this.loading = false;
      }
    }
  },
  watch: {
    'form.password': function(newValue) {
      if (!newValue ||  newValue.length >= 8) {
        this.errors.password = false;
      }
    }
  }
}
</script>

<style scoped>
.register-content{
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.username-input, .email-input, .password-input{
  width: 500px;
  height: 50px;
  border: 1px black solid;
  border-radius: 20px;
  text-align: center;
}

.password-input {
  display: flex;
  align-items: center;
  position: relative;
}

.toggle-password {
  position: absolute;
  right: 15px;
  cursor: pointer;
}

.invalid {
  border: 2px solid red;
}

.signup-signup{
  width: 300px;
  margin-left: auto;
  margin-right: auto;
  background: #800000;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 15px;
  cursor: pointer;
}

.signup-signup:disabled {
  background-color: #999;
  cursor: not-allowed;
}

.toast{
  text-align: center;
  padding: 10px;
  margin-top: 20px;
  border-radius: 10px;
  font-weight: bold;
}

.toast.success {
  background-color: #4CAF50;
  color: #155724;
}

.toast.error {
  background-color: #f44336;
  color: #721c24;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>