<script setup>
// image: путь к фото, например '/images/tech.jpg'. Пока null — показывается заглушка.
const image = '/images/technology-for-creating-sites.png';

const stack = ['PHP', 'Laravel', 'Vue', 'Docker', 'MySQL', 'REST API', 'HTML / CSS', 'JavaScript'];
</script>

<template>
    <section id="tech" class="mt-20 scroll-mt-20">
        <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
            <div class="glass aspect-[3/2] overflow-hidden rounded-3xl">
                <img v-if="image" :src="image" alt="Технологии для создания сайта" class="h-full w-full object-cover" />
                <div v-else class="flex h-full items-center justify-center text-mint-700/70" aria-hidden="true">
                    <svg viewBox="0 0 24 24" class="h-16 w-16" fill="none" stroke="currentColor" stroke-width="1">
                        <rect x="3" y="4" width="18" height="12" rx="2" />
                        <path d="M2 20h20M8 8l-2 2 2 2M16 8l2 2-2 2" />
                    </svg>
                </div>
            </div>

            <div>
                <h2 class="section-title">Технологии</h2>
                <p class="mt-4 font-display text-xl tracking-wide text-muted sm:text-2xl">Стек, с которым я работаю:</p>
<!--                <h2 class="section-title mt-3 text-4xl sm:text-5xl">Стек, с которым я работаю</h2>-->
                <p class="mt-6 max-w-md text-lg leading-relaxed text-muted">
                    Инструменты подбираю под задачу проекта, а не наоборот.
                </p>

                <ul class="mt-8 flex flex-wrap gap-3">
                    <li
                        v-for="tech in stack"
                        :key="tech"
                        class="rounded-full border border-line bg-white px-5 py-2.5 text-lg"
                    >
                        {{ tech }}
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>
