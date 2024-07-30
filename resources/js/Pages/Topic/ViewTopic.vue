<template>
    <div>
        <div
            class="bg-gray-100 p-4 rounded-md flex items-center space-x-2 mb-4"
        >
            <Link class="textLink" href="/">{{
                topic?.data?.forum?.category?.title
            }}</Link>
            <span>/</span>
            <Link
                class="textLink"
                :href="route('forum.show', topic?.data?.forum?.slug)"
                >{{ topic?.data?.forum?.title }}</Link
            >
            <span>/</span>
            <Link
                class="textLink"
                :href="route('topic.show', topic?.data?.slug)"
                >{{ topic?.data?.title }}</Link
            >
            <span>/</span>
        </div>
        <PostCard
            :title="topic.data.title"
            :content="topic.data.desc"
            :created_at="topic.data.created_at"
            :author="topic.data.user"
            :image="topic.data.image"
            :first="true"
        />

        <PostCard
            v-for="post in posts.data"
            :key="post.id"
            :title="topic.title"
            :content="post.title"
            :created_at="post.created_at"
            :id="post.id"
            :slug="post.slug"
            :author="post.user"
        />

        <div class="my-4 flex w-full justify-end">
            <Pagination :links="posts.links" />
        </div>

        <!-- <form @submit.prevent="onSubmit"> -->
        <div>
            <!-- <label for="reply">Reply to this post</label>
                <textarea
                    v-model="form.title"
                    class="inputText"
                    rows="8"
                    name="reply"
                    id=""
                ></textarea> -->
            <Tiptap v-model="title" :viewOnly="false" />
            <div class="flex items-center gap-x-2 mt-4">
                <PrimaryButton @click="onSubmit">Submit reply</PrimaryButton>
                <SecondaryButton @click="notify">Reset</SecondaryButton>
            </div>
        </div>
        <!-- </form> -->
    </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import PostCard from "@/Components/PostCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Tiptap from "@/Components/Tiptap.vue";

import { useForm } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const props = defineProps(["topic", "posts"]);
const user = computed(() => page.props.auth.user);
const page = usePage();

const title = ref("");
const form = useForm({
    title: "",
    image: "",
    forum_id: props.topic?.data?.forum?.id ? props.topic.data.forum.id : null,
    topic_id: props.topic.data?.id ? props.topic.data.id : null,
});

const firstPost = computed(() => ({
    ...props.topic,
    title: props.topic.desc,
    topic: props.topic,
}));

const onSubmit = () => {
    console.log(form);
    // console.log(title.value);
    form.title = title.value;
    console.log("form after: ", form);
    form.post(route("posts.store"));
    if (!form.errors) {
        //  form.defaults();
    }
    form.reset();
    toast("Post comment successfully");
};

const notify = () => {
    toast("Wow so easy !");
};
</script>

<style lang="scss"></style>
