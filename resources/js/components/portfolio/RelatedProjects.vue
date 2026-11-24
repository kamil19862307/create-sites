<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    projects: { type: Array, default: () => [] },
});
</script>

<template>
    <section v-if="projects.length" class="border-t border-line">
        <div class="mx-auto max-w-6xl px-5 py-16 sm:px-8 lg:py-20">
            <h2 class="section-title">Другие проекты</h2>

            <ul class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <li v-for="p in projects" :key="p.slug">
                    <Link :href="`/portfolio/${p.slug}`" class="group block">
                        <div class="glass aspect-[16/11] overflow-hidden rounded-2xl">
                            <img v-if="p.cover_image" :src="p.cover_image" :alt="p.title" class="h-full w-full object-cover" />
                            <div v-else class="flex h-full items-center justify-center text-mint-700/70" aria-hidden="true">
                                <svg viewBox="0 0 24 24" class="h-12 w-12" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="4" width="18" height="14" rx="2" />
                                    <path d="M3 9h18M8 21h8" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="mt-4 font-display text-xl group-hover:text-mint-700">{{ p.title }}</h3>
                        <p class="mt-1 line-clamp-2 leading-snug text-muted">{{ p.short_description }}</p>
                    </Link>
                </li>
            </ul>
        </div>
    </section>
</template>
