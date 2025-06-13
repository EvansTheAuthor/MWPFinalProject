<template>
  <form class="privacy-policy grid" @contextmenu.prevent>
    <h1 class="privacy-title m-5">Kebijakan Privasi</h1>
    <div class="privacy content border-black border-2 p-2 text-left">
        <p class="privacy-date-rev text-gray-400 text-center">Terakhir diperbarui: 14 Mei 2025</p>
        <br>
        <p>Selamat datang di KonsulDok. Kami menghargai privasi Anda dan berkomitmen untuk melindungi informasi pribadi yang Anda berikan saat menggunakan layanan kami.</p>
        <br>
        <p class="privacy-content-list">1. Informasi yang Kami Kumpulkan</p>
        <p>Kami dapat mengumpulkan informasi pribadi seperti:</p>
        <ul class="list-privacy">
          <li>Nama lengkap, email, dan nomor telepon</li>
          <li>Informasi kesehatan yang Anda bagikan secara sukarela melalui platform kami</li>
          <li>Data penggunaan, termasuk log aktivitas dan preferensi</li>
        </ul>
        <br>
        <p class="privacy-content-list">2. Cara Kami Menggunakan Informasi</p>
        <p>Informasi yang dikumpulkan digunakan untuk:</p>
        <ul class="list-privacy">
          <li>Memberikan layanan konsultasi kesehatan digital</li>
          <li>Meningkatkan kualitas layanan dan pengalaman pengguna</li>
          <li>Menghubungi Anda untuk keperluan dukungan atau pemberitahuan penting</li>
        </ul>
        <br>
        <p class="privacy-content-list">3. Keamanan Data</p>
        <p>Kami menggunakan langkah-langkah keamanan teknis dan organisasi untuk melindungi data Anda dari akses yang tidak sah, pengungkapan, atau perubahan.</p>
        <br>
        <p class="privacy-content-list">4. Berbagi Informasi</p>
        <p>Kami <b>tidak menjual</b> atau membagikan data pribadi Anda kepada pihak ketiga, kecuali jika diwajibkan oleh hukum atau atas persetujuan Anda secara eksplisit.</p>
        <br>
        <p class="privacy-content-list">5. Hak Anda</p>
        <p>Anda memiliki hak untuk:</p>
        <ul class="list-privacy">
          <li>Meminta salinan data pribadi yang kami simpan</li>
          <li>Memperbarui atau menghapus informasi Anda</li>
          <li>Menarik persetujuan Anda kapan saja</li>
        </ul>
        <br>
        <p class="privacy-content-list">6. Cookie dan Pelacakan</p>
        <p>Situs ini dapat menggunakan cookie untuk menyimpan preferensi pengguna dan mengumpulkan informasi statistik. Anda dapat mengatur browser untuk menolak cookie.</p>
        <br>
        <p class="privacy-content-list">7. Perubahan Kebijakan</p>
        <p>Kami dapat memperbarui kebijakan ini dari waktu ke waktu. Perubahan akan diberitahukan melalui situs web atau email yang Anda daftarkan.</p>
        <br>
        <p class="privacy-content-list">8. Hubungi Kami</p>
        <p>Jika Anda memiliki pertanyaan mengenai kebijakan ini, silakan hubungi:</p>
        <p>📧 <a href="mailto:support@konsuldokter.com">support@konsuldokter.com</a></p>
        <p>📞 +62123-456-7890</p>
    </div>
  </form>
</template>

<script>
export default {}
</script>

<style scoped>
.privacy-policy{
    padding: 2rem;
    max-width: 48rem;
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.6);
}

.privacy-title{
    color: #800000;
    font-size: 2rem;
    text-align: center;
    margin-bottom: 2rem;
}

.privacy-content{
  border: 2px solid #800000;
  padding: 2rem;
  border-radius: 1rem;
  font-size: 1.1rem;
  color: #222;
  background: #faf9f9;
}

.privacy-date-rev{
  font-size: 1rem;
  text-align: center;
  color: #888;
  margin-bottom: 1rem;
}

.privacy-content-list{
  font-weight: bold;
  margin-top: 1.5rem;
}

.list-privacy{
  margin-left: 2rem;
  list-style-type: disc;
  list-style-position: inside;
  margin-bottom: 1rem;
}
</style>