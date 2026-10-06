<script setup>
import { Head } from '@inertiajs/vue3'

defineProps({
    title: String,
    message: String,
})
</script>
<template>
    <Head :title="title" />

    <main>
        <h1>КМ — Разработка сайтов</h1>

        <p>{{ message }}</p>
    </main>
</template>
