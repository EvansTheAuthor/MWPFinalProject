<script setup>
import headerBar from './components/header-footer/headerBar.vue';
import HelloWorld from './components/HelloWorld.vue'
import router from './routers';
</script>

<template>
  <div class="app-layout">
    <header-bar/>
    <main class="page-content">
      <router-view/>
    </main>
  </div>
</template>

<style scoped>
.app-layout{
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.page-content{
  flex-grow: 1;
  display: grid;
  justify-content: center;
  align-items: center;
  padding: 20rem;
}

header-bar{
  flex-shrink: 0;
}

.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
