<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Sections Edit
        <Link
          class="float-right mr-5"
          :href="route('sections.index')"
        >
          <jet-button>Back</jet-button>
        </Link>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <jet-form-section @submitted="updateSection">
          <template #title> Update Sections </template>

           <template #description> Update Section Number, Teacher Name. </template>

          <template #form>
             <div class="col-span-6 sm:col-span-4">
              <div class="text-sm font-medium text-gray-900" >
                 <h2><span v-for="course in courses.filter((course) => section.course_id === course.id)"
                  :key="course.id" style="margin-right: 0.5em">
                  {{ course.name }}
                  </span></h2>
              </div>
            </div>
           <div class="col-span-6 sm:col-span-4">
              <jet-label for="section_number" class="required"  value="Section Number " />
              <jet-input
                id="section_number"
                type="number"
                class="mt-1 block w-full"
                v-model="form.section_number"
                autocomplete="section_number"
              />
              <jet-input-error :message="form.errors.section_number" class="mt-2" />
            </div>

           <div class="col-span-6 sm:col-span-4">
              <jet-label for="teacher_id" class="required" value="Teacher" />
               <select v-model="form.teacher_id"  name="teacher_id" style="width: 500px;">
                   <option disabled selected >Select </option>
            <option v-for="teacher in teachers" :key="teacher" :value="teacher.id">{{teacher.full_name}}</option>
                 </select>
              <jet-input-error :message="form.errors.teacher_id" class="mt-2" />
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

export default {
  components: {
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
    section: Object,
    courses: Object,
    teachers: Object,
  },

  setup(props) {
    const form = useForm({
      _method: "PUT",
      section_number: props.section.section_number,
      course_id: props.section.course_id,
      teacher_id: props.section.teacher_id,

    });

    const updateSection = () => {
      form.post(route("sections.update", props.section.id), {
        preserveScroll: true,
      });
    };

    return { form, updateSection };
  },
};
</script>
