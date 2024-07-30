<template>
    <form @submit.prevent="onFilter">
        <div class="mt-4 mb-8 flex flex-wrap gap-x-2 items-center">
            <!-- price filter -->
            <div class="flex items-center flex-wrap">
                <input
                    type="text"
                    v-model="filterForm.priceFrom"
                    class="inputL"
                    placeholder="Price from"
                />
                <input
                    type="text"
                    v-model="filterForm.priceTo"
                    class="inputR"
                    placeholder="Price to"
                />
            </div>

            <div class="flex items-center flex-wrap">
                <select class="inputL" v-model="filterForm.beds">
                    <option value="">Beds</option>
                    <option v-for="i in 5" :key="i" :value="i">{{ i }}</option>
                    <option value="6">6+</option>
                </select>
                <select class="inputR" v-model="filterForm.baths">
                    <option value="">Baths</option>
                    <option v-for="i in 5" :key="i" :value="i">{{ i }}</option>
                    <option value="6">6+</option>
                </select>
            </div>

            <div class="flex items-center flex-wrap">
                <input type="text" class="inputL" placeholder="Area from" />
                <input type="text" class="inputR" placeholder="Area to" />
            </div>

            <!-- buttons -->
            <div class="flex items-center flex-wrap gap-x-2">
                <button type="submit">Filter</button>
                <button @click="clear">Clear</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const filters = defineProps(["filters"]);

const filterForm = useForm({
    priceFrom: filters.priceFrom ? filters.priceFrom : null,
    priceTo: filters.priceTo ? filters.priceTo : null,
    beds: filters.beds ? filters.beds : null,
    baths: filters.baths ? filters.baths : null,
});

const onFilter = () => {
    filterForm.get("/orders", {
        preserveScroll: true,
        preserveState: true,
    });
};

const clear = () => {
    (filterForm.baths = null),
        (filterForm.beds = null),
        (filterForm.priceFrom = null),
        (filterForm.priceTo = null),
        onFilter();
};
</script>
