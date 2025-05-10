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
