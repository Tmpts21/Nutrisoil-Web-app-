<template>
<BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white">
                            

                        <div v-for="(result , index ) in results " :key="index">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Sample {{index + 1}} </h5>


                        <div class="w-full flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="flex flex-col justify-between p-4 leading-normal">                    
                      <h5>
                      <span class="font-bold"> Assessment : </span>   
                                {{calulateOverAllAssessment(
                                        result['nitrogen'].assesment , 
                                        result['phosporus'].assesment,
                                        result['potassium'].assesment,
                                        result['moisture_level'].assesment
                                    )}}

                                         <i class="fa-solid fa-circle-check"
                                    :class="{
                                        'text-green-500': result['moisture_level'].assesment === 'VERY GOOD',                                                                                                              'text-green-500': result['nitrogen'].assesment === 'HIGH', 
                                        'text-orange-500': result['moisture_level'].assesment === 'GOOD', 
                                        'text-red-500': result['moisture_level'].assesment === 'BAD', 

                                    }" >
                                    
                                </i>
                           </h5>
 
                              
                         
                            <hr>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-2 ">
                                        <BarChart :chart-data="this.getChartData([
                                        result['nitrogen'].value,
                                        result['phosporus'].value,
                                        result['potassium'].value,
                                        result['moisture_level'].value,
                                        ])"></BarChart>
                                </div>

                                       
                                <div class="col-span-2 ">
                                            <div>
                                                <small style="font-size: 13px;">
                                                    <span class="font-bold"> NITROGEN </span> :  
                                                        {{result['nitrogen'].assesment}}
                                                        <i class="fa-solid fa-circle-check" 
                                                           :class="{
                                                               'text-green-500': result['nitrogen'].assesment === 'HIGH',                                                                                                              'text-green-500': result['nitrogen'].assesment === 'HIGH', 
                                                               'text-orange-500': result['nitrogen'].assesment === 'MEDIUM', 
                                                               'text-red-500': result['nitrogen'].assesment === 'LOW', 
 
                                                           }" >
                                                            
                                                        </i>
                                                </small>
                                                
                                            </div>

                                            <div>
                                                <small style="font-size: 13px;">
                                                    <span class="font-bold"> PHOSPHORUS </span> :  
                                                        {{result['phosporus'].assesment}}
    
                                                        <i class="fa-solid fa-circle-check "
                                                         :class="{
                                                               'text-green-500': result['phosporus'].assesment === 'HIGH',                                                         
                                                               'text-orange-500': result['phosporus'].assesment === 'MEDIUM',
                                                               'text-red-500': result['phosporus'].assesment === 'LOW', 
                                                               'text-red-500': result['phosporus'].assesment === 'EXCESSIVE',  
                                                           }" >
                                                            
                                                            
                                                        </i>
                                                </small>
                                            </div>
                                  
                                            <div>
                                                <small style="font-size: 13px;">
                                                    <span class="font-bold"> POTASSIUM </span> :  
                                                        {{result['potassium'].assesment}}
                                                        <i class="fa-solid fa-circle-check"  :class="{
                                                               'text-green-500': result['potassium'].assesment === 'HIGH',                                                                                                              'text-green-500': result['nitrogen'].assesment === 'HIGH', 
                                                               'text-orange-500': result['potassium'].assesment === 'MEDIUM', 
                                                               'text-red-500': result['potassium'].assesment === 'LOW' ||  result['potassium'].assesment === 'VERY LOW', 
 
                                                           }" >
                                                            
                                                        </i>
                                                </small>
                                                <div>
                                                    <small style="font-size: 13px;">
                                                        <span class="font-bold"> MOISTURE LEVEL </span> :  
                                                            {{result['moisture_level'].assesment}}
                                                        <i class="fa-solid fa-circle-check"
                                                            :class="{
                                                                'text-green-500': result['moisture_level'].assesment === 'VERY GOOD',                                                                                                              'text-green-500': result['nitrogen'].assesment === 'HIGH', 
                                                                'text-orange-500': result['moisture_level'].assesment === 'GOOD', 
                                                                'text-red-500': result['moisture_level'].assesment === 'BAD', 

                                                            }" >
                                                        </i>
                                                    </small>
                                                </div>
                                    
                                            </div>
                            

                                            <div>
                                                {{getSummarySuggestion(   
                                                         result['nitrogen'].value,
                                                         result['phosporus'].value,
                                                         result['potassium'].value
                                                         )
                                                }}

                                             <div v-if="summary">
                                                <h5 class = 'font-bold '>Suggestions : </h5>
                                                    <small v-if="summary.nitrogen > 0 && result['nitrogen'].assesment != 'HIGH'" >
                                                    <li class="ml-5">
                                                      You need to add atleast <span class="font-bold">{{summary.nitrogen}}</span> ppm / mg/kg of nitrogen to get the ideal nutrient value for the soil
                                                    </li>
                                                  </small>

                                                <small v-if="summary.phosporus > 0 && result['phosporus'].assesment != 'HIGH'" >
                                                    <li class="ml-5">
  
                                                      You need to add atleast <span class="font-bold">{{summary.phosporus}}</span> ppm / mg/kg of phosporus to get the ideal nutrient value for the soil  
                                                   </li>
                                                  </small>

                                                    <small v-if="summary.potassium > 0 && result['potassium'].assesment != 'HIGH'" >
                                                    <li class="ml-5">
                                                     You need to add atleast <span class="font-bold">{{summary.potassium}}</span> ppm / mg/kg of potassium to get the ideal nutrient value for the soil
                                                   </li>
                                                   </small>

