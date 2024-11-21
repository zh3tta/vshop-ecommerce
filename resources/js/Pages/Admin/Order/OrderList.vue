<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
  orders: Array
})

const orders = usePage().props.orders;
const orderItems = usePage().props.orderItems;
const dialogVisible = ref(false);
const dialogShow = ref(false);

// orders from data
const id = ref('');
const status = ref('');
const total_price = ref('');
const user_address = ref('');

const openEditModal = (order) => {
  // update data
  id.value = order.id;
  status.value = order.status;

  dialogVisible.value = true;
}

const openShowModal = (order) => {
  id.value = order.id;
  status.value = order.status;
  total_price.value = order.total_price;
  user_address.value = order.user_address;

  dialogShow.value = true;
}

const updateOrder = async () => {
  const formData = new FormData();
  formData.append('status', status.value);
  formData.append("_method", 'PUT');

  try {
    await router.post('orders/update/' + id.value, formData, {
      onSuccess: (page) => {
        dialogVisible.value = false;
        Swal.fire({
          toast: true,
          icon: "success",
          position: "top-end",
          showConfirmButton: false,
          title: page.props.flash.success
        });
      }
    })
  } catch (err) {
    console.log(err);
  }
}

</script>

<template>
  <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <!-- dialog for editing order -->
    <el-dialog
      v-model="dialogVisible"
      :title="'Edit order'"
      width="50%"
      :before-close="handleClose"
    >
      <!-- Form start -->
      <form @submit.prevent="updateOrder()" class="max-w-md mx-auto">
        <div class="relative z-0 w-full group">
          <label for="floating_status" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Status</label>
          <div class="block py-2.5 px-0 w-full peer">
            <div class="flex items-center mb-4">
              <input checked v-model="status" id="floating_status" type="radio" value="Unpaid" name="floating_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              <label for="floating_status" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Unpaid</label>
            </div>
            <div class="flex items-center mb-4">
              <input v-model="status" id="floating_status" type="radio" value="Paid" name="floating_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              <label for="floating_status" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Paid</label>
            </div>
            <div class="flex items-center mb-4">
              <input v-model="status" id="floating_status" type="radio" value="Delivered" name="floating_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              <label for="floating_status" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
            </div>
          </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
      </form>
    </el-dialog>
  
    <!-- dialog for showing order -->
    <el-dialog
      v-model="dialogShow"
      :title="'Show order'"
      width="50%"
      :before-close="handleClose"
    >
      <div class="max-w-md mx-auto">
        <div class="relative z-0 w-full mb-3 group">
          <span class="block py-2.5 px-0 w-full text-sm font-bold">{{ id }}</span>
          <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Order #</label>
        </div>
        <div class="relative z-0 w-full mb-3 group">
          <div v-if="status === 'Unpaid'" class="block py-2.5 px-0 w-full">
            <span  class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
              {{ status }}
            </span>
          </div>
          <div v-else-if="status === 'Paid'" class="block py-2.5 px-0 w-full">
            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
              {{ status }}
            </span>
          </div>
          <div v-else-if="status === 'Delivered'" class="block py-2.5 px-0 w-full">
            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
              {{ status }}
            </span>
          </div>
          <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Status</label>
        </div>
        <div class="relative z-0 w-full mb-3 group">
          <span class="block py-2.5 px-0 w-full text-sm">$ {{ total_price }}</span>
          <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Total</label>
        </div>
        <div class="relative z-0 w-full mb-3 group">
          <span class="block py-2.5 px-0 w-full text-sm">{{ user_address.address1 }}, {{ user_address.city }} {{ user_address.state }} - {{ user_address.zipcode }}</span>
          <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Address</label>
        </div>
        <div class="relative z-0 w-full mb-2 group">
          <div class="block py-2.5 px-0 w-full relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-4 py-1.5">
                    Product name
                  </th>
                  <th scope="col" class="px-2 py-1.5">
                    Quantity
                  </th>
                  <th scope="col" class="px-2 py-1.5">
                    Unit price
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="orderItem in orderItems" :key="orderItem.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <th v-if="orderItem.order_id === id" scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ orderItem.product.title}}
                  </th>
                  <td v-if="orderItem.order_id === id" class="px-2 py-2">
                    {{ orderItem.quantity }}
                  </td>
                  <td v-if="orderItem.order_id === id" class="px-2 py-2">
                    ${{ orderItem.unit_price }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Products order</label>
        </div>
      </div>
    </el-dialog>

    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
      <!-- Start coding here -->
      <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
          <div class="w-full md:w-1/2">
            <form class="flex items-center">
              <label for="simple-search" class="sr-only">Search</label>
              <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                  </svg>
                </div>
                <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required>
              </div>
            </form>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-4 py-3">Order #</th>
                <th scope="col" class="px-4 py-3">Total</th>
                <th scope="col" class="px-4 py-3">Status</th>
                <th scope="col" class="px-4 py-3">
                  <span class="sr-only">Actions</span>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="order in orders" :key="order.id" class="border-b dark:border-gray-700">
                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ order.id }}</th>
                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">$ {{ order.total_price }}</th>
                <th v-if="order.status === 'Unpaid'" scope="row" class="px-4 py-3">
                  <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                    {{ order.status }}
                  </span>
                </th>
                <th v-else-if="order.status === 'Paid'" scope="row" class="px-4 py-3">
                  <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                    {{ order.status }}
                  </span>
                </th>
                <th v-else-if="order.status === 'Delivered'" scope="row" class="px-4 py-3">
                  <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                    {{ order.status }}
                  </span>
                </th>
                <td class="px-4 flex items-center justify-end">
                  <div :id="`${order.id}`" class="col-span-2 content-center sm:col-span-1 sm:justify-self-end">
                    <div class="py-1 inline-flex m-1" :aria-labelledby="`${order.id}-button`">
                      <a href="#" @click="openEditModal(order)" 
                        class="w-full rounded-lg border border-blue-200 bg-white px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-blue-600 dark:bg-blue-800 dark:text-blue-200 dark:hover:bg-blue-600 dark:hover:text-white dark:focus:ring-blue-700 sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-flex h-3.5 w-3.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Edit
                      </a>         
                    </div>
                    <div class="py-1 inline-flex m-1">
                      <a href="#" @click="openShowModal(order)"
                        class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-flex h-3.5 w-3.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        Detail
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
          <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Showing
            <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
            of
            <span class="font-semibold text-gray-900 dark:text-white">1000</span>
          </span>
          <ul class="inline-flex items-stretch -space-x-px">
            <li>
                <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Previous</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
            </li>
            <li>
                <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Next</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </section>
</template>