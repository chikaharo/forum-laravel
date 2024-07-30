<template>
    <tr class="">
        <td class="border border-gray-300 p-2 col-span-7">
            <Link
                :href="route('forum.show', props.forum.slug)"
                class="textLink font-semibold"
                >{{ props.forum?.title }}</Link
            >
        </td>
        <td class="border border-gray-300 p-2 col-span-1">
            <p class="font-semibold">{{ props.forum.topics.length }}</p>
        </td>
        <td class="border border-gray-300 p-2 col-span-1">
            <p class="font-semibold">Posts</p>
        </td>
        <td class="border border-gray-300 p-2 max-w-24">
            <Link :href="route('topic.show', latestTopic.slug)">
                <p
                    class="textLink font-semibold overflow-hidden text-ellipsis col-span-3 whitespace-nowrap"
                >
                    {{ latestTopic.title }}
                </p>
            </Link>
        </td>
    </tr>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    forum: Object,
});

const latestTopic = computed(() => {
    return props.forum.topics[0];
});
</script>
