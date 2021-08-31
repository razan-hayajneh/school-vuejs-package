<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Add student

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
        <jet-form-section @submitted="addStudents">
          <template #title> Add Student To Sections </template>

          <template #description> You Must Enter Student Name To Add New Student to Section  . </template>
          <template #form>

            <div class="col-span-6 sm:col-span-4">
              <jet-label for="course_id"  value="Course : " />
               <select v-model="form.course_id" disabled name="course_id" style="width: 500px;">
            <option v-for="course in courses" :key="course" :value="course.id">{{course.name}}</option>
                 </select>
            </div>
            <div class="col-span-6 sm:col-span-4">
               Section :  {{ form.section_number}}
            </div>
           <div class="col-span-6 sm:col-span-4">
              <jet-label for="teacher_id" class="required" value="Teacher" />
               <select v-model="form.teacher_id" disabled name="teacher_id" style="width: 500px;">
            <option v-for="teacher in teachers" :key="teacher" :value="teacher.id">{{teacher.full_name}}</option>
                 </select>


            </div>

            <div class="col-span-6 sm:col-span-4">
              <jet-label for="student_id" class="required" value="student" />
               <select v-model="form.student_id"  name="student_id" style="width: 500px;">
            <option v-for="student in students" :key="student" :value="student.id">{{student.full_name}}</option>
                 </select>
              <jet-input-error :message="form.errors.student_id" class="mt-2" />
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
    students :Object
  },

  setup(props) {
    const form = useForm({
    _method: "POST",
      section_number: props.section.section_number,
      course_id: props.section.course_id,
      teacher_id: props.section.teacher_id,
      student_id :"",
      section_id :props.section.id,

    });

    const addStudents = () => {
      form.post(route("sectionStudents.store"), {
        preserveScroll: true,
      });
    };

    return { form, addStudents };
  },
};
</script>
