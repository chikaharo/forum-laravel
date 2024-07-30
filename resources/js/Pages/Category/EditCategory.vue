<template>
    <form @submit.prevent="onSubmit">
        <div class="">
            <div class="mb-4">
                <label for="title" class="label">Title</label>
                <input
                    v-model="form.title"
                    class="inputText"
                    id="title"
                    type="text"
                />
            </div>
            <div class="mb-4">
                <label for="description" class="label">Description</label>
                <textarea
                    rows="3"
                    v-model="form.desc"
                    class="inputText"
                    id="description"
                />
            </div>
            <div class="mt-2 flex items-center gap-x-3">
                <svg
                    class="h-12 w-12 text-gray-300"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <path
                        fill-rule="evenodd"
                        d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                        clip-rule="evenodd"
                    />
                </svg>
                <img
                    v-if="form.image"
                    :src="form.image"
                    alt=""
                    class="h-12 w-12 rounded-full object-cover"
                />
                <button
                    type="button"
                    class="relative ml-6 px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm rounded-md border border-gray-300 hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    <input
                        @change="onFileChange"
                        type="file"
                        name="image"
                        class="absolute inset-0 opacity-0 cursor-pointer"
                    />
                    Change
                </button>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-primary">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    category: Object,
});

const form = useForm({
    title: props.category?.title ? props.category.title : "",
    desc: props.category?.desc ? props.category.desc : "",
    image: props.category?.image ? props.category.image : "",
});

const onSubmit = () => {};
</script>
