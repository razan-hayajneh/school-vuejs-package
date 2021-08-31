<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Task Create
        <Link
          class="float-right mr-5"
          :href="route('courseTask.show', id)"
        >
          <jet-button>Back</jet-button>
        </Link>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl  sm:px-6 lg:px-8">
        <jet-form-section @submitted="createTask" >
         <template #title> Add Task </template>
        <template #description> You Must Enter Name and Description To Add New Task. <br>You Can Upload file. </template>

          <template #form>
             <div class="col-span-6 sm:col-span-4">
              <jet-label for="name" class="required" value="Name" />
              <jet-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                autocomplete="name"
              />
              <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
           <div class="col-span-6 sm:col-span-4">
              <jet-label for="description" class="required" value="Description" />
              <textarea
                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                v-model="form.description"
                rows="10"
              ></textarea>
              <jet-input-error :message="form.errors.description" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="upload file" value="Upload File" />
                 <input type="file" @change="selectFile">

              <jet-input-error :message="form.errors.url_file" class="mt-2" />
            </div>
          </template>

          <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
              Saved.
            </jet-action-message>

            <jet-button
              @click="setup(props)"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Save
            </jet-button>
          </template>
        </jet-form-section>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetSelect from "@/Components/Select";
import { Head, Link } from '@inertiajs/inertia-vue3';


export default {
        components: {
    Head,
    Link,
    AppLayout,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetSelect,
  },
  props:{
      id:Object,
  },
  methods: {
        selectFile(event) {
            // `files` is always an array because the file input may be in multiple mode
            this.form.url_file = event.target.files[0];
        }
    },
 setup(props) {
    const form = useForm({
      _method: "POST",
      name: "",
      description: "",
      url_file:"",
      section_id:props.id,
    });
    const createTask = () => {
      form.post(route("createdTask"));
    };
    return { form, createTask };
  },
};

</script>
