<template>
    <div class="flex gap-1">
        <Link
            v-for="link in links"
            :key="link?.url"
            :href="link?.url"
            class="p-2 px-3 border-gray-300 border"
            :class="{
                'bg-sky-500 text-white': link?.active,
            }"
            v-html="link.label"
        ></Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps(["links"]);
</script>
