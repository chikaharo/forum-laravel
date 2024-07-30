<template>
    <form @submit.prevent="onSubmit">
        <div class="">
            <div class="mb-4">
                <label for="title" class="label">Title</label>
                <input v-model="form.title" class="inputText" id="title" />
            </div>
            <div class="mb-4">
                <label for="desc" class="label">Description</label>
                <input v-model="form.desc" class="inputText" id="desc" />
            </div>

            <div class="mb-4 mt-4">
                <label for="isAdmin" class="label block">Category</label>

                <select
                    v-model="form.category_id"
                    class="inputText"
                    id="Category"
                >
                    <option :value="form.category_id">
                        {{ props.forum?.data?.category.title }}
                    </option>
                    <option
                        v-for="category in categories.filter(
                            (cat) => cat.id !== props.forum?.data?.category.id
                        )"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.title }}
                    </option>
                </select>
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
    forum: Object,
    categories: Array,
});

const form = useForm({
    title: props.forum?.data.title ? props.forum.data.title : "",
    desc: props.forum?.data.desc ? props.forum.data.desc : "",
    category_id: props.forum?.data.category ? props.forum.data.category.id : "",
    // user_id: props.forum?.data.user.id ? props.forum.data.user.id : "",
});

const onSubmit = () => {
    // console.log(form);
    form.put(route("admin.forums.update", props.forum.data.id));
};
</script>
