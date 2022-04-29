<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
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

                            <Link :href="route('PerformTesting')" class="shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                               Start Soil Testing
                            </Link>
                            
                        </div>
                        
                        <h5 class="font-bold">Previous Tests </h5>
                        <hr>
                        <br>
                        <div class="mb-5 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg " role="alert">
                            <p class="font-bold">September 6 2022</p>
                            <p>Something not ideal might be happening.</p>
                        </div>

                     </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