``

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
        </div>
 
</BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link } from '@inertiajs/inertia-vue3';
import BarChart from '../Pages/Bar.vue'; 


export default {
  props : ['results'],
  components : { 
      BreezeAuthenticatedLayout,
      Link ,
      BarChart
  },
    data : () => ({ 
        summary : {} ,
    
  }),
  mounted() {
  },
  created () {
    },

  methods : { 
      getChartData(values) { 
        const  chartData= {
            labels: [ 'Nitrogen', 'Phosporus', 'Potassium'],
            datasets: [
                {
                    label: 'PPM Value',
                    backgroundColor: [ '#03fce8' , '#b5b0aa' , '#ed9734'],
                    data : values
                }
            ]
        }
        return chartData ; 
      } ,

      calulateOverAllAssessment(n,p,k,ml) {
          const NPK_TABLE = { 
              'VERY LOW' : 5 ,
              'LOW' : 10 ,
              'EXCESSIVE' : 10 ,
              'MEDIUM' : 30 ,
              'HIGH' : 50 ,
          }

          const ML_TABLE = { 
              'BAD' : 20 ,
              'GOOD' : 30 ,
              'VERY GOOD' : 50 ,

          }

          let sum =  NPK_TABLE[n] +  NPK_TABLE[p] +  NPK_TABLE[k] + ML_TABLE[ml] ; 

          /*
           poor  = 0 - 25
           bad   = 25 - 75 
           good   = 75 - 150
           very good = 125 - 200 
        */
    
        if (sum <= 25) return "POOR";
        else if (sum >= 25 && sum <= 100 ) return 'BAD';
        else if (sum > 100 && sum <= 150 ) return 'GOOD';
        else if (sum > 150 && sum <= 200 ) return 'VERY GOOD'; 
        else return "N/A" ; 

      } ,

      getSummarySuggestion(n,p,k) { 
          const IDEAL_NPK = {
              'nitrogen' :  20 ,
              'phosporus' :  20 ,
              'potassium' :  290 ,
          }
          
         const summary = {
              'nitrogen' : IDEAL_NPK.nitrogen  - n ,
              'phosporus' : IDEAL_NPK.phosporus  - p  , 
              'potassium' : IDEAL_NPK.potassium  - k ,  
         }
        
        this.summary = summary ;

      }
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