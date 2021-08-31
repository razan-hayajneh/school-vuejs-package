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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          #
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Course Name
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Section Number
                        </th>
                         <th
                          scope="col" class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-if="!sections.length">
                        <td class="p-4 text-center text-gray-900" colspan="5">
                          No data
                        </td>
                      </tr>
                      <tr v-for="(section,idx) in sections" :key="idx">
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center ml-4">
                              <div class="text-sm font-medium text-gray-900" >
                               {{idx+1}}
                              </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class=" flex items-center">
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900" >
                               {{ courses[section.id].name }}
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" >
                          <div class="flex items-center" >
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900" >
                                <div >{{ section.section_number }}</div>
                              </div>
                            </div>
                          </div>
                        </td>
                      <td
                          class="px-6 py-4 whitespace-nowrap  text-sm font-medium">
                          <Link
                            :href="route('courseTask.show', section.id)"
                            class="text-indigo-600 hover:text-indigo-900"
                            >Tasks  </Link>

                          <Link
                            :href="route('teacherCourses.show', section.id)"
                            class="text-indigo-600 hover:text-indigo-900 ml-3"
                            >  Students</Link>
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
  </app-layout>
</template>

<script>
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
    courses: Object,
  },
};
</script>
