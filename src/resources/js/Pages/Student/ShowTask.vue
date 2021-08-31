<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        View Tasks

      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div
                  class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Task Name
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          File
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-if="!tasks.length">
                        <td class="p-4 text-center text-gray-900" colspan="5">
                          No data
                        </td>
                      </tr>
                      <tr v-for="task in tasks" :key="task.id">
                        <td class="px-6 py-4 whitespace-nowrap flex items-center">
                             {{ task.name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">

                            {{ task.description }}
                        </td>

                        <td
                          class="px-6 py-4 whitespace-nowrap flex items-center">
                           <Link v-if="task.url_file!=null"
                            :href="route('downloadFile',{url_file:task.url_file,section_id:task.section_id})"
                            class="ml-2 text-indigo-600 hover:text-indigo-900"
                            >
                        <button class="btn btn-primary">Show</button>
                        </Link>
                        <div class="ml-2 text-indigo-600 hover:text-indigo-900" v-else> No File</div>
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
    tasks: Object,
    id:Object,
  },
};
</script>
