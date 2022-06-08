<script >
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import FeaturesAndGuideline from '../Pages/FeatureAndGuidelines.vue'

export default {
  props : ["weather" ,'taskToday' , 'pendingTasks'],
  components : {
      BreezeAuthenticatedLayout ,
      Head ,
      Link  ,
      FeaturesAndGuideline
  },
  data () { 
      return {
      }
  } ,
  created () { 
  },
  methods : { 
      removeTask(task_id){ 
          Inertia.post('/removeTask', { 
              id : task_id
          })
      },
      finishTask(task_id) { 
        Inertia.post('/finishTask', { 
            id : task_id
        })
      }

  }
}
</script>






<template>
    <Head title="Soil Test" />

    <BreezeAuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                          <div v-if="$page.props.flash.message" class="alert">
                            <div class="bg-green-100 text-green-700 p-4 border-2 border-green-600 rounded-full " role="alert">
                                <p class="font-bold">{{ $page.props.flash.message }}</p>
                            </div>
                            <br>
                        </div>
                        

                        <h5 class="font-bold">
                            <i class="fa-solid fa-list-check mr-3 text-green-700"></i> Fertilizer Schedule  
                        </h5>
                        <br>

                        <h5 class="font-bold ml-5 text-black">
                            Today 
                        </h5>
                 
                        <div v-if="taskToday.length != 0 " class="ml-3 ">
                                        <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead class="text-center text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                                    <th scope="col" class="px-6 py-3 text-black">
                                                        Field Name 
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-black">
                                                        Scheduled Date
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-black">
                                                        remarks 
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-black">
                                                        Status
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-black">
                                                        Action
                                                    </th>
                                     
                                            </thead>
                                            <tbody>
                                                <tr v-for="(task , index) in taskToday " :key="index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-900 text-center">
                                                    <td class="font-bold py-2 text-black" >
                                                        {{task.field_name}}
                                                    </td>
                                                    <td class="font-bold py-2 text-black" >
                                                        {{task.deadline}}
                                                    </td>
                                                    <td class="font-bold py-2 text-black" >
                                                        {{task.remarks}}
                                                    </td>
                                                    <td class="font-bold py-2 text-black" >
                                                        {{task.status}}
                                                    </td>
                                                    <td class="font-bold py-2 text-black">
                                                        <button @click="finishTask(task.id)" class="bg-transparent hover:bg-green-200 text-green-dark font-semibold hover:text-green-500 py-2 px-4 border border-green-400 hover:border-transparent rounded">Done</button>
                                                        <button @click="removeTask(task.id)" class="ml-3 bg-transparent hover:bg-red-200 text-green-dark font-semibold hover:text-red-500 py-2 px-4 border border-red-400 hover:border-transparent rounded">remove</button>                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                        </div>

                        <div v-else class="ml-8 text-center ">
                           <li>
                               <small class="font-bold"> (No Tasks for today) </small>
                           </li>      
                        </div>


                        <br>
                        <br>
                        <br>




                        <h5 class="font-bold text-black ml-5 ">
                            Pending  
                        </h5>
                        <div v-if="pendingTasks.length != 0 " class="ml-3">
                                <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead class="text-center text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                                                    <th scope="col" class="px-6 py-3 text-black">
                                                        Field Name 
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-black">
                                                        Scheduled Date
                                                    </th>
                                                      <th scope="col" class="px-6 py-3 text-black">
                                                        remarks
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-black">
                                                        Status
                                                    </th>
                                                   
                                                    <th scope="col" class="px-6 py-3 text-black">
                                                        Action
                                                    </th>
                                     
                                            </thead>
                                            <tbody>
                                                <tr v-for="(task , index) in pendingTasks " :key="index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                                                    <td class="font-bold py-2 text-black">
                                                        {{task.name}}
                                                    </td>
                                                    <td class="font-bold py-2 text-black" >
                                                        {{task.deadline}}
                                                    </td>
                                                    <td class="font-bold py-2 text-black" >
                                                        {{task.remarks}}
                                                    </td>
                                                    <td class="font-bold py-2 text-black">
                                                        {{task.status}}
                                                    </td>
                                                    <td class="font-bold py-2 text-black" >
                                                        <button @click="finishTask(task.id)" class="bg-transparent hover:bg-green-200 text-green-dark font-semibold hover:text-green-500 py-2 px-4 border border-green-400 hover:border-transparent rounded">Done</button>
                                                        <button @click="removeTask(task.id)" class="ml-3 bg-transparent hover:bg-red-200 text-green-dark font-semibold hover:text-red-500 py-2 px-4 border border-red-400 hover:border-transparent rounded">remove</button>
                                                   </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                        </div>

                        <div v-else class="ml-8 text-center">
                            <li>
                                 <small class="font-bold"> (no pending tasks) </small>     
                            </li>
                        </div>



                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

