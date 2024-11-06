<script setup>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import Header from './Header.vue';
import Footer from './Footer.vue';

onMounted(() => {
  initFlowbite();
});
</script>

<template>
  <!-- header -->
  <Header></Header>

  <!-- main -->
  <slot />

  <!-- footer -->
  <Footer></Footer>

</template>