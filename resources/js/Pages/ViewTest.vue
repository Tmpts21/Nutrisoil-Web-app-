<template>
<BreezeAuthenticatedLayout>
        <div class="py-12 bg-white">
            <div class="max-w-7xl bg-white mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-white">
                             <div class="max-w-full mx-auto bg-white">
                                    <div class="bg-white sm:grid sm:h-24 sm:grid-flow-row sm:gap-6  sm:grid-cols-2">
                                        <div class="flex flex-col bg-white justify-center px-4 py-4 border border-blue-300 border-4 rounded ">
                                            <div>
                                                <LineChart :chartData="this.getChartData(n , dates , 'nitrogen' , '#93C5FD')"></LineChart>
                                            </div>
                                        </div>
                            
                                        <div class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-orange-300 border-4 rounded sm:mt-0  ">
                                            <div>
                                                <LineChart :chartData="this.getChartData(p , dates , 'phosphorus' ,'#FDBA74')"></LineChart>
                                            </div>
                                        </div>

                                        <div class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 border-4 rounded sm:mt-0  ">
                                            <div>
                                                <LineChart :chartData="this.getChartData(k , dates , 'potassium' ,'#D1D5DB')"></LineChart>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-green-300 border-4 rounded sm:mt-0  ">
                                            <div>
                                                <LineChart :chartData="this.getChartData(ml , dates , 'moisture level' ,'#86EFAC')"></LineChart>
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
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link } from '@inertiajs/inertia-vue3';
import LineChart from '../Pages/Line.vue'; 


export default {
  props : ['n','p','k','ml','dates'],
  components : { 
      BreezeAuthenticatedLayout,
      Link ,
      LineChart
  },
    data : () => ({ 
        summary : {} ,
    
  }),
  mounted() {
  },
  created () {
    },

  methods : { 
      getChartData(values , dates , name, bgColor ) { 
        const chartData = {
            labels: dates ,
                datasets: [
                    {
                    label: name,
                    backgroundColor: bgColor,
                    data: values
                    }
                ] ,
            }
    
        return chartData ; 
      } ,

  }
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