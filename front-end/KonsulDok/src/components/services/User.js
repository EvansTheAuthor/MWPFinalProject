import axios from "axios";
// axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000/api';

class User {
  async getCurrentUser() {
    try {
      const res = await axios.get('/profile', { withCredentials: true });
      if (res.data.success) {
        return { success: true, user: res.data.user };
      } else {
        return { success: false, message: res.data.message || "Gagal mengambil data pengguna.", errorField: "null" };
      }
    } catch (error) {
      console.error('Error fetching current user:', error);
      return {
        success: false,
        message: "Gagal mengambil data pengguna. Silakan coba lagi nanti.",
        errorField: "null" };
    }
  }

  async login({name, password}){
    if(!name.trim()){
      return {success: false, message: "Nama pengguna tidak boleh kosong!", errorField: "name"};
    }

    if(!/^[a-zA-Z0-_]+$/.test(name)){
      return {success: false, message: "Nama pengguna hanya boleh mengandung huruf, angka, dan garis bawah!", errorField: "name"};
    }

    if(!password.trim()){
      return {success: false, message: "Kata sandi tidak boleh kosong!", errorField: "password"};
    }


    if(password.length < 8){
      return {success: false, message: "Kata sandi harus minimal 8 karakter!", errorField: "password"};
    }

    try {
      const res = await axios.post('/login', { name, password }, { withCredentials: false });
      if(res.data.success){
        return {success: true, message: "Login berhasil!", token: res.data.token, user: res.data.user};
      } else {
        return {success: false, message: "Login gagal! Periksa nama pengguna dan kata sandi Anda.", errorField: "null"};
      }
    } catch (error) {
      console.error('Error during login:', error);
      return {
        success: false,
        message: error.response?.data?.message || "Login gagal!",
        errorField: error.response?.data?.errorField || "password"
      };
    }
  }

  async register({email, name, password, conPassword}){
    if(!email.trim()){
      return {success: false, message: "Email tidak boleh kosong!", errorField: "email"};
    }

    if(!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)){
      return {success: false, message: "Format email tidak valid!", errorField: "email"};
    }

    if(!name.trim()){
      return {success: false, message: "Nama pengguna tidak boleh kosong!", errorField: "name"};
    }

    if(!/^[a-zA-Z0-_]+$/.test(name)){
      return {success: false, message: "Nama pengguna hanya boleh mengandung huruf, angka, dan garis bawah!", errorField: "name"};
    }

    if(!password.trim()){
      return {success: false, message: "Kata sandi tidak boleh kosong!", errorField: "password"};
    }

    if(password.length < 8){
      return {success: false, message: "Kata sandi harus minimal 8 karakter!", errorField: "password"};
    }

    if(password !== conPassword){
      return {success: false, message: "Konfirmasi kata sandi tidak cocok!", errorField: "conPassword"};
    }

    try {
      const res = axios.post('/register', { email, name, password, password_confirmation: conPassword }, { withCredentials: false });
      if(res.data.success){
        return {success: true, message: "Registrasi berhasil! Silakan login.", token: res.data.token};
      } else {
        return {success: false, message: res.data.message || "Registrasi gagal! Silakan coba lagi.", errorField: "null"};
      }
    } catch (error) {
      console.error('Error during registration:', error);
      return {
        success: false,
        message: "Registrasi gagal! Silakan coba lagi nanti.",
        errorField: "null"
      };
    }
  }

  async logout() {
    try {
      await axios.post('/logout', {}, { withCredentials: true });
      return { success: true, message: "Logout berhasil!" };
    } catch (error) {
      console.error('Error during logout:', error);
      return { success: false, message: "Logout gagal! Silakan coba lagi nanti.", errorField: "null" };
    }
  }

  async getProfile() {
    try {
      const res = await axios.get('/profile');
      if (res.data.profile) {
        return { success: true, profile: res.data.profile, user: res.data.user };
      } else {
        return { success: false, message: res.data.message || "Gagal mengambil data profil." };
      }
    } catch (error) {
      return { success: false, message: "Gagal mengambil data profil." };
    }
  }
}

export default new User()