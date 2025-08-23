<template>
  <form class="login-content" @submit.prevent="loginUser">
    <h1>Selamat Datang</h1>
    
    <div>
        <h4>Nama Pengguna</h4>
        <input
          class="username-input"
          v-model="form.name"
          type="text"
          placeholder="Nama Pengguna"
          required
          autocomplete="off">
    </div>
    
    <div>
        <h4>Kata Sandi</h4>
        <div class="password-wrapper">
          <input
            class="password-input"
            :class="{'invalid': errors.password}"
            v-model="form.password"
            :type="showPassword ? 'text' : 'password'"
            placeholder="Kata Sandi"
            required>
          <span
            @click="togglePassword"
            class="toggle-password">
            {{ showPassword ? '🙈' : '👁️'}}
          </span>
        </div>
    </div>

    <button class="login-login" type="submit" :disabled="loading">Masuk</button>
    
    <p>
      <router-link to="/SignUp">Belum punya akun? Buat dulu</router-link>
    </p>

    <transition name="fade">
      <div v-if="notif.message" class="toast" :class="notif.type">{{ notif.message }}</div>
    </transition>
  </form>
</template>

<script>
import User from './services/User.js';

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
    async loginUser() {
      this.errors = { name: false, password: false };
      this.loading = true;

      try {
        const result = await User.login(this.form);

        if(!result.success){
          if(result.errorField){
            this.errors[result.errorField] = true;
          }
          this.showNotif(result.message, 'error');
        } else {
          this.showNotif(result.message, 'success');
          this.$router.push('/Main');
        }
      } catch (error) {
        console.error(error);
        alert("Login gagal! Periksa surel dan sandi Anda.");
      }finally{
        this.loading = false;
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
  },
  watch: {
    'form.name': function(newValue) {
      if (newValue) this.errors.name = false;
    },
    'form.password': function(newValue) {
      if (newValue.length >= 8) this.errors.password = false;
    }
  }
}
</script>

<style scoped>
.login-content{
  display: flex;
  flex-direction: column;
  gap: 3rem;
  align-items: center;
  justify-content: center;
  min-height: 60vh;
}

.username-input, .password-input{
  width: 20rem;
  height: 3rem;
  border: 1.5px #800000 solid;
  border-radius: 1rem;
  text-align: center;
  font-size: 1rem;
  margin-bottom: 0.5rem;
  outline: none;
}

.username-input:focus, .password-input:focus{
  border-color: #a83232;
  background: #fff8f8;
}

.password-wrapper{
  position: relative;
  width: 20rem;
}

.toggle-password{
  position: absolute;
  right: 1rem;
  top: 0.75rem;
  cursor: pointer;
  font-size: 1.25rem;
}

.invalid {
  border: 2px solid #b91c1c;
  background: #fff0f0;
}

.login-login{
  width: 18rem;
  margin: 1.5rem auto 0 auto;
  background: #800000;
  color: white;
  border: none;
  padding: 0.75em 2em;
  border-radius: 1rem;
  cursor: pointer;
  font-size: 1rem;
  font-weight: 600;
  transition: background 0.2s;
}

.login-login:hover{
  background: #a83232;
}

.login-login:disabled {
  background: #ccc;
  color: #888;
  cursor: not-allowed;
}

.toast{
  position: fixed;
  top: 1.5rem;
  right: 1.5rem;
  z-index: 9999;
  padding: 1em 2em;
  border-radius: 0.75rem;
  font-weight: bold;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  transition: all 0.5s ease-in-out;
  font-size: 1rem;
}

.toast.success {
  background-color: #d4edda;
  color: #155724;
}
.toast.error {
  background-color: #f8d7da;
  color: #721c24;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>