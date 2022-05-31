<script >
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import axios from 'axios' ; 

export default {
  props : ["weather"],
  components : {
      BreezeAuthenticatedLayout ,
      Head ,
      Link 
  },
  data () { 
      return {
          
      }
  } ,
  created () { 
  },
  methods : { 
      getDayOfTheWeek(date) { 
            const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            return weekday[date.getToday()]; 
      }

  }
}
</script>






<template>
    <Head title="Soil Test" />
    <BreezeAuthenticatedLayout>
                    <div>
                        <div class="max-w-7xl my-auto mx-auto sm:px-6 lg:px-8">
                            <div class="">
                                <div class="p-6 border-b border-gray-200">

                                    <h3 class="font-bold">
                                    Weather Dashboard 
                            </h3>
                            <div class="flex mb-4 justify-between items-center">
                                <div>
                                    <h5 class="mb-0 font-medium text-xl">{{weather.city.name}}</h5>
                                    <h6 class="mb-0">{{new Date(weather.list[0].dt * 1000).toDateString('en-us')}} <small>(today)</small>   </h6><small>{{weather.list[0].weather.description}}</small>
                                </div>
                                <div class="text-right">
                                    <h3 class="font-bold text-4xl mb-0">
                                        <span class="text-red">
                                        </span>
                                        <small class="text-sm">Temperature <span style="font-size:12px">(today)</span> </small>
                                        <span class="flex">
                                            <img :src="'http://openweathermap.org/img/wn/' + weather.list[0].weather[0].icon + '@4x.png'" class="block w-14 h-14 ml-3 ">
                                            <span>
                                            {{Math.round(weather.list[0].main.temp - 273.15)}}&deg;

                                            </span>
                                        </span></h3>
                                </div>
                            </div>

                            <h5 class="font-bold text-gray-900">Weather forecast for the next 5 days </h5>
                                <div class="max-w-full px-4 mx-auto">
                                    <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-5">
                                          <div class="mt-5 bg-green-200 flex py-5 flex-col justify-center px-5 py-12 bg-white border border-green-400 border-4 rounded rounded-xl">
                                                <p class="text-sm font-bold text-center text-gray-900">{{new Date(weather.list[9].dt * 1000).toDateString('en-us')}}</p>
                                                <p class="text-sm text-center text-gray-500">{{weather.list[9].weather[0].description}}</p>
                                                <p class="font-bold text-sm text-center text-gray-900"> {{ Math.round(weather.list[9].main.temp - 273.15)}}°</p>
                                                <img :src="'http://openweathermap.org/img/wn/' + weather.list[9].weather[0].icon + '@2x.png'" class="w-14 h-14 " style="display: block;margin-left: auto;margin-right: auto;">

                                       </div>

                                         <div class="mt-5 bg-green-200 flex flex-col justify-center px-5 py-5 bg-white border border-green-400 border-4 rounded rounded-xl">
                                                <p class="text-sm font-bold text-center text-gray-900">{{new Date(weather.list[19].dt * 1000).toDateString()}}  </p>
                                                <p class="text-sm text-center text-gray-500">{{weather.list[19].weather[0].description}}</p>
                                                <p class="font-bold text-sm text-center text-gray-900"> {{ Math.round(weather.list[17].main.temp - 273.15)}}°</p>
                                                <img :src="'http://openweathermap.org/img/wn/' + weather.list[19].weather[0].icon + '@2x.png'" class="w-14 h-14 " style="display: block;margin-left: auto;margin-right: auto;">

                                          </div>

                                          
                                         <div class="mt-5 bg-green-200 flex flex-col justify-center px-5 py-5 bg-white border border-green-400 border-4 rounded rounded-2xl">
                                                <p class="text-sm font-bold text-center text-gray-900">{{new Date(weather.list[27].dt * 1000).toDateString('en-us')}}   </p>
                                                <p class="text-sm text-center text-gray-500">{{weather.list[27].weather[0].description}}</p>
                                                <p class="font-bold text-sm text-center text-gray-900"> {{ Math.round(weather.list[27].main.temp - 273.15)}}°</p>
                                                <img :src="'http://openweathermap.org/img/wn/' + weather.list[27].weather[0].icon + '@2x.png'" class="w-14 h-14 " style="display: block;margin-left: auto;margin-right: auto;">
                                         </div>

                                          
                                         <div class="mt-5 bg-green-200 flex flex-col justify-center px-5 py-5 bg-white border border-green-400 border-4 rounded rounded-2xl">
                                                <p class="text-sm font-bold text-center text-gray-900">{{new Date(weather.list[36].dt * 1000).toDateString('en-us')}}</p>
                                                <p class="text-sm text-center text-gray-500">{{weather.list[36].weather[0].description}}</p>
                                                <p class="font-bold text-sm text-center text-gray-900"> {{ Math.round(weather.list[36].main.temp - 273.15)}}°</p>
                                                <img :src="'http://openweathermap.org/img/wn/' + weather.list[36].weather[0].icon + '@2x.png'" class="w-14 h-14 " style="display: block;margin-left: auto;margin-right: auto;">

                                          </div>

                                          
                                         <div class="mt-5 bg-green-200 flex flex-col justify-center content-center px-5 py-5 bg-white border border-green-400 border-4 rounded rounded-xl">
                                                <p class="text-sm font-bold text-center text-gray-900">{{new Date(weather.list[39].dt * 1000).toDateString('en-us')}}</p>
                                                <p class="text-sm text-center text-gray-500">{{weather.list[39].weather[0].description}}</p>
                                                <p class="font-bold text-sm text-center text-gray-900"> {{ Math.round(weather.list[39].main.temp - 273.15)}}°</p>
                                               
                                                <p class="font-bold text-sm text-center text-gray-500"> 
                                                   <img :src="'http://openweathermap.org/img/wn/' + weather.list[39].weather[0].icon + '@2x.png'" class="w-14 h-14 " style="display: block;margin-left: auto;margin-right: auto;">
                                                </p>


                                          </div>
                                            
                                        </div>
                                </div>

                 
  


                    </div>
                </div>
            </div>
    
        </div>

    </BreezeAuthenticatedLayout>
</template>

