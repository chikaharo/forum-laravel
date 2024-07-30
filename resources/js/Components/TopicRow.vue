<template>
    <tr class="">
        <td class="border border-gray-300 p-4 col-span-7">
            <Link
                :href="`/topic/${topic.slug}`"
                class="font-semibold textLink"
                >{{ topic.title }}</Link
            >
        </td>
        <td class="border border-gray-300 p-4 col-span-1">
            <p class="font-semibold textLink">{{ topic.user.name }}</p>
        </td>
        <td class="border border-gray-300 p-4 col-span-1">
            <p class="font-semibold">Posts</p>
        </td>
        <td class="border border-gray-300 p-4 max-w-24">
            <p
                class="font-semibold overflow-hidden text-ellipsis col-span-3 whitespace-nowrap"
            >
                LatesForumt Post beacuse it's easy come easy go do you let me
                go?
            </p>
        </td>
    </tr>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    topic: Object,
});
</script>
