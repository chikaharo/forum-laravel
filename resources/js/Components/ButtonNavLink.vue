<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? "inline-flex items-center p-4 bg-sky-600 text-white border border-sky-900 font-medium leading-5 rounded-md focus:outline-none focus:border-sky-700 transition duration-150 ease-in-out"
        : "inline-flex items-center p-4 bg-sky-600 text-white border border-blue-300 font-medium leading-5 rounded-md hover:border-sky-600 hover:bg-sky-500 focus:outline-none focus:text-white focus:border-blue-300 transition duration-150 ease-in-out"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
