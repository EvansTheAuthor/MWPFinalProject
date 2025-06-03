<template>
  <form class="login-content" @submit.prevent="loginUser">
    <h1>Selamat Datang</h1>
    
    <div>
        <h4>Nama Pengguna</h4>
        <input class="username-input" v-model="form.name" type="text" placeholder="Buat nama pengguna Anda" maxlength="30" size="30" autocomplete="off">
    </div>
    
    <div>
        <h4>Kata Sandi</h4>
        <div class="password-wrapper">
          <input class="password-input" :class="{'invalid': errors.password}" v-model="form.password" :type="showPassword ? 'text' : 'password'" placeholder="Buat kata sandi Anda" maxlength="25">
          <span @click="togglePassword" class="toggle-password">{{ showPassword ? '🙈' : '👁️'}}</span>
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
import User from '@/services/User';

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

.toast{
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 9999;
  padding: 15px 25px;
  border-radius: 8px;
  font-weight: bold;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  transition: all 0.5s ease-in-out;
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