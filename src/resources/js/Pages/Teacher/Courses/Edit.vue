<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Student Mark

       <Link
          class="float-right mr-5"
          :href="route('teacherCourses.show',student.section_id)"
        >
          <jet-button>Back</jet-button>
        </Link>
        </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-form-section @submitted="UpdateStudentMark">
          <template #title> Update Student Marks </template>

          <template #description> You Can Update First,Mid or Final Mark. </template>

          <template #form>
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="First Mark" value="First Mark" />
              <jet-input
                id="first_mark"
                type="text"
                class="mt-1 block w-full"
                v-model="form.first_mark"
                autocomplete="first_mark"
              />
              <jet-input-error
                :message="form.errors.first_mark"
                class="mt-2"
              />
            </div>
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="Mid Mark" value="Mid Mark" />
              <jet-input
                id="mid_mark"
                type="text"
                class="mt-1 block w-full"
                v-model="form.mid_mark"
                autocomplete="mid_mark"
              />
              <jet-input-error
                :message="form.errors.mid_mark"
                class="mt-2"
              />
            </div>
            <div class="col-span-6 sm:col-span-4">
              <jet-label for="Final Mark" value="Final Mark" />
              <jet-input
                id="final_mark"
                type="text"
                class="mt-1 block w-full"
                v-model="form.final_mark"
                autocomplete="final_mark"
              />
              <jet-input-error
                :message="form.errors.final_mark"
                class="mt-2"
              />
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
    student: Object,
  },

  setup(props) {
    const form = useForm({
      _method: "PUT",
      first_mark: props.student.first_mark,
      mid_mark: props.student.mid_mark,
      final_mark: props.student.final_mark,
    });

    const UpdateStudentMark = () => {
      form.post(
        route(
          "editedStudentMark",
          {section_id:props.student.section_id,
          student_id:props.student.student_id}
        ),
        {
          preserveScroll: true,
        }
      );
    };

    return { form, UpdateStudentMark };
  },
};
</script>
