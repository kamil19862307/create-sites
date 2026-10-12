<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { site } from '../data/site';

const open = ref(false);
const close = () => (open.value = false);
const onKey = (e) => e.key === 'Escape' && close();

onMounted(() => window.addEventListener('keydown', onKey));
onUnmounted(() => window.removeEventListener('keydown', onKey));
</script>

<template>
    <header class="sticky top-0 z-50 border-b border-line bg-white/85 backdrop-blur">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5 sm:px-8">
            <a href="#top" class="font-display text-lg tracking-wide" @click="close">{{ site.name }}</a>

            <nav class="hidden md:block" aria-label="Основное меню">
                <ul class="flex items-center gap-8 text-sm text-muted">
                    <li v-for="item in site.nav" :key="item.href">
                        <a :href="item.href" class="transition-colors hover:text-ink">{{ item.label }}</a>
                    </li>
                </ul>
            </nav>

            <button
                type="button"
                class="-mr-2 flex h-10 w-10 items-center justify-center rounded-lg md:hidden"
                :aria-expanded="open"
                aria-controls="mobile-menu"
                aria-label="Меню"
                @click="open = !open"
            >
                <span class="relative block h-4 w-6">
                    <span
                        class="absolute left-0 h-px w-6 bg-ink transition-all"
                        :class="open ? 'top-2 rotate-45' : 'top-0'"
                    />
                    <span
                        class="absolute left-0 top-2 h-px w-6 bg-ink transition-opacity"
                        :class="open ? 'opacity-0' : 'opacity-100'"
                    />
                    <span
                        class="absolute left-0 h-px w-6 bg-ink transition-all"
                        :class="open ? 'top-2 -rotate-45' : 'top-4'"
                    />
                </span>
            </button>
        </div>

        <nav v-show="open" id="mobile-menu" class="border-t border-line bg-white md:hidden" aria-label="Мобильное меню">
            <ul class="mx-auto max-w-6xl px-5 py-2 sm:px-8">
                <li v-for="item in site.nav" :key="item.href">
                    <a :href="item.href" class="block py-3 text-muted hover:text-ink" @click="close">
                        {{ item.label }}
                    </a>
                </li>
            </ul>
        </nav>
    </header>
</template>
