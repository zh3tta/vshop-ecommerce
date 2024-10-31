<script setup>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import Header from './Header.vue';
import Footer from './Footer.vue';
import Hero from './Hero.vue';

onMounted(() => {
  initFlowbite();
});
</script>

<template>
  <!-- header -->
  <Header></Header>
  
  <!-- hero section -->
  <Hero></Hero>

  <!-- main -->
  <slot />

  <!-- footer -->
  <Footer></Footer>

</template>