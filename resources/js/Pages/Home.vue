<template>
    <div class="w-full min-h-screen py-4 flex space-x-9">
        <div class="flex-1">
            <div
                v-if="!categories?.length"
                class="text-center text-bold text-3xl"
            >
                Your forum is empty
            </div>
            <CategoryRow
                v-else
                v-for="category in categories"
                :key="category.id"
                :id="category.slug"
                :category="category"
            />
        </div>
        <div class="flex flex-col sticky">
            <div class="bg-white p-4 pr-12 mb-6 shadow-md flex flex-col">
                <h4 class="text-2xl font-semibold mb-2">Member Online</h4>
                <Link class="linkText" v-for="i in 5">Member name</Link>
            </div>
            <div class="bg-white shadow-md flex flex-col">
                <div class="p-4 pr-12 flex flex-col">
                    <h4 class="text-2xl font-semibold mb-2">
                        Member Statistics
                    </h4>
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold">Total Categories:</span>
                        3
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold">Total Forums:</span>
                        3
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold">Total Topics:</span>
                        3
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold">Total Nenbers:</span>
                        3
                    </div>
                </div>
                <div class="p-4 bg-gray-100 flex flex-col">
                    <p class="block">Newest Member</p>
                    <Link class="linkText" href="#">Okanji</Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import CategoryRow from "../Components/CategoryRow.vue";
defineProps({
    categories: Array,
});
</script>
