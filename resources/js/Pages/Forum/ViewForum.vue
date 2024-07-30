<template>
    <div class="flex flex-col w-full">
        <div class="bg-gray-100 p-4 rounded-md flex items-center space-x-2">
            <Link class="textLink" href="/">{{
                props.forum.category.title
            }}</Link>
            <span>/</span>
            <Link class="textLink" href="#">{{ props.forum.title }}</Link>
            <span>/</span>
        </div>
        <div class="flex flex-col mt-4">
            <div
                class="flex p-6 bg-sky-500 items-center rounded-tl-md rounded-tr-md rounded-b-none"
            >
                <h3 class="text-2xl text-white">{{ props.forum?.title }}</h3>
            </div>

            <form @submit.prevent="onFilter" class="mt-4 mb-4">
                <div class="flex flex-col">
                    <div class="flex items-center w-full">
                        <div
                            class="flex items-center flex-1 bg-white border border-gray-300 px-4 py-2 mb-2 mr-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                />
                            </svg>
                            <input
                                type="text"
                                v-model="filtersForm.title"
                                class="border-none outline-none flex-1 ml-2 focus:border-none focus:outline-none focus:ring-0"
                                placeholder="Search a topic"
                            />
                        </div>
                        <PrimaryButton type="submit">Search</PrimaryButton>
                    </div>

                    <div class="flex items-center space-x-2">
                        <select
                            name="filterBy"
                            v-model="filtersForm.filterBy"
                            class="rounded-md w-48"
                        >
                            <option value="created_at">Date</option>
                            <option value="views">Views</option>
                            <option value="posts">Posts</option>
                        </select>

                        <select
                            name="filterType"
                            v-model="filtersForm.filterType"
                            class="rounded-md w-32"
                        >
                            <option value="desc">DESC</option>
                            <option value="asc">ASC</option>
                        </select>
                    </div>
                </div>
            </form>

            <table
                class="bg-gray-100 table-auto border-collapse border border-gray-300"
            >
                <thead class="">
                    <tr class="">
                        <th class="border border-gray-300 p-2">
                            <p class="font-semibold">Topic</p>
                        </th>
                        <th class="border border-gray-300 p-2">
                            <p class="font-semibold">Created</p>
                        </th>
                        <th class="border border-gray-300 p-2">
                            <p class="font-semibold">Statitics</p>
                        </th>
                        <th class="border border-gray-300 p-2">
                            <p class="font-semibold">Latest Post</p>
                        </th>
                    </tr>
                </thead>

                <tbody
                    v-if="!props.topics.data.length"
                    class="flex justify-center items-center p-4"
                >
                    You have no topic in this forum yet
                </tbody>
                <tbody v-else>
                    <TopicRow
                        v-for="topic in props.topics.data"
                        :key="topic.id"
                        :topic="topic"
                    />
                </tbody>
            </table>
        </div>

        <div class="flex mt-4 items-center">
            <Pagination class="flex-1" :links="props.topics.meta.links" />

            <ButtonNavLink
                class="ml-auto"
                :href="route('topic.create', props.forum.slug)"
                >New Topic</ButtonNavLink
            >
        </div>
    </div>
</template>

<script setup>
import Pagination from "@/Components/Pagination.vue";
import TopicRow from "@/Components/TopicRow.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import ButtonNavLink from "@/Components/ButtonNavLink.vue";
import { computed } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    forum: Object,
    topics: Object,
    filters: Object,
});
const page = usePage();
const user = computed(() => page.props.auth.user);
const filtersForm = useForm({
    title: props.filters?.title ? props.filters.title : "",
    filterBy: props.filters?.filterBy ? props.filters.filterBy : "",
    filterType: props.filters?.filterType ? props.filters.filterType : "desc",
});

const onFilter = () => {
    filtersForm.get(route("forum.show", props.forum.slug));
};
</script>
