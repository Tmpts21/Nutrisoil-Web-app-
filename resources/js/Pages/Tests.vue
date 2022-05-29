<script >
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props : ["tests"],
  components : {
      BreezeAuthenticatedLayout ,
      Head ,
      Link 
  }
}
</script>



<template>
    <Head title="Soil Testing Dashboard " />


    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Soil Testing Dashboard 
            </h2>
        </template>
  
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div>
                            <Link :href="route('PerformTesting')" class="bg-transparent hover:bg-green-200 text-green-dark font-semibold hover:text-green-500 py-2 px-4 border border-green-400 hover:border-transparent rounded float-right">
                              Add New  <i class="fa-solid fa-plus text-green-500 text-lg ml-3"></i>
                            </Link>
                        </div>
                          
                        
                        <p class="font-bold"> Previous testing results </p>
                        <br>
                        <hr class="mb-5">
                    


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 text-center">
                    <thead class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="(test,index) in tests" :key="index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center ">
                                        <td class="px-4 py-2">      
                                            {{test.name}}
                                        </td>
                                        <td class="px-4 py-2">      
                                            {{new Date(test.created_at).toISOString().slice(0, 10)}}
                                        </td>
                                        <td class="px-4 py-2">
                                            <Link :href="route('view' , {id : test.id})" class="float-right font-bold shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                                View Data <i class="fa-solid fa-eye ml-3 text-lg text-white"></i>
                                            </Link>
                                            <Link :href="route('updateTest' , {id : test.id})" class="mr-5 float-right font-bold shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                                Start Testing <i class="fa-solid fa-sun-plant-wilt ml-3 text-lg text-white"></i>
                                            </Link>
                                    
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

