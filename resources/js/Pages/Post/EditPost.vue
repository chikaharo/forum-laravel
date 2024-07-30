<template>
    <form @submit.prevent="onSubmit">
        <div class="flex flex-col">
            <!-- <div class="bg-gray-100 p-4 rounded-md flex items-center space-x-2">
                <Link class="textLink" href="/">
                    {{ props.post.data.forum.category.title }}</Link
                >
                <span>/</span>
                <Link class="textLink" href="#">{{ props.post.data.forum.title }}</Link>
                <span>/</span>
            </div> -->
            <h1 class="text-center">Edit A Post</h1>
            <div class="mb-4">
                <label for="title" class="label">Title</label>
                <textarea
                    rows="3"
                    v-model="form.title"
                    class="inputText"
                    id="title"
                />
                <div class="textError" v-if="form.errors.title">
                    {{ form.errors.title }}
                </div>
            </div>
            <div class="mb-4">
                <label for="image" class="label">Post Image</label>
                <div v-if="props.post.data.image" class="block">
                    <img
                        :src="props.post.data.image"
                        class="max-h-[400px]"
                        alt=""
                    />
                </div>
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

            <div class="mt-4">
                <PrimaryButton type="submit" class="btn-primary">
                    Update
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    post: Object,
});

const form = useForm({
    title: props.post.data.title ? props.post.data.title : "",
    image: props.post.data.image ? props.post.data.image : "",
    topic_id: props.post.data.topic.id ? props.post.data.topic.id : "",
    user_id: props.post.data.user.id ? props.post.data.user.id : "",
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
    form.put(route("posts.update", props.post.data.id));
    console.log("form onSubmit: ", form);
};
</script>
