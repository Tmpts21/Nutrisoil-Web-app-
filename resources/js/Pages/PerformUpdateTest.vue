<template>
<BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white">
                        <div class="text-center ">

                                <Transition>
                                    <div v-if="test.start">
                                            <small class="text-gray-500"> Sample {{test.currentCount}} of {{test.sampleCount}}</small>
                                            <TestDashboard :sensorData="sensorData"></TestDashboard>
</div>
                                </Transition>
                                <Transition>

                                <div v-if="test.start" class="mb-5">

                                    
                                     <button v-if="this.test.currentCount == this.test.sampleCount" @click="processAndSaveData()" class="mr-16 shadow float-right bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button"> 
                                               Finish and continue
                                     </button>
                                     <button v-else @click="nextSample()" class="mr-16 shadow float-right bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                                              Save and Continue to next sample
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
        npkResults : []
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
            Inertia.post('/saveTest', { 
                samples: [this.sensorData],
                title : this.test.title,
                test_id : this.test_id

            })
        },

        // get sensor data from firebase. The "data" is the name of the key inside the database 
        getSensorData() { 
            const db = getDatabase();
            const dataRef = ref(db, 'data');
            onValue(dataRef, (snapshot) => { this.sensorData = snapshot.val() ; });
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