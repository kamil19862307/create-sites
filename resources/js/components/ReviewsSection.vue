<script setup>
defineProps({
    reviews: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <section id="reviews" class="scroll-mt-20">
        <h2 class="section-title">Отзывы</h2>

        <ul v-if="reviews.length" class="mt-8 space-y-5">
            <li
                v-for="review in reviews"
                :key="review.id"
                class="glass flex gap-4 rounded-2xl p-5"
            >
                <img
                    v-if="review.avatar"
                    :src="review.avatar"
                    :alt="review.name"
                    class="h-14 w-14 shrink-0 rounded-full object-cover"
                />

                <span
                    v-else
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full border border-mint-400 bg-mint-200/60 text-mint-700"
                    aria-hidden="true"
                >
                    <svg
                        viewBox="0 0 24 24"
                        class="h-7 w-7"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1"
                    >
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8" />
                    </svg>
                </span>

                <figure class="min-w-0">
                    <blockquote class="text-sm leading-relaxed text-muted">
                        {{ review.content }}
                    </blockquote>

                    <figcaption class="mt-3 text-sm">
                        <span class="font-medium">{{ review.name }}</span>
                        <span class="text-muted">, {{ review.meta }}</span>
                    </figcaption>
                </figure>
            </li>
        </ul>

        <p v-else class="mt-8 text-sm text-muted">
            Отзывы скоро появятся.
        </p>
    </section>
</template>
