<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        View Students
         <Link
          class="float-right mr-5"
          :href="route('teacherCourses.index')"
        >
          <jet-button>Back</jet-button>
        </Link>
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
                          Student Name
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Phone
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Student Level
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          First Mark
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Mid Mark
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Final Mark
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only"> </span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-if="!studentMarks.length">
                        <td class="p-4 text-center text-gray-900" colspan="5">
                          No data
                        </td>
                      </tr>

                      <tr v-for="studentMark in studentMarks" :key="studentMark.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">

                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">
                                {{ students[studentMark.student_id].full_name }}
                              </div>
                              <div class="text-sm text-gray-500">
                                {{ students[studentMark.student_id].email }}
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" >

                            {{ students[studentMark.student_id].phone }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                        <div >
                          {{ students[studentMark.student_id].student_level }}
                          </div>
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ studentMark.first_mark }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ studentMark.mid_mark }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ studentMark.final_mark }}
                        </td>
                         <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          <Link
                            :href="route('editStudentMark',{section_id:studentMark.section_id,student_id:studentMark.student_id})"
                            class="ml-2 text-indigo-600 hover:text-indigo-900"
                            >Edit</Link
                          >
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- <jet-pagination class="m-5" :links="teacherCourses.links" /> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>>
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
    students: Object,
    studentMarks: Object,
  },

};
</script>
