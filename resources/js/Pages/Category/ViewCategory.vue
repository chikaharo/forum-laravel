<template>
    <div>Hello, view for category</div>
    <pre>{{ category }}</pre>
</template>

<script setup>
defineProps({
    category: Object,
});
</script>
