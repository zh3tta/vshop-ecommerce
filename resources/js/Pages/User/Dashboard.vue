<script setup>
import { Link } from '@inertiajs/vue3';
import UserLayouts from './Layouts/UserLayouts.vue';

defineProps({
  orders: Array
});
</script>

<template>
  <UserLayouts>
    <div v-if="order" class="relative max-w-screen-xl py-24 mx-auto overflow-x-auto">
      <table v-show="order.order_items.length > 0" v-for="order in orders" :key="order.id" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-5">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
              Order ID # {{ order.id }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in order.order_items" :key="item.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ item.product.title }}
            </th>
            <td class="px-6 py-4">
              {{ item.product.brand.name }}
            </td>
            <td class="px-6 py-4">
              {{ item.product.category.name }}
            </td>
            <td class="px-6 py-4">
              $ {{ item.product.price }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="flex flex-col items-center pb-10">
      <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
        </svg>
        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">You Want to Make a Purchase?</h5>        
        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur elit. Voluptas similique tenetur minus dolorum nihil, quibusdam adipisci minima:</p>
        <Link :href="route('products.index')" class="inline-flex font-medium items-center text-blue-600 hover:underline">
          To buy
          <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
          </svg>
        </Link>
      </div>
    </div>
  </UserLayouts>
</template>