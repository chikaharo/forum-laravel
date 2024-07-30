<template>
    <table class="mb-4 w-full divide-y divide-y-300 border">
        <thead class="bg-gray-50">
            <tr class="grid grid-cols-12">
                <th class="col-span-3 py-4 px- border-r">
                    <span class="font-bold">by</span>
                    <Link href="#">
                        {{ props.author.name }}
                    </Link>
                </th>
                <th
                    class="col-span-9 py-4 px-4 flex items-center justify-between"
                >
                    <p>
                        <span class="font-bold">Post subject:</span>
                        {{ props.title }}
                    </p>
                    <p>
                        <span class="font-bold">Posted:</span
                        >{{ new Date(props.created_at).toDateString() }}
                    </p>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="grid grid-cols-12">
                <td class="col-span-3 py-4 px-4 flex flex-col border-r">
                    <p>
                        <span class="font-bold">Joined:</span>
                        {{ joinedDate }} days ago
                    </p>
                    <p><span class="font-bold">Posts:</span> 2022</p>
                </td>
                <td class="col-span-9 py-4 px-4">
                    <!-- <div
                        v-html="props.content"
                        class="flex w-full max-w-[500px] overflow-hidden"
                    ></div> -->
                    <Tiptap v-model="props.content" :viewOnly="true" />
                    <img v-if="image" :src="image" class="h-24 max-w-[400px]" />

                    <div class="flex items-center py-2 justify-end">
                        <div
                            v-if="canModifier && !first"
                            class="flex items-center gap-x-4"
                        >
                            <Link
                                :href="route('posts.edit', id)"
                                class="textLink flex items-center space-x-2"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                    />
                                </svg>

                                Edit
                            </Link>
                            <Link class="textLink flex items-center space-x-2">
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
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                    />
                                </svg>

                                Delete
                            </Link>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Tiptap from "./Tiptap.vue";
const props = defineProps({
    author: Object,
    content: String,
    title: String,
    created_at: String,
    image: String | null,
    id: String | Number,
    first: Boolean,
});
const page = usePage();

const joinedDate = computed(() => {
    return Math.floor(
        (new Date() - new Date(props.author.created_at)) / (1000 * 60 * 60 * 24)
    );
});
const canModifier = computed(() => {
    return (
        page.props.auth?.user?.data &&
        page.props.auth.user.data.id === props.author.id
    );
});
</script>

<style lang="scss" scoped>
ul,
ol {
    padding: 0 1rem;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    line-height: 1.1;
}

code {
    background-color: rgba(#616161, 0.1);
    color: #616161;
}

pre {
    background: #0d0d0d;
    color: #fff;
    font-family: "JetBrainsMono", monospace;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;

    code {
        color: inherit;
        padding: 0;
        background: none;
        font-size: 0.8rem;
    }
}

img {
    max-width: 100%;
    height: auto;
}

blockquote {
    padding-left: 1rem;
    border-left: 2px solid rgba(#0d0d0d, 0.1);
}

hr {
    border: none;
    border-top: 2px solid rgba(#0d0d0d, 0.1);
    margin: 2rem 0;
}
button {
    margin: 0 4px;
    border: 1px solid black;
    padding: 8px;
}
</style>
