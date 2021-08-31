<template>
  <guest-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      </h2>
    </template>

    <div class="py-12">



    </div>
  </guest-layout>
</template>

<script>
import GuestLayout from "@/Layouts/GuestLayout";

export default {
  components: {
    GuestLayout,
  },

  props: {
    posts: Object,
  },
};
</script>
