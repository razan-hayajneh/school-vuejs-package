<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Teacher Edit
        <Link
          class="float-right mr-5"
          :href="route('teachers.index')"
        >
          <jet-button>Back</jet-button>
        </Link>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-form-section @submitted="UpdateTeacher">
          <template #title> Update Teacher </template>

        <template #description> Update Full Name,Email,Phone or Office  </template>

          <template #form>
           <div class="col-span-6 sm:col-span-4">
              <jet-label for="full_name" class="required" value="Full Name" />
              <jet-input
                id="full_name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.full_name"
                autocomplete="full_name"
              />
              <jet-input-error :message="form.errors.full_name" class="mt-2" />
            </div>
             <div class="col-span-6 sm:col-span-4">
              <jet-label for="email" class="required" value="Email" />
              <jet-input
                id="email"
                type="email"
                readonly
                class="mt-1 block w-full"
                v-model="form.email"
                autocomplete="email"
              />
              <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="phone" class="required" value="Phone" />
              <jet-input
                id="phone"
                type="text"
                class="mt-1 block w-full "
                v-model="form.phone"
                autocomplete="phone"
              />
              <jet-input-error :message="form.errors.phone" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="office" class="required"  value="Office" />
              <jet-input
                id="office"
                type="text"
                class="mt-1 block w-full"
                v-model="form.office"
                autocomplete="office"
              />
              <jet-input-error :message="form.errors.office" class="mt-2" />
            </div>


          </template>

          <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
              Saved.
            </jet-action-message>

            <jet-button
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

  props: {
    teacher: Object,
  },

  setup(props) {
    const form = useForm({
      _method: "PUT",
      full_name: props.teacher.full_name,
      phone: props.teacher.phone,
      office: props.teacher.office,
      email:props.teacher.email,

    });

    const UpdateTeacher = () => {
      form.post(route("teachers.update", props.teacher.id), {
        preserveScroll: true,
      });
    };

    return { form, UpdateTeacher };
  },
};
</script>
