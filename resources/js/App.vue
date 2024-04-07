<script setup>
import NavBar from './components/NavBar.vue';
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
</script>

<template>
  <div id="app">
    <Header />
    <NavBar />
    <router-view/>
    <Footer />
  </div>
</template>

<style>
/* Global styles */
</style>
