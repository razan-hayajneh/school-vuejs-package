<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         students in section
        <Link
          class="float-right"
          :href="route('sections.index')"
        >
          <jet-button>back</jet-button>
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
                          Student Email
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Student Phone
                        </th>

                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Created At
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-if="!students.length">
                        <td class="p-4 text-center text-gray-900" colspan="5">
                           No data
                        </td>
                      </tr>
                      <tr v-for="student in students" :key="student.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900" >
                                    {{ student[0].full_name }}
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">

                                {{ student[0].email }}{{ section_id }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        > {{ student[0].phone }}
                                                   </td>
                         <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                        {{ student[0].created_at }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                        >


                           <button
                            @click="deletePost(student[0].id)"
                            class="ml-2 text-red-600 hover:text-red-900"
                          >
                            Delete
                          </button>
                        </td>
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
    students: Object,
    section_id:Object
  },

setup(props) {

      const deletePost = (studentTd) => {

      const result = confirm("Are You Sure To Deltet This Student?");
      if (result) {
        Inertia.delete(route("deleteStudent",{student_id:studentTd,section_id:props.section_id}), {
          preserveScroll: true,
        });
      }
    };
    return {deletePost };
  },

};
</script>





