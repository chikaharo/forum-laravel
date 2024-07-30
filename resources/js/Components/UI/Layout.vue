<template>
    <Header @toggleShowModal="toggleShowNotifications" />
    <Notifications :show="isShowNotifications" />
    <main class="bg-white text-gray-600">
        <div class="container mx-auto p-4 w-full min-h-screen"><slot /></div>
    </main>
</template>
<script setup>
import { computed, ref, watch } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Header from "./Header.vue";
import { usePage } from "@inertiajs/vue3";
import Notifications from "@/Components/Notifications.vue";

// defineProps(["user"]);

const page = usePage();
const isShowNotifications = ref(false);

const toggleShowNotifications = () =>
    (isShowNotifications.value = !isShowNotifications.value);

watch(page.props.flash, () => {
    if (page.props.flash.message) {
        console.log("Flash message change");
        toast(page.props.flash.message);
    }
});
</script>

<style scoped></style>
