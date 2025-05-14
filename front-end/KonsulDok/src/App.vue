<script setup>
import headerBar from './components/header-footer/headerBar.vue';
import footerBar from './components/header-footer/footerBar.vue';
import router from './routers';
</script>

<template>
  <div class="app-layout">
    <header-bar/>
    <main class="page-content">
      <router-view/>
    </main>
    <footerBar/>
  </div>
</template>

<style>
.app-layout{
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  width: 100vw;
  margin: 0;
  padding: 0;
}

.page-content{
  flex-grow: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
}
</style>
