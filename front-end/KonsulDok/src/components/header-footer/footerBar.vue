<template>
  <main class="footer flex justify-between flex-wrap gap-4 p-6 bg-gray-800 text-white">
    <div class="footer-section basis-1/4">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="../Main.vue">Beranda</a></li>
                <li><a href="../Login.vue">Masuk</a></li>
                <li><a href="../PrivacyPolicy.vue">Kebijakan Privasi</a></li>
            </ul>
        </div>

        <div class="footer-section basis-1/4">
            <h3>Kontak Kami</h3>
            <p>Email: support@konsuldokter.com</p>
            <p>Telepon +62123-456-7890</p>
        </div>

        <div class="footer-section basis-1/4">
            <h3>Follow Kami</h3>
            <div class="social-links flex justify-center">
                <a href="https://facebook.com" class="social-icon"><img src="../../assets/facebook-svgrepo-com.svg" alt="Facebook"></a>
                <a href="https://twitter.com" class="social-icon"><img src="../../assets/icons8-twitter.svg" alt="Twitter"></a>
                <a href="https://instagram.com" class="social-icon"><img src="../../assets/instagram-svgrepo-com.svg" alt="Instagram"></a>
            </div>
        </div>

        <div class="footer-section basis-1/4">
            <p>©KonsulDok 2025. All rights reserved.</p>
        </div>
  </main>
</template>

<script>
export default {

}
</script>


<style>
.footer-section {
  min-width: 200px;
}
ul {
  list-style-type: none;
  padding: 0;
}
ul li {
  margin-bottom: 0.5rem;
}

.social-icon img{
    width: 24px;
    height: 24px;
}
</style>