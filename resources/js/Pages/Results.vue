<template>
<BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white">
                            

                        <div v-for="(result , index ) in results " :key="index">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Sample {{index}} </h5>


                        <div class="w-full flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                  
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-2 ">
                                        <BarChart :chart-data="this.getChartData([
                                        result['nitrogen'].value,
                                        result['potassium'].value,
                                        result['phosporus'].value,
                                        result['moisture_level'].value,
                                        ])"></BarChart>
                                </div>

                                       
                                <div class="col-span-2 ">
                                            <div>
                                                <small style="font-size: 13px;">
                                                    <span class="font-bold"> NITROGEN </span> :  
                                                        {{result['nitrogen'].assesment}}
                                                        <i class="fa-solid fa-circle-check text-green-400">
                                                            
                                                        </i>
                                                </small>
                                            </div>

                                            <div>
                                                <small style="font-size: 13px;">
                                                    <span class="font-bold"> POTASSIUM </span> :  
                                                        {{result['phosporus'].assesment}}
    
                                                        <i class="fa-solid fa-circle-check text-orange-400">
                                                            
                                                        </i>
                                                </small>
                                            </div>
                                  
                                            <div>
                                                <small style="font-size: 13px;">
                                                    <span class="font-bold"> PHOSPORUS </span> :  
                                                        {{result['potassium'].assesment}}
                                                        <i class="fa-solid fa-circle-check text-red-400">
                                                            
                                                        </i>
                                                </small>
                                            </div>
                                  
                                            <div>
                                                <small style="font-size: 13px;">
                                                    <span class="font-bold"> MOISTURE LEVEL </span> :  
                                                        {{result['moisture_level'].assesment}}
                                                        <i class="fa-solid fa-circle-check text-green-400">
                                                            
                                                        </i>
                                                </small>
                                            </div>
                                            <br>
                                            <hr>
                                            <br>
                                            <div>
                                                <small style="font-size: 18px;" >
                                                    <span class="font-bold"> OVERALL : </span> 
                                                        {{result['moisture_level'].assesment}} 💖
                                                </small>
                                            </div>


                                </div>
                                   


                                      
                                        </div>

                                    </div>
                                            
                                </div>
                            </div>        

                                            

                                



                    </div>
                </div>
            </div>
        </div>
 
</BreezeAuthenticatedLayout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import BarChart from '../Pages/Bar.vue'; 


export default {
  props : ['results'],
  components : { 
      BreezeAuthenticatedLayout,
      Link ,
      BarChart
  },
    data : () => ({ 
    
  }),
  mounted() {
  },
  created () {
    },

  methods : { 
      getChartData(values) { 
        const  chartData= {
            labels: [ 'Nitrogen', 'Potassium', 'Phosporus', 'Moisture Level'],
            datasets: [
                {
                    label: 'Data One',
                    backgroundColor: [ '#03fce8' , '#ed9734' ,  '#b5b0aa' ,  '#043e8f'],
                    data : values
                }
            ]
        }
        return chartData ; 
      } ,
  },
}  
</script>

<style scoped>
/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

</style>