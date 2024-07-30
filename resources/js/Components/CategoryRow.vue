<template>
    <div class="flex w-full flex-col mb-6">
        <div
            class="flex items-center p-4 bg-sky-500 rounded-t-md rounded-l-md rounded-r-md rounded-b-none"
        >
            <h3 class="text-3xl text-white">{{ category.title }}</h3>
        </div>
        <table
            class="bg-gray-100 table-auto border-collapse border border-gray-300"
        >
            <thead class="">
                <tr class="">
                    <th class="border border-gray-300 p-2">
                        <p class="font-semibold">Forum</p>
                    </th>
                    <th class="border border-gray-300 p-2">
                        <p class="font-semibold">Topic</p>
                    </th>
                    <th class="border border-gray-300 p-2">
                        <p class="font-semibold">Posts</p>
                    </th>
                    <th class="border border-gray-300 p-2">
                        <p class="font-semibold">Latest Post</p>
                    </th>
                </tr>
            </thead>
            <tbody
                v-if="!category.forums.length"
                class="flex justify-center items-center"
            >
                You have no forum in this category yet
            </tbody>
            <tbody v-else>
                <ForumRow
                    v-for="forum in category.forums"
                    :key="forum.id"
                    :forum="forum"
                />
            </tbody>
        </table>
    </div>
</template>

<script setup>
import ForumRow from "./ForumRow.vue";
defineProps({
    category: Object,
});
</script>
