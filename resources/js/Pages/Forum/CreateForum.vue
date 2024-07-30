<template>
    <form @submit.prevent="onSubmit">
        <div class="p-4">
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
                <select v-model="form.category_id" class="inputText">
                    <option value="">Choose a category</option>
                    :value="category.id"
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.title }}
                    </option>
                </select>
                <div class="textError" v-if="form.errors.category_id">
                    {{ form.errors.category_id }}
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-primary">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
defineProps({
    categories: Array,
});

const form = useForm({
    title: "",
    desc: "",
    category_id: null,
});

const onSubmit = () => {
    console.log(form);
    form.post("/forum");
};
</script>
