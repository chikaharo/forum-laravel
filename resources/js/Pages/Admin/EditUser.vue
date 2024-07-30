<template>
    <form @submit.prevent="onSubmit">
        <div class="">
            <div class="mb-4">
                <label for="email" class="label">Email</label>
                <input
                    v-model="form.email"
                    class="inputText"
                    id="email"
                    type="email"
                />
            </div>
            <div class="mb-4">
                <label for="name" class="label">Name</label>
                <input v-model="form.name" class="inputText" id="name" />
            </div>
            <div class="mb-4">
                <label for="bio" class="label">Bio</label>
                <input v-model="form.bio" class="inputText" id="bio" />
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

            <div class="mb-4 flex items-center mt-4">
                <input
                    type="checkbox"
                    v-model="form.isAdmin"
                    class="focus:ring-1 focus:ring-indigo-500 focus:bg-indigon-500 focus:ring-offset-1"
                    id="isAdmin"
                />
                <label for="isAdmin" class="label ml-2">Is Admin</label>
            </div>
            <div class="mt-4">
                <PrimaryButton type="submit" class="btn-primary"
                    >Update</PrimaryButton
                >
            </div>
        </div>
    </form>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    user: Object,
});

const form = useForm({
    email: props.user?.data.email ? props.user.data.email : "",
    name: props.user?.data.name ? props.user.data.name : "",
    image: props.user?.data.image ? props.user.data.image : "",
    bio: props.user?.data.bio ? props.user.data.bio : "",
    isAdmin: props.user?.data.isAdmin ? props.user.data.isAdmin : false,
});

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            form.image = e.target.result;
        };

        reader.readAsDataURL(file);
    }
};

const onSubmit = () => {
    console.log(form);
};
</script>
