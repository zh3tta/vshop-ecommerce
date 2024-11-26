<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Plus } from '@element-plus/icons-vue';

defineProps({
  brands: Array
})

const brands = usePage().props.brands;
const isAddBrand = ref(false);
const editMode = ref(false);
const dialogVisible = ref(false);

// brand from data
const id = ref('');
const name = ref('');

const openEditModal = (brand) => {
  // update data
  id.value = brand.id;
  name.value = brand.name;

  isAddBrand.value = false;
  dialogVisible.value = true;
  editMode.value = true;
}

const openAddModal = () => {
  isAddBrand.value = true;
  dialogVisible.value = true;
  editMode.value = false;
}

const AddBrand = async () => {
  const formData = new FormData();
  formData.append('name', name.value);

  try {
    await router.post('brands/store', formData, {
      onSuccess: page => {
        Swal.fire({
          toast: true,
          icon: 'success',
          position: 'top-end',
          showConfirmButton: false,
          title: page.props.flash.success,
        })
        dialogVisible.value = false;
        resetFormData();
      },
    })
  } catch (err) {
    console.log(err);
  }
}

const resetFormData = () => {
  id.value = '';
  name.value = '';
}

const updateBrand = async () => {
  const formData = new FormData();
  formData.append('name', name.value);
  formData.append("_method", 'PUT');

  try {
    await router.post('brands/update/' + id.value, formData, {
      onSuccess: (page) => {
        dialogVisible.value = false;
        resetFormData();
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

const deleteBrand = (brand, index) => {
  Swal.fire({
    title: 'Are you Sure',
    text: "This actions cannot undo!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'no',
    confirmButtonText: 'yes, delete!'
  }).then((result) => {
    if (result.isConfirmed) {
      try {
        router.delete('brands/destroy/' + brand.id, {
          onSuccess: (page) => {
            this.delete(brand, index);
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
  })
}

const changePage = (url) => {
  if (url) {
    router.visit(url);
  }
}
</script>

<template>
  <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <!-- dialog for adding brand or editing brand -->
    <el-dialog
      v-model="dialogVisible"
      :title="editMode ? 'Edit brand' : 'Add brand'"
      width="50%"
      :before-close="handleClose"
    >
      <!-- Form start -->
      <form @submit.prevent="editMode ? updateBrand() : AddBrand()" class="max-w-md mx-auto">
        <div class="relative z-0 w-full mb-5 group">
          <input v-model="name" type="text" name="floating_name" id="floating_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
          <label for="floating_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
      </form>
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
          <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <button type="button" @click="openAddModal"
              class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
              <el-icon class="h-3.5 w-3.5 mr-2"><Plus /></el-icon>
              Add brand
            </button>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-4 py-3">Brand name</th>
                <th scope="col" class="px-4 py-3">
                  <span class="sr-only">Actions</span>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="brand in brands.data" :key="brand.id" class="border-b dark:border-gray-700">
                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ brand.name }}</th>
                <td class="px-4 flex items-center justify-end">
                  <div :id="`${brand.id}`" class="col-span-2 content-center sm:col-span-1 sm:justify-self-end">
                    <div class="py-1 inline-flex m-1" :aria-labelledby="`${brand.id}-button`">
                      <a href="#" @click="openEditModal(brand)" 
                        class="w-full rounded-lg border border-blue-200 bg-white px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-blue-600 dark:bg-blue-800 dark:text-blue-200 dark:hover:bg-blue-600 dark:hover:text-white dark:focus:ring-blue-700 sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-flex h-3.5 w-3.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Edit
                      </a>         
                    </div>
                    <div class="py-1 inline-flex m-1">
                      <a href="#" @click="deleteBrand(brand, index)" 
                        class="w-full rounded-lg border border-red-200 bg-white px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-red-100 dark:border-red-600 dark:bg-red-800 dark:text-red-200 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-700 sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-flex h-3.5 w-3.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Delete
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
            <span class="font-semibold text-gray-900 dark:text-white">{{ brands.from }}-{{ brands.to }}</span>
            of
            <span class="font-semibold text-gray-900 dark:text-white">{{ brands.total }}</span>
          </span>
          <ul class="inline-flex items-stretch -space-x-px">
            <li v-if="brands.prev_page_url">
              <a @click.prevent="changePage(brands.prev_page_url)"
                href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <span class="sr-only">Previous</span>
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
              </a>
            </li>
            <li v-for="page in brands.links" :key="page.label">
              <a v-if="page.url" @click.prevent="changePage(page.url)"
                :class="['flex items-center justify-center text-sm py-2 px-3 leading-tight border',
                page.active
                ? 'z-10 text-primary-600 bg-primary-50 border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',]"
                href="#" v-html="page.label"
              ></a>
            </li>
            <li v-if="brands.next_page_url">
              <a @click.prevent="changePage(brands.next_page_url)" 
                href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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