<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';

// projects приходят с сервера: { id, title, slug, short_description, cover_image } (см. PortfolioProject::toCard)
defineProps({
    projects: { type: Array, default: () => [] },
});

const GAP = 20; // должен совпадать с gap-5 (1.25rem) в шаблоне
const track = ref(null);
const canPrev = ref(false);
const canNext = ref(true);

function update() {
    const el = track.value;
    if (!el) return;
    canPrev.value = el.scrollLeft > 4;
    canNext.value = el.scrollLeft + el.clientWidth < el.scrollWidth - 4;
}

function scrollByPage(dir) {
    const el = track.value;
    if (!el) return;
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    el.scrollBy({ left: dir * (el.clientWidth + GAP), behavior: reduce ? 'auto' : 'smooth' });
}

let observer;
onMounted(() => {
    update();
    observer = new ResizeObserver(update);
    observer.observe(track.value);
});
onUnmounted(() => observer?.disconnect());
</script>

<template>
    <section id="portfolio" class="min-w-0 scroll-mt-20">
        <div class="flex items-end justify-between gap-4">
            <h2 class="section-title">Портфолио</h2>

            <div class="flex gap-2">
                <button
                    type="button"
                    class="glass flex h-11 w-11 items-center justify-center rounded-full transition-colors hover:border-mint-400 disabled:opacity-40 disabled:hover:border-white/90"
                    aria-label="Предыдущие проекты"
                    :disabled="!canPrev"
                    @click="scrollByPage(-1)"
                >
                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M15 5l-7 7 7 7" />
                    </svg>
                </button>
                <button
                    type="button"
                    class="glass flex h-11 w-11 items-center justify-center rounded-full transition-colors hover:border-mint-400 disabled:opacity-40 disabled:hover:border-white/90"
                    aria-label="Следующие проекты"
                    :disabled="!canNext"
                    @click="scrollByPage(1)"
                >
                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <ul
            ref="track"
            class="mt-8 -mb-8 flex snap-x snap-mandatory gap-5 overflow-x-auto pb-8 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
            aria-label="Проекты"
            @scroll.passive="update"
        >
            <li v-for="p in projects" :key="p.slug" class="w-full shrink-0 snap-start sm:w-[calc(50%-0.625rem)]">
                <Link :href="`/portfolio/${p.slug}`" class="group block">
                    <div class="glass aspect-[16/11] overflow-hidden rounded-2xl">
                        <img v-if="p.cover_image" :src="p.cover_image" :alt="p.title" class="h-full w-full object-cover" />
                        <div v-else class="flex h-full items-center justify-center text-mint-700/70" aria-hidden="true">
                            <svg viewBox="0 0 24 24" class="h-14 w-14" fill="none" stroke="currentColor" stroke-width="1">
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
    </section>
</template>
