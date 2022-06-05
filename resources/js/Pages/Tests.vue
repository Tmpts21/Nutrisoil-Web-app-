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

  
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    <div class="p-6">
                        <div>
                            <Link :href="route('PerformTesting')" class="bg-transparent hover:bg-green-200 text-green-dark font-semibold hover:text-green-500 py-2 px-4 border border-green-400 hover:border-transparent rounded float-right">
                              Add New  <i class="fa-solid fa-plus text-green-500 text-lg ml-3"></i>
                            </Link>
                        </div>
                          
                        
                        <p class="font-bold text-black "> <i class="fa-solid fa-clock-rotate-left text-green-500 mr-3 "></i>  Previous testing results </p>
                        <br>
                        <hr class="mb-5">
                    


        <div  v-if="tests.length">
                 <div class="max-w-full mx-auto ">
                    <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-1">
                        <div   v-for="(test,index) in tests" :key="index" class="mt-5 bg-green-100 flex py-5 flex-col justify-center px-5 py-12 border border-green-500 border-4 rounded rounded-xl">
                           <p>Field Name : <span class="font-bold">{{test.name}}</span>
                           <span class="float-right">
                                 <Link :href="route('view' , {id : test.id})" class="float-right font-bold shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                            <i class="fa-solid fa-eye mr-3 text-lg text-white"></i>    View Data 
                                </Link>
                           </span>
                           </p> 
                           <p>Date : <span class="font-bold">{{new Date(test.created_at).toDateString()}}</span>
                               <span class="float-right">
                                       <Link :href="route('updateTest' , {id : test.id})" class=" mt-3 float-right font-bold shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                               <i class="fa-solid fa-sun-plant-wilt mr -3 text-lg text-white"></i> Start Testing 
                                        </Link>
                               </span>
                            </p> 
                           
                        </div>
                        <br>
                    </div>
                </div>  
                        

                    </div>

                    <div class="font-bold text-center" v-else >
                        <li>
                            <small class="font-bold">No available tests</small>
                        </li>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

