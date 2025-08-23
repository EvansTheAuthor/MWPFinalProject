<template>
  <form class="register-content" @submit.prevent="registerUser">
    <h1>Yuk Buat Akun Di Sini</h1>

    <div>
        <h4>Nama Pengguna</h4>
        <input :class="{'invalid': errors.name}" v-model="form.name" class="username-input" type="text" placeholder="Nama Pengguna" maxlength="30" size="30" autocomplete="off" />
    </div>
    
    <div>
        <h4>Surel</h4>
        <input :class="{'invalid': errors.email}" v-model="form.email" class="email-input" type="email" placeholder="Surel" maxlength="30" size="30" autocomplete="off" />
    </div>

    <div>
        <h4>Kata Sandi</h4>
        <div class="password-input">
          <input :class="{'invalid': errors.password}" v-model="form.password" :type="showPassword ? 'text' : 'password'" placeholder="Kata Sandi" maxlength="25" autocomplete="off"/>
          <span @click="togglePassword" class="toggle-password"> {{ showPassword ? '🙈' : '👁️'}} </span>
        </div>
    </div>

    <div>
        <h4>Konfirmasi Kata Sandi</h4>
        <div class="password-input">
          <input :class="{'invalid': errors.conPassword}" v-model="form.conPassword" :type="showPassword ? 'text' : 'password'" placeholder="Konfirmasi Kata Sandi" maxlength="25" autocomplete="off"/>
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
import User from './services/User.js'

export default {
  data(){
    return{
      form: {
        name: '',
        email: '',
        password: '',
        conPassword: ''
      },
      errors: {
        name: false,
        email: false,
        password: false,
        conPassword: false
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
    async registerUser() {
      this.errors = { name: false, password: false, email: false, conPassword: false };
      this.loading = true;

      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
        this.errors.email = true;
        this.showNotif("Email tidak valid", "error");
        return;
      }
      if (this.form.password.length < 8) {
        this.errors.password = true;
        this.showNotif("Password minimal 8 karakter", "error");
        return;
      }
      if (this.form.password !== this.form.conPassword) {
        this.errors.conPassword = true;
        this.showNotif("Konfirmasi sandi tidak cocok", "error");
        return;
      }
      
      try {
        const result = await User.register(this.form);
      
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
    watch: {
      'form.password': function(newValue) {
        if (!newValue ||  newValue.length >= 8) {
          this.errors.password = false;
        }
      }
    }
  }
}
</script>

<style scoped>
.register-content {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  max-width: 32rem;
  margin: 2rem auto;
  padding: 2rem;
  background: #fff;
  border-radius: 1.5rem;
  box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.username-input, .email-input, .password-input input {
  width: 100%;
  max-width: 25rem;
  height: 3rem;
  border: 1.5px solid #800000;
  border-radius: 1rem;
  text-align: center;
  font-size: 1rem;
  margin-bottom: 0.5rem;
  outline: none;
}

.password-input {
  display: flex;
  align-items: center;
  position: relative;
}

.toggle-password {
  position: absolute;
  right: 1rem;
  cursor: pointer;
  font-size: 1.25rem;
}

.invalid {
  border: 2px solid #b91c1c !important;
  background: #fff0f0;
}

.signup-signup {
  width: 18rem;
  margin: 1.5rem auto 0 auto;
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

.signup-signup:disabled {
  background-color: #999;
  cursor: not-allowed;
}

.signup-signup:hover {
  background: #a83232;
}

.toast {
  text-align: center;
  padding: 0.75em 2em;
  margin-top: 1.5rem;
  border-radius: 0.75rem;
  font-weight: bold;
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
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>