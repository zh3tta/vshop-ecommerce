<template>
  <AdminLayout>    
    <div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div
          class="rounded-lg h-32 md:h-64"
        >
          <div class="bg-white rounded-lg h-32 md:h-64 p-4">
            <svg
              aria-hidden="true"
              class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                clip-rule="evenodd"
              ></path>
            </svg>
            <Link :href="route('admin.orders.index')">
              <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Sales:</p>
              <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ sales }}</h5>
            </Link>
          </div>
        </div>
        <div
          class="rounded-lg h-32 md:h-64"
        >
          <div class="bg-white rounded-lg h-32 md:h-64 p-4">
            <svg 
                class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" 
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
              >
                <path fill-rule="evenodd" d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
              </svg>
            <Link :href="route('admin.products.index')">
              <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Products:</p>
              <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ products }}</h5>
            </Link>
          </div>
        </div>
        <div
          class="rounded-lg h-32 md:h-64"
        >
          <div class="bg-white rounded-lg h-32 md:h-64 p-4">
            <svg 
              class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" 
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
            >
              <path d="M18.045 3.007 12.31 3a1.965 1.965 0 0 0-1.4.585l-7.33 7.394a2 2 0 0 0 0 2.805l6.573 6.631a1.957 1.957 0 0 0 1.4.585 1.965 1.965 0 0 0 1.4-.585l7.409-7.477A2 2 0 0 0 21 11.479v-5.5a2.972 2.972 0 0 0-2.955-2.972Zm-2.452 6.438a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
            </svg>
            <Link :href="route('admin.brands.index')">
              <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Brands:</p>
              <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ brands }}</h5>
            </Link>
          </div>
        </div>
        <div
          class="rounded-lg h-32 md:h-64"
        >
          <div class="bg-white rounded-lg h-32 md:h-64 p-4">
            <svg 
              class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" 
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
            >
              <path fill-rule="evenodd" d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z" clip-rule="evenodd"/>
            </svg>
            <Link :href="route('admin.categories.index')">
              <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Categories:</p>
              <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ categories }}</h5>
            </Link>
          </div>
        </div>
      </div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
      >
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { initFlowbite } from 'flowbite';
import AdminLayout from './Components/AdminLayout.vue';

onMounted(() => {
    initFlowbite();
});

defineProps({
  sales: Array,
  products: Array,
  brands: Array,
  categories: Array,
})
</script>