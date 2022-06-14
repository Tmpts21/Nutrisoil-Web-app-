<template>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                    <div class="px-6 py-3">
                        <div class="text-center ">
                                <div class="text-center">
                                    <h1 class="font-bold text-gray-500 text-2xl">Soil Nutrient Content</h1>
                                </div>
                                <div class="max-w-full px-4 py-4 mx-auto">
                                    <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-3">
                                        <div class="flex flex-col justify-center px-4 py-4 bg-white border border-blue-300 border-4 rounded rounded-full">
                                            <div>
                                                <p class="text-3xl font-semibold text-center text-gray-800">{{sensorData.nitrogen}}</p>
                                                <p class="text-lg text-center text-gray-500">Nitrogen(N)</p>
                                            </div>
                                        </div>
                            
                                        <div class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-orange-300 border-4 rounded sm:mt-0 rounded-full ">
                                            <div>
                                                <p class="text-3xl font-semibold text-center text-gray-800">{{sensorData.phosphorus}}</p>
                                                <p class="text-lg text-center text-gray-500">Phosporus(P) </p>
                                            </div>
                                        </div>

                                        <div class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 border-4 rounded sm:mt-0 rounded-full ">
                                            <div>
                                                <p class="text-3xl font-semibold text-center text-gray-800">{{sensorData.potassium}} </p>
                                                <p class="text-lg text-center text-gray-500">Potassium(K)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                 

                           
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
</template>
       
<script>
export default {
  props : ["sensorData"],
}
  
  
</script>
