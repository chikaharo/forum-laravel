<template>
    <transition name="fade">
        <div v-if="show" class="dropdown">
            <div class="p-2 font-semibold text-gray-800">Notifications</div>
            <hr />
            <div
                v-if="notificationsCount == 0"
                class="py-4 flex items-center justify-center"
            >
                You have no notification
            </div>
            <div v-else class="flex flex-col mt-2">
                <div
                    v-for="notification in notifications"
                    :key="notification.id"
                    class="p-2 px-3 bg-white hover:bg-gray-50 flex items-center"
                >
                    New Post:
                    <Link
                        :href="
                            route('topic.show', notification.data.topic_slug)
                        "
                        class="inline-block max-w-[180px] whitespace-nowrap overflow-hidden text-ellipsis textLink"
                        >{{ notification.data.title }}</Link
                    >
                    <span class="block"> in your topic! </span>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
    show: Boolean,
});

const page = usePage();
const notificationsCount = computed(() =>
    Math.min(page.props.auth.user.data?.notificationsCount, 9)
);
const notifications = computed(() => page.props.auth.user.data?.notifications);
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
.dropdown {
    position: absolute;
    z-index: 10;
    top: 3rem;
    right: 0;
    display: flex;
    flex-direction: column;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    margin-top: 10px;
    max-width: 400px;
    min-width: 250px;
}
</style>
