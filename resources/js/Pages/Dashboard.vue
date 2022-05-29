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
    <Head title="Soil Test" />



    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
  
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-12 text-center">

                            <br>

                        </div>

                            
                     </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

