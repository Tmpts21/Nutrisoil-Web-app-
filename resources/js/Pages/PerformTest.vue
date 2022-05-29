<template>
<BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white">
                        <div class="text-center ">


                                <div v-if="loading">
                                    <i class="text-green-500 fa-brands fa-pagelines fa-spin text-6xl"></i>
                                </div>
                                <div v-if="firstPage">
                                <Transition>
                                    <div class="flex flex-col justify-center items-center py-2">
                                          <form class="w-full max-w-sm">
                                            <div class="md:flex md:items-center mb-6">
                                                <div class="md:w-1/3">
                                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                                    Name of the fields/Land 
                                                </label>
                                                </div>
                                                <div class="md:w-2/3">
                                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500" type="text" placeholder="Enter title for the test" v-model="test.title">
                                                </div>
                                            </div>
                                            <div>
                                                <span>Note :
                                                    <small>
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, voluptatem reprehenderit suscipit quasi consectetur corporis numquam dolorem, molestiae eos nam officia, optio eligendi nihil architecto accusantium dolorum ea commodi laborum?
                                                    </small>
                                            </span>
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

                                <div v-if="test.start" class="mb-5">

                                    
                                     <button v-if="this.test.currentCount == this.test.sampleCount" @click="processAndSaveData()" class="mr-16 shadow float-right bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button"> 
                                               Save and Continue 
                                     </button>
                                     <button v-else @click="nextSample()" class="mr-16 shadow float-right bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                                              Save and Continue to next sample
                                     </button>
                                </div>
                                </Transition>

                        
                                <Transition>
                                    <div v-if="showSampleDatas">
                                         <Samples :sampleDatas="this.test.sampleNutrients">   
                                        
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
import { Inertia } from '@inertiajs/inertia'
import { initializeApp } from "firebase/app";
import { getDatabase, ref, onValue ,child , get} from "firebase/database";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import TestDashboard from '../Pages/TestDashboard.vue';
import Samples from '../Pages/Samples.vue'
import { Link, useForm } from '@inertiajs/inertia-vue3';

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyBb-QVQYrayerKBSA4-r0BfARFaU88x868",
  authDomain: "nodemcu-7e837.firebaseapp.com",
  databaseURL: "https://nodemcu-7e837-default-rtdb.firebaseio.com",
  projectId: "nodemcu-7e837",
  storageBucket: "nodemcu-7e837.appspot.com",
  messagingSenderId: "285462049508",
  appId: "1:285462049508:web:8a1654686ffd9e109a72f1",
  };

let app = initializeApp(firebaseConfig);  // initialize firebase app 

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
      showSampleDatas : false,
      firstPage : true ,
      test : { 
        sampleCount : 1 , 
        title : "",
        currentCount: 1 ,
        start : false , 
        sampleNutrients : []
      },
      sensorData : null 
  }),
  mounted() {
      // local storage here 
  },
  created () {
        console.log(this.getSensorData())
    },

  methods : { 

        // initialize the test 
        setTitleAndSampleCount() { 
            if(parseInt(this.test.sampleCount > 0 ))
                    this.test.currentCount = 1 
                    this.test.start = true 
                    this.firstPage = false 
        },

        // continue to next sample 
        nextSample() {
            this.loading = true ; 
            this.test.start = false
            this.showSampleDatas = false
            this.saveSensorData()
            setTimeout(() => {
                    this.loading = false  ; 
                    this.test.start = true 
                    this.test.currentCount += 1 
                    this.showSampleDatas = true 
            }, 1000)
        },
        
        //save and process data to the backend 
        processAndSaveData() { 
            // instead calling @saveSensorData manually add the last item to the array. IDK if I use the @saveSensordata function it is always offset by one. IDK if this is a bug in inertia or in my code 
            this.test.sampleNutrients.push(this.sensorData);
            Inertia.post('/saveTest', { 
                samples: this.test.sampleNutrients,
                title : this.test.title
            })
        },

        // get sensor data from firebase. The "Data" is the name of the key inside the database 
        getSensorData() { 
            const db = getDatabase();
            const dataRef = ref(db, 'data');
            onValue(dataRef, (snapshot) => { this.sensorData = snapshot.val() });
        },

        // Save sensor data in local storage and variable "test.sampleNutrients"
        saveSensorData() { 
            console.log('hit')
            const dbRef = ref(getDatabase());
            get(child(dbRef, 'data'))
                .then((snapshot) => {
                    if (snapshot.exists()) { this.test.sampleNutrients.push(snapshot.val()) }
                    else { console.log("No data available") }
                }).catch((error) => { console.error(error)  });
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