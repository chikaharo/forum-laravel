<template>
    <form @submit.prevent="onSubmit">
        <div class="grid grid-cols-3 gap-x-3 gap-y-4">
            <div>
                <label for="beds" class="label">Beds</label>
                <input
                    v-model="form.beds"
                    class="inputText"
                    id="beds"
                    type="number"
                />
            </div>
            <div>
                <label for="baths" class="label">Baths</label>
                <input
                    v-model="form.baths"
                    class="inputText"
                    id="baths"
                    type="number"
                />
            </div>
            <div>
                <label for="area" class="label">Area</label>
                <input class="inputText" id="area" type="number" />
            </div>
            <div class="col-span-2">
                <label for="city" class="label">City</label>
                <input
                    v-model="form.city"
                    class="inputText"
                    id="city"
                    type="text"
                />
            </div>
            <div>
                <label for="postcode" class="label">Postcode</label>
                <input
                    v-model="form.code"
                    class="inputText"
                    id="postcode"
                    type="text"
                />
            </div>
            <div class="col-span-2">
                <label for="street" class="label">Street</label>
                <input
                    v-model="form.street"
                    class="inputText"
                    id="street"
                    type="text"
                />
            </div>
            <div>
                <label for="street_nr" class="label">Street Nr</label>
                <input
                    v-model="form.street_nr"
                    class="inputText"
                    id="street_nr"
                    type="text"
                />
            </div>
            <div class="col-span-3">
                <label for="price" class="label">Price</label>
                <input
                    v-model="form.price"
                    class="inputText"
                    id="price"
                    type="text"
                />
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn-primary">Create</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    beds: "",
    baths: "",

    city: "",
    code: "",
    street: "",
    street_nr: "",
    price: "",
});

const onSubmit = () => {
    form.post("/orders");
};
</script>
