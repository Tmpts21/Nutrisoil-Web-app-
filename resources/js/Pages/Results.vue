<template>
<BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl h-50 mx-auto sm:px-6 lg:px-8">
                <div class="sm:rounded-lg mb-12 ">

    <div class="max-w-full mx-auto">
        <div v-for="(result , index ) in results " :key="index" class="sm:grid sm:h-24 sm:grid-flow-row sm:gap-4 sm:grid-cols-2  ">
            <div class="flex py-5 flex-col   justify-center bg-white border rounded rounded-xl">
                                        <BarChart :chart-data="this.getChartData([
                                        result['nitrogen'].value,
                                        result['phosporus'].value,
                                        result['potassium'].value,
                                        result['moisture_level'].value,
                                        ])"></BarChart>
                    </div>
                    
            <div class="flex flex-col px-5 bg-white border rounded rounded-xl p-12">
                    <h5>
                      <span class="font-bold"> Assessment : </span>   
                                {{calulateOverAllAssessment(
                                        result['nitrogen'].assesment , 
                                        result['phosporus'].assesment,
                                        result['potassium'].assesment,
                                        result['moisture_level'].assesment
                                    )}}

                                        <i v-if="overAll == 'VERY GOOD'" class="fa-solid fa-circle-check text-green-500"></i>
                                        <i v-if="overAll == 'GOOD'" class="fa-solid fa-circle-check text-orange-500"></i>
                                        <i v-if="overAll == 'BAD'" class="fa-solid fa-circle-check text-red-500"></i>


                           </h5>
 
                                       
                                <small style="font-size: 13px;">
                                    <span class="font-bold"> NITROGEN </span> :  
                               
                                    {{result['nitrogen'].assesment}}
                                    <span v-if="prev">
                                        <span v-if="getPercentageChange(result['nitrogen'].value , prev.nitrogen) < 0 " class="text-red-500">
                                            {{getPercentageChange(result['nitrogen'].value , prev.nitrogen)}}%
                                        </span>
                                        <span v-else-if="getPercentageChange(result['nitrogen'].value , prev.nitrogen) >  0 " class="text-green-500">
                                            <i class="fa-solid fa-plus text-green-500 ml-3" ></i>  {{getPercentageChange(result['nitrogen'].value , prev.nitrogen)}}%
                                        </span>
                                        <span v-else class="text-gray-500">
                                            <i class="fa-solid fa-plus text-gray-500 ml-3" ></i>  {{getPercentageChange(result['nitrogen'].value , prev.nitrogen )}}%
                                        </span>
                                    </span>


                                        <i v-if="result['nitrogen'].assesment == 'HIGH'" class="fa-solid fa-circle-check text-green-500"></i>
                                        <i v-if="result['nitrogen'].assesment == 'MEDIUM'" class="fa-solid fa-circle-check text-orange-500"></i>
                                        <i v-if="result['nitrogen'].assesment == 'LOW'" class="fa-solid fa-circle-check text-red-500"></i>
                                        <i v-if="result['nitrogen'].assesment == 'EXCESSIVE'" class="fa-solid fa-circle-check text-red-500"></i>

                                    <small v-if="summary.nitrogen > 0 && result['nitrogen'].assesment != 'HIGH'" style="font-size:14px" >
                                        <li class="ml-5">
                                            You need to add atleast <span class="font-bold">{{summary.nitrogen}}</span> ppm / mg/Kg of nitrogen to get the ideal nutrient value for the soil
                                        </li>
                                    </small>
                                </small>
                                <small style="font-size: 13px;">
                                    <span class="font-bold"> PHOSPHORUS </span> :  
                                        {{result['phosporus'].assesment}}
                                    <span v-if="prev">

                                    <span v-if="getPercentageChange(result['phosporus'].value , prev.phosporus) < 0 " class="text-red-500">
                                        {{getPercentageChange(result['phosporus'].value , prev.phosporus)}}%
                                    </span>
                                    <span v-else-if="getPercentageChange(result['phosporus'].value , prev.phosporus) >  0 " class="text-green-500">
                                        <i class="fa-solid fa-plus text-green-500 ml-3" ></i>  {{getPercentageChange(result['phosporus'].value , prev.phosporus)}}%
                                    </span>
                                    <span v-else class="text-gray-500">
                                        <i class="fa-solid fa-plus text-gray-500 ml-3" ></i>  {{getPercentageChange(result['phosporus'].value , prev.phosporus )}}%
                                    </span>
                                    </span>

                                        <i v-if="result['phosporus'].assesment == 'HIGH'" class="fa-solid fa-circle-check text-green-500"></i>
                                        <i v-if="result['phosporus'].assesment == 'MEDIUM'" class="fa-solid fa-circle-check text-orange-500"></i>
                                        <i v-if="result['phosporus'].assesment == 'LOW'" class="fa-solid fa-circle-check text-red-500"></i>
                                        <i v-if="result['phosporus'].assesment == 'EXCESSIVE'" class="fa-solid fa-circle-check text-red-500"></i>



                              

                                    <small v-if="summary.phosporus > 0 && result['phosporus'].assesment != 'HIGH'" style="font-size:14px" >
                                        <li class="ml-5">
                                            You need to add atleast <span class="font-bold">{{summary.phosporus}}</span> ppm / mg/Kg of phosphorus to get the ideal nutrient value for the soil
                                        </li>
                                    </small>
                                </small>
                                  
                                <small style="font-size: 13px;">
                                    <span class="font-bold"> POTASSIUM </span> :  
                                        {{result['potassium'].assesment}}
                                    <span v-if="prev">
                                    <span v-if="getPercentageChange(result['potassium'].value , prev.potassium) < 0 " class="text-red-500">
                                       {{getPercentageChange(result['potassium'].value , prev.potassium)}}%
                                    </span>
                                    <span v-else-if="getPercentageChange(result['potassium'].value , prev.potassium) >  0 " class="text-green-500">
                                        <i class="fa-solid fa-plus text-green-500 ml-3" ></i>  {{getPercentageChange(result['potassium'].value , prev.potassium)}}%
                                    </span>
                                    <span v-else class="text-gray-500">
                                        <i class="fa-solid fa-plus text-gray-500 ml-3" ></i>  {{getPercentageChange(result['potassium'].value , prev.potassium)}}%
                                    </span>
                                    </span>

                                    <i v-if="result['potassium'].assesment == 'LOW'" class="fa-solid fa-circle-check text-red-500"></i>
                                    <i v-if="result['potassium'].assesment == 'MEDIUM'" class="fa-solid fa-circle-check text-orang-500"></i>
                                    <i v-if="result['potassium'].assesment == 'HIGH'" class="fa-solid fa-circle-check text-green-500"></i>
                                    <i v-if="result['potassium'].assesment == 'VERY LOW'" class="fa-solid fa-circle-check text-red-500"></i>

                                    <small v-if="summary.potassium > 0 && result['potassium'].assesment != 'HIGH'" style="font-size:14px" >
                                        <li class="ml-5">
                                            You need to add atleast <span class="font-bold">{{summary.potassium}}</span> ppm / mg/Kg of potassium to get the ideal nutrient value for the soil
                                        </li>
                                    </small>
                                </small>

                            <br>
                            <hr>
                                <small style="font-size: 13px;" class="mt-5">
                                    <span class="font-bold"> MOISTURE LEVEL </span> :  
                                        {{result['moisture_level'].assesment}} - <span class="font-bold">{{result['moisture_level'].value}}%</span>
                                     <span v-if="prev">
                                        <span v-if="getPercentageChange(result['moisture_level'].value , prev.moist_level) < 0 " class="text-red-500">
                                          {{getPercentageChange(result['moisture_level'].value , prev.moist_level)}}%
                                        </span>
                                        <span v-else-if="getPercentageChange(result['moisture_level'].value , prev.moist_level) >  0 " class="text-green-500">
                                            <i class="fa-solid fa-plus text-green-500 ml-3" ></i>  {{getPercentageChange(result['moisture_level'].value , prev.moist_level)}}%
                                        </span>
                                        <span v-else class="text-gray-500">
                                            <i class="fa-solid fa-plus text-gray-500 ml-3" ></i>  {{getPercentageChange(result['moisture_level'].value , prev.moist_level) }}%
                                        </span>
                                    </span>
                              
                                    <i v-if="result['moisture_level'].assesment == 'HIGH'" class="fa-solid fa-circle-check text-green-500"></i>
                                    <i v-if="result['moisture_level'].assesment == 'MEDIUM'" class="fa-solid fa-circle-check text-orange-500"></i>
                                    <i v-if="result['moisture_level'].assesment == 'LOW'" class="fa-solid fa-circle-check text-red-500"></i>
                                    <i v-if="result['moisture_level'].assesment == 'VERY HIGH'" class="fa-solid fa-circle-check text-red-700"></i>
                                </small>
                                    
                            </div>
                            

                            <div v-if="n" class="mt-12">
                                <h5 class="font-bold mb-5">
                                    Previous Npk results  <i class="fa-solid fa-chart-line ml-3 text-lg text-green-400"></i>
                                </h5>
                                   <div class="max-w-full mx-auto">
                                    <div class="sm:grid sm:h-32 sm:grid-flow-row">
                                          <div class="mt-5 bg-white-200 flex py-5 flex-col justify-center px-5 py-12 bg-white border border-blue-500 border-4 rounded rounded-xl">
                                                <LineChart :chartData="this.getLineChartData(n , dates , 'nitrogen' , '#93C5FD')"></LineChart>
                                        </div>
                            
                                          <div class="mt-5 bg-white-200 flex py-5 flex-col justify-center px-5 py-12 bg-white border border-red-400 border-4 rounded rounded-xl">
                                                <LineChart :chartData="this.getLineChartData(p , dates , 'phosphorus' ,'#FDBA74')"></LineChart>
                                        </div>

                                          <div class="mt-5 bg-white-200 flex py-5 flex-col justify-center px-5 py-12 bg-white border border-gray-300 border-4 rounded rounded-xl">
                                                <LineChart :chartData="this.getLineChartData(k , dates , 'potassium' ,'#D1D5DB')"></LineChart>
                                        </div>
                                        
                                          <div class="mt-5 bg-white-200 flex py-5 flex-col justify-center px-5 py-12 bg-white border border-blue-200 border-4 rounded rounded-xl">
                                                <LineChart :chartData="this.getLineChartData(ml , dates , 'moisture level' ,'#86EFAC')"></LineChart>
                                        </div>
                              
                        </div>        
                        <br>
                        <br>
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
import LineChart from '../Pages/Line.vue'; 


