<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Students Index
        <Link
          class="float-right"
          :href="route('students.create')"
        >
          <jet-button>Create</jet-button>
        </Link>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-input
          type="text"
          class="block ml-2 mb-4 w-60"
          v-model="form.search"
          placeholder="Search"
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
                          Student Level
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

                  </table>
                  <jet-pagination class="m-5" :links="students.links" />
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
    SectionStudents: Object,
    filters: Object,
  },

  setup(props) {
    const form = reactive({
      search: props.filters.search,
    });

    watchEffect(() => {
      const query = pickBy(form);

      Inertia.replace(
        route("students.index", Object.keys(query).length ? query : {})
      );
    });
      const deletePost = (studentId) => {

      const result = confirm("Are you sure to Delete this user?");
      if (result) {
        Inertia.delete(route("students.destroy", studentId), {
          preserveScroll: true,
        });
      }
    };
    return { form,deletePost };
  },
};
</script>
