<template>
<BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white">
                        <div class="text-center ">

                                <Transition>
                                    <div v-if="test.start && test.displayMoisture === false ">
                                            <small class="text-gray-500"> Sample {{test.currentCount}} of {{test.sampleCount}}</small>
                                            <TestDashboard :sensorData="sensorData"></TestDashboard>
                                      <button  @click="nextSample()" class="mr-16 shadow float-right bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                                                Continue
                                      </button>
                                          </div>
                                </Transition>
                                <Transition>

                                </Transition>

                                <Transition>
                                    <div v-if="test.displayMoisture === true">
                                        <div class="max-w-full px-4 py-4 mx-auto">
                                            <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-1">
                                                <div class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-green-300 border-4 rounded sm:mt-0 rounded-full ">
                                                    <div>
                                                        <p class="text-3xl font-semibold text-center text-gray-800">{{this.sensorData.moisture }}% </p>
                                                        <p class="text-lg text-center text-gray-500">Moisture Level</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button @click="processAndSaveData()" class="mr-16 shadow float-right bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button"> 
                                                save and continue
                                        </button>
                                  </div>
                                </Transition>

                        
                                <Transition>
                                    <div v-if="showSampleDatas">
                                         <Samples :sampleDatas="prevResults">   
                                        
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
import { Link } from '@inertiajs/inertia-vue3';

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
  props : ['test_id' , 'prevResults'],
  components : { 
      BreezeAuthenticatedLayout,
      TestDashboard,
      Samples,
      Link
  },
    data : () => ({ 
      showSampleDatas : true,
      test : { 
        sampleCount : 1 , 
        title : "",
        currentCount: 1 ,
        start : true , 
        npkResults : [],
        displayMoisture : false , 
        displayNpk : true
      },
      sensorData : {} 
  }),
  mounted() {
      // local storage here 
  },
  created () {
      this.getSensorData();
    },

  methods : { 
        
        //save and process data to the backend 
        processAndSaveData() { 
            const data = this.getSensorData() ;
            this.test.npkResults[0].moisture = data.moisture ; 

            Inertia.post('/saveTest', { 
                samples: this.test.npkResults,
                title : this.test.title,
                test_id : this.test_id

            })
        },
                // continue to next sample 
        nextSample() {
            this.test.displayNpk = false  
            this.test.displayMoisture = true 
            this.saveSensorData() 

        },

        // get sensor data from firebase. The "data" is the name of the key inside the database 
        getSensorData() { 
            const db = getDatabase();
            const dataRef = ref(db, 'data');
            onValue(dataRef, (snapshot) => { this.sensorData = snapshot.val() ; });
            return this.sensorData; 
        },

        saveSensorData() { 
            const dbRef = ref(getDatabase());
            get(child(dbRef, 'data'))
                .then((snapshot) => {if (snapshot.exists()) {
                    this.test.npkResults.push(this.sensorData);
                }
                    else { console.log("No data available") }
                }).catch((error) => { console.error(error)  });
        },

        saveMoistureData() { 
            const dbRef = ref(getDatabase());
            get(child(dbRef, 'data'))
                .then((snapshot) => {if (snapshot.exists()) {
                    this.test.npkResults[0].moisture = snapshot.val().moisture;
                }
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