export default {
  props : ['prev','results','n','p','k','ml','dates'],
  components : { 
      BreezeAuthenticatedLayout,
      Link ,
      BarChart ,
      LineChart
  },
    data : () => ({ 
        summary : {} ,
        overAll : ''
    
  }),
  mounted() {
      
  },
  created () { 
        this.getSummarySuggestion(   
            this.results[0]['nitrogen'].value,
            this.results[0]['phosporus'].value,
            this.results[0]['potassium'].value
        )
    },

  methods : { 
      getChartData(values) { 
        const  chartData= {
            labels: [ 'Nitrogen', 'Phosporus', 'Potassium'],
            datasets: [
                {
                    label: 'mg/Kg',
                    backgroundColor: [ '#eb15e3' , '#6579db' , '#ed9734'],
                    data : values
                }
            ]
        }
        return chartData ; 
      } ,

    getLineChartData(values , dates , name ,color) { 
        const chartData = {
            labels: dates ,
                datasets: [
                    {
                    label: name,
                    backgroundColor: color,
                    data: values
                    }
                ] ,
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
              'VERY HIGH' : 10 ,
          }

          let sum =  NPK_TABLE[n] +  NPK_TABLE[p] +  NPK_TABLE[k] + NPK_TABLE[ml] ; 

          /*
           poor  = 0 - 25
           bad   = 25 - 75 
           good   = 75 - 150
           very good = 125 - 200 
        */
       
        let ret_val = "" ; 
        if (sum <= 25) ret_val = "POOR";
        else if (sum >= 25 && sum <= 100 ) ret_val = 'BAD';
        else if (sum > 100 && sum <= 150 ) ret_val = 'GOOD';
        else if (sum > 150 && sum <= 200 ) ret_val = 'VERY GOOD'; 
        else ret_val = "N/A" ;  
        this.overAll = ret_val; 
        return ret_val 

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

      },
        getPercentageChange(new_val , old_val) { 
            return Math.round(((new_val - old_val  ) / Math.abs(old_val)  )  * 100)
      }
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