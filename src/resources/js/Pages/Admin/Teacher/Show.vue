<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Teacher Show
        <Link
          class="float-right"
          :href="route('teachers.index')"
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
                 <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5">
          <h2 class="text-xl font-bold"> Teacher </h2>
          <div class="mb-2">  Name: {{ teacher.full_name }}</div>
          <div class="mb-2">  Email: {{ teacher.email }}</div>
          <div class="mb-2">  Phone: {{ teacher.phone }}</div>
          <div class="mb-2">  Office: {{ teacher.office }}</div>
        </div>
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
    teacher: Object,
  },


};
</script>





