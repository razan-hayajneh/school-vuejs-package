<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
       Courses
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
              >
                <div
                  class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                >
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                         <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          course Name
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Section Number
                        </th>
                            <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          First Mark
                        </th>  <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Mid Mark
                        </th>  <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Final Mark
                        </th>

                          <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Teacher
                        </th>


                          <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Tasks
                        </th>

                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-if="!sections.length">
                        <td class="p-4 text-center text-gray-900" colspan="5">
                           No courses
                        </td>
                      </tr>
                      <tr v-for="section in sections" :key="section.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900" >
                                 <span v-for="course in courses.filter((course) => section.course_id === course.id)"
                                  :key="course.id" >
                                  {{ course.name }}
                                    </span>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                              {{ section.section_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                {{ marks[0].first_mark }}
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap">
                               {{ marks[0].mid_mark }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                {{ marks[0].final_mark }}
                                </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                               <div class="ml-4" v-for="teacher in teachers.filter((teacher) => section.teacher_id === teacher.id)"
                              :key="teacher.id" style="margin-right: 0.5em">
                              <div class="text-sm font-medium text-gray-900">
                                 {{ teacher.full_name }}
                              </div>
                              <div class="text-sm text-gray-500">
                                {{ teacher.email }}
                              </div>
                            </div>
                        </td>

                        <td> <Link
                         :href="route('courseStudent.show',section.id)">
                         <jet-button>Show</jet-button>
                         </Link></td>
                      </tr>
                    </tbody>
                  </table>


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import { reactive, watchEffect } from "vue";
import { pickBy } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetPagination from "@/Components/Pagination";
import { Head, Link } from '@inertiajs/inertia-vue3';


export default {
        components: {
    Head,
    Link,
    AppLayout,
    JetButton,
    JetInput,
    JetPagination,
  },

  props: {
    sections: Object,
    courses:Object,
    marks:Object,
    teachers:Object
  },



};
</script>
