<template>
    <Link :href="'/'">
        <img src="/images/login.png" style="width:228px">
    </Link>
</template>

<script>


import { Head, Link } from '@inertiajs/inertia-vue3'


export default {
        components: {
    Head,
    Link,
  },
    }
</script>
