<template>
    <header class="bg-white text-gray-600">
        <div class="p-4 border-gray-300 border">
            <nav class="flex w-full items-center justify-between">
                <Link href="/orders">Orders</Link>
                <Link href="/" class="flex-1">Home</Link>
                <div>
                    <div v-if="!user" class="flex items-center gap-x-2">
                        <Link
                            href="/login"
                            class="px-4 py-2 border border-indigo-500 bg-white hover:bg-indigo-500 hover:text-white rounded-md"
                            >Login
                        </Link>
                        <Link
                            href="register"
                            class="px-4 py-2 border border-indigo-500 bg-white hover:bg-indigo-500 hover:text-white rounded-md"
                            >Register</Link
                        >
                    </div>
                    <div
                        v-else
                        class="flex items-center gap-x-3"
                        @click="emit('toggleShowModal')"
                    >
                        <p>{{ user?.name }}</p>
                        <div class="relative cursor-pointer">
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
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                                />
                            </svg>
                            <span
                                class="absolute -top-1 -right-1 h-4 w-4 flex justify-center items-center font-semibold text-sm rounded-full bg-red-500 text-white"
                                >{{ notificationsCount }}</span
                            >
                        </div>

                        <Link
                            href="/orders/create"
                            as="button"
                            class="btn-primary"
                            >Create New Order</Link
                        >
                        <Link href="/logout" method="delete">Log out</Link>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const emit = defineEmits(["toggleShowModal"]);

const page = usePage();
const user = computed(() => page.props.auth.user?.data);
const notificationsCount = computed(() =>
    Math.min(page.props.auth.user.data?.notificationsCount, 9)
);
</script>
