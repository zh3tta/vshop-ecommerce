<script setup>
import AdminLayout from '../Components/AdminLayout.vue';
import OrderList from './OrderList.vue';

defineProps({
  orders: Array
});
</script>

<template>
  <AdminLayout>
    <OrderList :orders="orders"></OrderList>
  </AdminLayout>
</template>