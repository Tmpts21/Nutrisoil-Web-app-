<template>
<BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-12 text-center ">


                                <div v-if="loading">
                                    <i class="text-green-500 fa-brands fa-pagelines fa-spin text-6xl"></i>
                                </div>
                                <div v-if="firstPage">
                                <Transition>
                                    
                                    <div class="flex flex-col justify-center items-center border-b py-2">
                                          <form class="w-full max-w-sm">
                                            <div class="md:flex md:items-center mb-6">
                                                <div class="md:w-1/3">
                                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                                    Title
                                                </label>
                                                </div>
                                                <div class="md:w-2/3">
                                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Enter title for the test" v-model="test.title">
                                                </div>
                                            </div>
                                            <div class="md:flex md:items-center mb-6">
                                                <div class="md:w-1/3">
                                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                                    No.of samples
                                                </label>
                                                </div>
                                                <div class="md:w-2/3">
                                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Enter no. of samples to test" v-model="test.sampleCount">
                                                </div>
                                            </div>
                                            <div class="md:flex md:items-center">
                                                <div class="md:w-1/3"></div>
                                                <div class="md:w-2/3">
                                                <button  @click="setTitleAndSampleCount" class="shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                                                    Continue
                                                </button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div> 
                                    
                                </Transition>
                                </div>

                                <Transition>
                                    <div v-if="test.start">
                                            <small class="text-gray-500"> Sample {{test.currentCount}} of {{test.sampleCount}}</small>
                                            <TestDashboard :sensorData="sensorData"></TestDashboard>
                                    </div>
                                </Transition>
                                <Transition>

                                <div v-if="test.start">
                                     <button @click="nextSample()" class="mr-16 shadow float-right bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                                            Save and continue to next sample 
                                    </button>
                                </div>
                                </Transition>

                        
                                <Transition>
                                    <div v-if="test.sampleNutrients.length > 0 ">
                                         <Samples :sampleDatas="test.sampleNutrients">   
                                        
                                        </Samples>
                                    </div>
                                
                                </Transition>
                         



                        </div>
                    </div>
                </div>
            </div>
        </div>
 
</BreezeAuthenticatedLayout>
</template>
       
 

 

<script>
import { initializeApp } from "firebase/app";
import { getDatabase, ref, set , onValue} from "firebase/database";
import {watch } from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import TestDashboard from '../Pages/TestDashboard.vue';
import Samples from '../Pages/Samples.vue'
import { Link, useForm } from '@inertiajs/inertia-vue3';

const firebaseConfig = {
  apiKey: "AIzaSyBb-QVQYrayerKBSA4-r0BfARFaU88x868",
  authDomain: "nodemcu-7e837.firebaseapp.com",
  databaseURL: "https://nodemcu-7e837-default-rtdb.firebaseio.com",
  projectId: "nodemcu-7e837",
  storageBucket: "nodemcu-7e837.appspot.com",
  messagingSenderId: "285462049508",
  appId: "1:285462049508:web:8a1654686ffd9e109a72f1",
  measurementId: "G-DYK8VHX3J3"

};

let app = initializeApp(firebaseConfig);

export default {
  props : [],
  components : { 
      BreezeAuthenticatedLayout,
      TestDashboard,
      Samples,
      Link
  },
    data : () => ({ 
      loading : false , 
      firstPage : true ,
      test : { 
        sampleCount : 0 , 
        title : "",
        currentCount: 1 ,
        start : false , 
        sampleNutrients : []
      },
      sensorData : { 
            moistLevel : 0 ,
            nitrogen : 0 ,
            phosporus : 0 , 
            potassium : 0 ,
      }
  }),
  mounted() {
//     this.readSensorContents(); 
//     if (localStorage.getItem("showCountInput")) {
//       this.showCountInput = localStorage.showCountInput;
//     }
//     if (localStorage.getItem("soilTestDashboard")) {
//       this.soilTestDashboard = localStorage.soilTestDashboard;
//     }
  },
  created () {
            this.getSensorData()
    },

  methods : { 

      getSensorData () {
                    setTimeout(() => {
                        this.sensorData.moistLevel = Math.floor(Math.random() * 760);
                        this.sensorData.nitrogen = Math.floor(Math.random() * 255);
                        this.sensorData.phosporus = Math.floor(Math.random() * 255);
                        this.sensorData.potassium = Math.floor(Math.random() * 255);
                        this.getSensorData()
                    }, 1000)
                
            },

      setTitleAndSampleCount() { 
          if(parseInt(this.test.sampleCount > 0 ))
                this.test.currentCount = 1 
                this.test.start = true 
                this.firstPage = false 
                // localStorage.showCountInput = 0 ;
                // localStorage.soilTestDashboard = 1  ;
                // localStorage.currentCount = this.currentCount  ;
      },

      nextSample() {

        if (this.test.currentCount ==  this.test.sampleCount  ) {
            this.test.sampleNutrients.push(this.sensorData)
            this.test.start = false 


        }       

        else { 
        this.loading = true ; 
        this.test.start = false
        setTimeout(() => {
            this.loading = false  ; 
            this.test.start = true 
            this.test.currentCount += 1 
            this.test.sampleNutrients.push(this.sensorData)
            console.log(...this.test.sampleNutrients)
        }, 1000)
        }
       
           
            
        
    },
    
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