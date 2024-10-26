<template>
  <AdminLayout>
    <ProductList :products = "products"></ProductList>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../Components/AdminLayout.vue';
import ProductList from './ProductList.vue';
</script>