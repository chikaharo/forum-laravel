<template>
    <form @submit.prevent="onSubmit">
        <div class="flex flex-col">
            <div class="bg-gray-100 p-4 rounded-md flex items-center space-x-2">
                <Link class="textLink" href="/">
                    {{ props.forum.category.title }}</Link
                >
                <span>/</span>
                <Link class="textLink" href="#">{{ props.forum.title }}</Link>
                <span>/</span>
            </div>
            <h1 class="text-center">Create New Topic</h1>
            <div class="mb-4">
                <label for="title" class="label">Title</label>
                <input
                    v-model="form.title"
                    class="inputText"
                    id="title"
                    type="text"
                />
                <div class="textError" v-if="form.errors.title">
                    {{ form.errors.title }}
                </div>
            </div>
            <div class="mb-4">
                <label for="image" class="label">Post Image</label>
                <input
                    :value="form.image"
                    @change="onFileChange"
                    class="block w-full"
                    id="image"
                    type="file"
                    accept="image/jpeg, image/png, image/jpg, image/gif"
                />
                <div class="textError" v-if="form.errors.title">
                    {{ form.errors.title }}
                </div>
            </div>
            <div class="mb-4">
                <label for="description" class="label">Description</label>
                <textarea
                    rows="3"
                    v-model="form.desc"
                    class="inputText"
                    id="description"
                />
                <div class="textError" v-if="form.errors.desc">
                    {{ form.errors.desc }}
                </div>
            </div>
            <div class="mb-4">
                <input
                    type="checkbox"
                    id="notify"
                    name="notify"
                    v-model="form.notify"
                />
                <label for="notify" class="label ml-2">Receive Notify</label>
            </div>

            <div class="mt-4">
                <PrimaryButton type="submit" class="btn-primary">
                    Create new topic
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    forum: Object,
});

const form = useForm({
    title: "",
    desc: "",
    image: "",
    notify: false,
    forum_id: props.forum.id,
});

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            form.image = e.target?.result;
        };

        reader.readAsDataURL(file);
    }
};

const onSubmit = () => {
    form.post(route("topic.store"));
};
</script>
