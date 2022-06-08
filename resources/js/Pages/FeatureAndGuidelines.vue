<script >
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

export default {
  name : "FeaturesAndGuidline",
  components : {
    BreezeAuthenticatedLayout
  },
  data () { 
      return {
      }
  } ,
  created () { 
  },
  methods : { 

  }
}
</script>






<template>
    <Head title="Features and Guidelines" />
<BreezeAuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                    
                    <h5 class="font-bold text-2xl">
                       Feature and guidelines 
                    </h5>

                    <br>

              <div class="block p-6 content-center max-w-sm bg-white rounded-lg border border-gray-200 shadow-md max-w-full">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Soil Testing</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Perform soil testing on your own. In this feature farmers can test their soil to know if it has the right nutrients appropriate for the crops(Rice Plants).</p>
                <img class="mx-auto" src="https://drive.google.com/uc?export=view&id=1RsEUbE0g3xCLGFqn6NLYo-Ncg8gNtw2N" height="250"  width="250" alt="">
              
               <h6 class="mb-3  font-bold tracking-tight text-gray-900 dark:text-white">Guidelines</h6>
                <div class="ml-5">

                <li>
                    Navigate to <span class="font-bold">Soil Testing Dashboard</span> at the  menu tab 
               </li>
                <li>
                    Click <span>Add new testing</span>
               </li>
                <li>
                    After clicking it will redirect to a form. Fill up the <span class="font-bold">field name </span> input and Prepare the device and soil.
                    <p class="ml-5 ">
                        <small class="font-bold">
                            Note : In preparing your soil, collect 1kg of random samples in your field.
                        </small> 
                    </p>
               </li>
                <li>
                    Click <span class="font-bold">continue</span> to start the soil testing after clicking continue Wait for atleast 10-15 secs to the device to stabilized the output for the NPK values. 
               </li>

                <li>
                    Once the Values is stabilized or not changing click <span class="font-bold">save and continue</span>  to process the data.
               </li>

                <li>
                    Lastly it will redirect you to results page where the results and statistics of the test is displayed. 
               </li>

                </div>
                

            </div>




    <br>
    <br>
            
              <div class="block p-6 content-center max-w-sm bg-white rounded-lg border border-gray-200 shadow-md max-w-full">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Fertilize Scheduling</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Schedule when to apply your next fertilizer for your crop. </p>
                <img class="mx-auto mt-3 mb-3 " src="https://drive.google.com/uc?export=view&id=1gco32As3WcepgxGNaoIy1es-PLZDTnbM" height="300"  width="350" alt="">
              
               <h6 class="mb-3  font-bold tracking-tight text-gray-900 dark:text-white">Guidelines</h6>
                <div class="ml-5">

                <li>
                    Navigate to <span class="font-bold">Fertilizer Sceduling</span> at the  menu tab 
               </li>
                <li>
                    Fill up the necessary Input fields 
                    
                    <small>
                        <p class="ml-8"><span class="font-bold">Field Name  </span> - This is the name of the field where you want apply fertilizer.</p>
                        <p class="ml-8"><span class="font-bold">Date  </span> - The date where you will apply the fertilizer.</p>
                        <p class="ml-8"><span class="font-bold">Remarks </span> - This is optional. You can add remarks like what brand of fertilizer will you apply. </p>
                    </small>
           

              </li>
                <li>
                    Click <span class="font-bold">Save</span> to apply the scheduled task. 
               </li>

                 <li>
                    Lastly you can see the scheduled task in <span class="font-bold">Dashboard tab </span> It should display the saved task.
               </li>

                </div>
                

            </div>


<br>
<br>

              <div class="block p-6 content-center max-w-sm bg-white rounded-lg border border-gray-200 shadow-md max-w-full">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Weather Dashboard</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">This featurue displays weather movement for the next five days. </p>
                <img class="mx-auto mt-3 mb-3 " src="https://drive.google.com/uc?export=view&id=1pdlsrW9r7knzDwkAxkOieEvn7aQcIOwN" height="300"  width="800" alt="">
              
               <h6 class="mb-3  font-bold tracking-tight text-gray-900 dark:text-white">Guidelines</h6>
                <div class="ml-5">

                <li>
                    Navigate to <span class="font-bold">Weather Dashboard</span> at the  menu tab 
               </li>
                <li>
                   This should redirect you to the weather dashboard
               </li>

                </div>
                

            </div>



                    </div>
                </div>
            </div>
        </div>
        </BreezeAuthenticatedLayout>

</template>

