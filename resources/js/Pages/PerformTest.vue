<template>
<BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-12 text-center ">
                            <Transition name="slide-fade">
                                <div v-if="showCountInput == 1 ">
                                    <div class="flex items-center border-b border-teal-500 py-2">
                                        <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Enter How many Test you will Conduct " v-model="testCount">
                                        <button @click="addTestCount" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                                            Continue 
                                        </button>
                                    </div>        
                                </div>
                           </Transition>
                        <Transition name="slide-fade">
                            <div v-if="soilTestDashboard == 1 ">
                                <small class="font-bold text-gray-500">{{currentCount}} out of {{testCount}}  </small>
                                <div class="text-center">
                                    <h3 class="font-bold">Soil Nutrient Content</h3>
                                </div>

                                <div id="wrapper" class="max-w-full px-4 py-4 mx-auto">
                                    <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-4">
                                        <div id="jh-stats-positive" class="flex flex-col justify-center px-4 py-4 bg-white border border-blue-300 border-4 rounded rounded-full">
                                            <div>
                                                <p class="text-3xl font-semibold text-center text-gray-800">200 mg</p>
                                                <p class="text-lg text-center text-gray-500">Nitrogen(N)</p>
                                            </div>
                                        </div>
                            
                                        <div id="jh-stats-negative" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-orange-300 border-4 rounded sm:mt-0 rounded-full ">
                                            <div>
                                                <p class="text-3xl font-semibold text-center text-gray-800">120 mg</p>
                                                <p class="text-lg text-center text-gray-500">Phosporus(P) </p>
                                            </div>
                                        </div>

                                        <div id="jh-stats-neutral" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 border-4 rounded sm:mt-0 rounded-full ">
                                            <div>
                                                <p class="text-3xl font-semibold text-center text-gray-800">35 mg </p>
                                                <p class="text-lg text-center text-gray-500">Potassium(K)</p>
                                            </div>
                                        </div>
                                        
                                        <div id="jh-stats-neutral" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-green-300 border-4 rounded sm:mt-0 rounded-full ">
                                            <div>
                                                <p class="text-3xl font-semibold text-center text-gray-800">{{this.moistLevel}} </p>
                                                <p class="text-lg text-center text-gray-500">Moisture Level</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <Transition name="slideup-fade">
                                <div class="text-center mt-3 " v-if="!isStart">
                                        <button @click="startSoilTesting"  class="bg-green-400 text-2xl hover:bg-green-500 text-green-800 font-bold py-2 px-4 rounded-full">
                                            <span>Start Soil Testing 
                                                <i class="fa-solid fa-vials"></i>
                                            </span>
                                        </button>
                                </div>

                            </Transition>
                            <Transition name="slideup-fade">

                                <div class="text-center mt-3 " v-if="isStart">
                                        <button @click="endSoilTesting"  class="bg-green-400 text-2xl hover:bg-green-500 text-green-800 font-bold py-2 px-4 rounded-full">
                                            <span> Save and Continue 
                                                <i class="fa-solid fa-circle-arrow-right"></i>
                                            </span>
                                        </button>
                                          <div class="text-left mt-8">
                                        <div class="rounded bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                                            <p class="font-bold">Soil Testing Started
                                                  <i class="float-right mr-2  fas fa-solid fa-spin fa-seedling text-green-800 text-lg  "></i>
                                            </p>
                                            <p>Please wait for the values to be stabilized if you feel contented about the values. Click Stop and Save to continue to next Testing or finish the Testing </p>
                                        </div>
                                    </div>
                                </div>
                            </Transition>
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
import { Link, useForm } from '@inertiajs/inertia-vue3';


const firebaseConfig = {
  apiKey: "AIzaSyBdzRx4-G2nf09RPCxph_rp9lzw6tE7nL0",
  authDomain: "nutrisoil-95b4e.firebaseapp.com",
  projectId: "nutrisoil-95b4e",
  storageBucket: "nutrisoil-95b4e.appspot.com",
  messagingSenderId: "398281107964",
  appId: "1:398281107964:web:3a52c6f14dc2cd653eea79",
  databaseURL:"https://nutrisoil-95b4e-default-rtdb.asia-southeast1.firebasedatabase.app/"
};

let app = initializeApp(firebaseConfig);

export default {
  props : [],
  components : { 
      BreezeAuthenticatedLayout,
      Link
  },
    data : () => ({ 
      testCount : 0 , 
      showCountInput : 1 ,
      currentCount: 0 ,
      isStart : 0 , 
      soilTestDashboard : 0 ,
      moistLevel : 0 
  }),
  mounted() {
    this.readSensorContents(); 
    if (localStorage.getItem("showCountInput")) {
      this.showCountInput = localStorage.showCountInput;
    }
    if (localStorage.getItem("soilTestDashboard")) {
      this.soilTestDashboard = localStorage.soilTestDashboard;
    }
  },


  methods : { 
      addTestCount() { 
          if (this.currentCount <= 0 ) { 
                this.showCountInput = 0  ; 
                this.soilTestDashboard = 1 ; 
                localStorage.showCountInput = 0 ;
                localStorage.soilTestDashboard = 1  ;
                localStorage.currentCount = this.currentCount  ;
          }
      },

      startSoilTesting() {
        const db = getDatabase();
        set(ref(db), {
            onStart: true  ,
             moistLevel : 0 
        });

        this.isStart = true ; 
    },
      endSoilTesting() {
        const db = getDatabase();
        set(ref(db), {
            onStart: false  ,
            moistLevel : 0 
        });

        this.isStart = false ; 
    } ,
        readSensorContents() { 
        const db = getDatabase();
        const mostLevelRef = ref(db);
            onValue(mostLevelRef, (snapshot) => {
            this.moistLevel = snapshot.val().moistLevel
            console.log(this.moistLevel)
        });
    }
  },
     

  

}
  
  
</script>

<style scoped>
/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.slide-fade-enter-active {
  transition: all 0.5s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(200px);
  opacity: 0;
}





.slideup-fade-enter-active {
  transition: all 0.5s ease-out;
}

.slideup-fade-leave-active {
  transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slideup-fade-enter-from,
.slideup-fade-leave-to {
  transform: translateY(200px);
  opacity: 0;
}


</style>