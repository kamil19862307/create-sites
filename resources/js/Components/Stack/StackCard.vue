<script setup>
defineProps({
    number: {
        type: String,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
})
</script>

<template>
    <article
        class="group border-t border-gray-300 py-6 transition-colors hover:border-gray-900"
    >
        <div class="flex items-start justify-between gap-6">
            <span class="text-sm text-gray-400">
                {{ number }}
            </span>

            <span
                class="text-2xl text-gray-300 transition-colors duration-300 group-hover:text-gray-900 group-hover:translate-x-1 group-hover:-translate-y-1"
            >
                ↗
            </span>
        </div>

        <h3
            class="mt-12 text-2xl font-medium tracking-tight md:text-3xl"
        >
            {{ name }}
        </h3>

        <p class="mt-3 max-w-xs text-sm leading-relaxed text-gray-500">
            {{ description }}
        </p>
    </article>
</template>
