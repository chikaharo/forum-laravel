<template>
    <Filters :filters="filters" />
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        <Box v-for="order in orders.data" :key="order.id">
            <Link :href="`/orders/${order.id}`"> View this </Link>
            <template #title>{{ order.price }}</template>
            <div class="flex items-center text-sm">
                <span class="font-bold">{{ order.beds }}</span> bds &nbsp;
                <span class="font-bold">{{ order.baths }}</span> ba &nbsp;
                <span class="font-bold">{{ order.street_nr }}</span> m2 &nbsp;
            </div>
            <p class="text-sm text-gray-300">{{ order.street }}</p>
        </Box>
    </div>
    <div
        v-if="orders.data.length"
        class="mt-8 flex justify-center items-center"
    >
        <Pagination :links="orders.meta.links" />
    </div>
</template>

<script setup>
import Box from "../../Components/UI/Box.vue";
import Pagination from "../../Components/Pagination.vue";
import { Link } from "@inertiajs/vue3";
import Filters from "../../Components/Filters.vue";
defineProps(["orders", "filters"]);
// console.log("orders data: ", orders);
</script>
