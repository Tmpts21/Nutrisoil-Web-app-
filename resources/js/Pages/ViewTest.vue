<template>
<BreezeAuthenticatedLayout>

        <div class="py-12 bg-white">
            <div class="max-w-7xl bg-white mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-white">
                        <h2 class="mb-3 font-semibold text-xl text-gray-800 leading-tight">
                           Field Name : <span class="font-bold"> {{fieldName}}</span>    
                        </h2>
                        <h5 class="font-bold"> <i class="fa-solid fa-chart-line mr-3  text-green-500"></i> Npk Values Chart </h5>
                             <div class="max-w-full mx-auto bg-white">
                                    <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-4">
                                          <div class="mt-5 bg-white-200 flex py-5 flex-col justify-center px-5 py-12 bg-white border border-blue-500 border-4 rounded rounded-xl">
                                                <LineChart :chartData="this.getChartData(n , dates , 'nitrogen' , '#93C5FD')"></LineChart>
                                        </div>
                            
                                          <div class="mt-5 bg-white-200 flex py-5 flex-col justify-center px-5 py-12 bg-white border border-red-500 border-4 rounded rounded-xl">
                                                <LineChart :chartData="this.getChartData(p , dates , 'phosphorus' ,'#FDBA74')"></LineChart>
                                        </div>

                                          <div class="mt-5 bg-white-200 flex py-5 flex-col justify-center px-5 py-12 bg-white border border-gray-500 border-4 rounded rounded-xl">
                                                <LineChart :chartData="this.getChartData(k , dates , 'potassium' ,'#D1D5DB')"></LineChart>
                                        </div>
                                        
                                          <div class="mt-5 bg-white-200 flex py-5 flex-col justify-center px-5 py-12 bg-white border border-blue-200 border-4 rounded rounded-xl">
                                                <LineChart :chartData="this.getChartData(ml , dates , 'moisture level' ,'#86EFAC')"></LineChart>
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
  props : ['n','p','k','ml','dates','fieldName'],
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