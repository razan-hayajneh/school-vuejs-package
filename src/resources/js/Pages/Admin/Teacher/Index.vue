<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Teachers Index
        <Link
          class="float-right"
          :href="route('teachers.create')"
        >
          <jet-button>Add Teacher</jet-button>
        </Link>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-input
          type="text"
          class="block ml-2 mb-4 w-60"
          v-model="form.search"
          placeholder="Seacrch"
        />
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
                          Full Name
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
                          office
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
                      <tr v-if="!teachers.data.length">
                        <td class="p-4 text-center text-gray-900" colspan="5">
                          No data
                        </td>
                      </tr>
                      <tr v-for="teacher in teachers.data" :key="teacher.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">

                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">
                                {{ teacher.full_name }}
                              </div>
                              <div class="text-sm text-gray-500">
                                {{ teacher.email }}
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                            {{ teacher.phone }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ teacher.office }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                          {{ teacher.created_at }}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                        >
                          <Link
                            :href="route('teachers.show', teacher.id)"
                            class="text-indigo-600 hover:text-indigo-900"
                            >Show</Link
                          >
                          <Link
                            :href="route('teachers.edit', teacher.id)"
                            class="ml-2 text-indigo-600 hover:text-indigo-900"
                            >Edit</Link
                          >
                           <button
                            @click="deletePost(teacher.id)"
                            class="ml-2 text-red-600 hover:text-red-900"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <jet-pagination class="m-5" :links="teachers.links" />
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
    teachers: Object,
    filters: Object,
  },

  setup(props) {
    const form = reactive({
      search: props.filters.search,
    });

    watchEffect(() => {
      const query = pickBy(form);

      Inertia.replace(
        route("teachers.index", Object.keys(query).length ? query : {})
      );
    });
      const deletePost = (teacherId) => {

      const result = confirm("Are You Sure To Deltet This User?");
      if (result) {
        Inertia.delete(route("teachers.destroy", teacherId), {
          preserveScroll: true,
        });
      }
    };
    return { form,deletePost };
  },
};
</script>
