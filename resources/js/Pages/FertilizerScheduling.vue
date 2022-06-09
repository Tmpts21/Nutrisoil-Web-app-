<template>
<BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                    <div class="p-6">
                        <div class="text-center ">
                            <div v-if="$page.props.flash.message" class="alert">
                                <div class="bg-green-100 text-green-700 p-4" role="alert">
                                    <p>{{ $page.props.flash.message }}</p>
                                </div>
                                <br>
                            </div>

                            <form>

                        <div class="inline-block relative w-64">
                                 <label class=" text-green-700 text-sm font-bold mb-2" for="username">
                                    Field Name
                                </label>
                            <select v-model="fieldName" class="block appearance-none w-full bg-white border border-green-400 hover:border-green-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required>
                                <option v-for="(field , index) in fields" :key="index"> {{field.name}} </option>
                                <option value="No fields available" v-if="!fields"></option>
                           </select>
                        </div>
                        
                        <div class="inline-block relative w-64 ml-5 ">
                                 <label class=" text-gray-700 text-sm font-bold mb-2" for="username">
                                    Scheduled Date
                                </label>
                               <input v-model="scheduledDate" class="bg-gray-200 appearance-none border-2 border-green-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500" id="inline-full-name" type="date" required>
                        </div>

                        <br>
                        <div class="flex justify-center">
                                <div class="mb-3 xl:w-96">
                                    <br>
                                    <label for="exampleFormControlTextarea1" class="font-bold form-label inline-block mb-2 text-gray-700"
                                    >Remarks</label
                                    >
                                    <textarea v-model="remarks"
                                    class="
                                        form-control
                                        block
                                        w-full
                                        px-3
                                        py-1.5
                                        text-base
                                        font-normal
                                        text-gray-900
                                        bg-white bg-clip-padding
                                        border border-solid border-green-400
                                        rounded
                                        transition
                                        ease-in-out
                                        m-0
                                        focus:text-black focus:bg-white focus:border-green-500 focus:outline-none
                                    "
                                    id="exampleFormControlTextarea1"
                                    rows="5"
                                    placeholder="(optional)"
                                    ></textarea>
                                </div>
                            </div>


                            <button type="submit" @click="submit()"   class="inline-block ml-5 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Save <i class="fa-solid fa-floppy-disk ml-1 text-white"></i>
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
</BreezeAuthenticatedLayout>
</template>



<script >
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

export default {
  props : ['fields'],
  components : {
      BreezeAuthenticatedLayout ,
      Head ,
      Link 
  },
  data () { 
      return {
        fieldName: '',
        scheduledDate: '',
        remarks: '',
      }
  } ,
  created () { 
  },
  methods : { 
    submit() {
      if(this.fieldName === '' || this.scheduledDate === '' ) return 
      
      Inertia.post('/saveTask', {
          fieldName : this.fieldName,
          scheduledDate : this.scheduledDate,
          remarks : this.remarks
      }) ; 
    }

  }
}
</script>
