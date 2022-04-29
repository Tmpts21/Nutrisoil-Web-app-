<template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="text-center ">
                                <div class="text-center">
                                    <h1 class="font-bold text-gray-500 text-2xl">Soil Nutrient Content</h1>
                                </div>
                                <div v-for="(sample , index) in sampleDatas" :key="index">
                                    {{sample.moistLevel}}
                                </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
</template>
       
<script>
export default {
  props : ["sampleDatas"],
}
  
  
</script>
