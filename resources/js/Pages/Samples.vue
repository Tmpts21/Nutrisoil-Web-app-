<template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 ">
                        <div class="text-center ">
                                <div class="text-left mb-4">
                                    <h1 class="font-bold text-gray-500 text-2xl ">Previous NPK results : </h1>
                                </div>
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                               
                                                    <th scope="col" class="px-6 py-3">
                                                        Nitrogen
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Phosporus
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Photassium
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Moisture Level
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Date
                                                    </th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(sample , index) in sampleDatas" :key="index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                                                    <td class="px-6 py-4">
                                                        {{sample.nitrogen}}mg/L
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{sample.phosporus}} mg/L
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{sample.potassium}} mg/L
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{sample.moist_level}} %
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{new Date(sample.created_at).toISOString().slice(0, 10)}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
