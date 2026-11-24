<script setup>
import { computed } from 'vue';

// Принимает массив (cast 'array' / JSON-колонка) или строку через запятую: "Laravel, PHP, Vue.js".
const props = defineProps({
    technologies: { type: [Array, String], default: () => [] },
});

const list = computed(() => {
    const raw = props.technologies;

    return (Array.isArray(raw) ? raw : [raw])
        .flatMap((item) => String(item ?? '').split(','))
        .map((t) => t.trim())
        .filter(Boolean);
});
</script>

<template>
    <div v-if="list.length" class="glass rounded-2xl p-6">
        <h2 class="font-display text-xl">Использованные технологии</h2>

        <ul class="mt-5 flex flex-wrap gap-2">
            <li
                v-for="tech in list"
                :key="tech"
                class="rounded-full border border-line bg-white px-3.5 py-1.5 text-sm"
            >
                {{ tech }}
            </li>
        </ul>
    </div>
</template>
