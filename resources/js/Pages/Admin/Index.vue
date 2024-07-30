<template>
    <div class="w-full h-full flex flex-col">
        <div class="bg-white p-4 rounded-md flex items-center space-x-2 mb-4">
            <Link class="textLink" href="/">{{
                topic?.data?.forum?.category?.title
            }}</Link>
            <span>/</span>
            <Link class="textLink">{{ topic?.data?.forum?.title }}</Link>
            <span>/</span>
            <Link class="textLink">{{ topic?.data?.title }}</Link>
            <span>/</span>
        </div>
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6"
        >
            <div
                class="flex items-center gap-x-6 p-6 py-10 bg-slate-600 hover:bg-slate-600/80 text-white font-bold text-2xl"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-12"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"
                    />
                </svg>
                <div class="flex flex-col gap-y-2">
                    <div>
                        {{ categoriesCount }}
                    </div>
                    Categories
                </div>
            </div>
            <div
                class="flex items-center gap-x-6 p-6 py-10 bg-amber-600 hover:bg-amber-600/80 text-white font-bold text-2xl"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-12"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                    />
                </svg>

                <div class="flex flex-col gap-y-2">
                    <div>{{ usersCount }}</div>
                    Users
                </div>
            </div>
            <div
                class="flex items-center gap-x-6 p-6 py-10 bg-sky-950 hov text-white font-bold text-2xl hover:bg-sky-950/75"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-12"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"
                    />
                </svg>
                <div class="flex flex-col">
                    <div>{{ forumsCount }}</div>
                    Forums
                </div>
            </div>
            <div
                class="flex items-center gap-x-6 p-6 py-10 bg-emerald-600 hover:bg-emerald-600/80 text-white font-bold text-2xl"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-12"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"
                    />
                </svg>

                <div class="flex flex-col gap-y-2">
                    <div>{{ topicsCount }}</div>
                    Topics
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps(["forumsCount", "usersCount", "categoriesCount", "topicsCount"]);
</script>

<script>
import AdminLayout from "../../Components/UI/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
