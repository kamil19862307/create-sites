<script setup>
// photo: путь к фото клиента. Пока null — показывается заглушка.
const reviews = [
    {
        name: 'Имя клиента',
        meta: 'Название проекта',
        photo: null,
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    },
    {
        name: 'Имя клиента',
        meta: 'Название проекта',
        photo: null,
        text: 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
    },
    {
        name: 'Имя клиента',
        meta: 'Название проекта',
        photo: null,
        text: 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
    },
];
</script>

<template>
    <section id="reviews" class="scroll-mt-20">
        <h2 class="section-title">Отзывы</h2>

        <ul class="mt-8 space-y-5">
            <li v-for="(r, i) in reviews" :key="i" class="glass flex gap-4 rounded-2xl p-5">
                <img
                    v-if="r.photo"
                    :src="r.photo"
                    :alt="r.name"
                    class="h-14 w-14 shrink-0 rounded-full object-cover"
                />
                <span
                    v-else
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full border border-mint-400 bg-mint-200/60 text-mint-700"
                    aria-hidden="true"
                >
                    <svg viewBox="0 0 24 24" class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8" />
                    </svg>
                </span>
                <figure>
                    <blockquote class="text-sm leading-relaxed text-muted">{{ r.text }}</blockquote>
                    <figcaption class="mt-3 text-sm">
                        <span class="font-medium">{{ r.name }}</span>
                        <span class="text-muted">, {{ r.meta }}</span>
                    </figcaption>
                </figure>
            </li>
        </ul>
    </section>
</template>
