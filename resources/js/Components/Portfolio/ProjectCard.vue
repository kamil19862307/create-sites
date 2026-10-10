<script setup>
defineProps({
    project: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <article class="group">
        <a
            :href="project.href"
            class="block"
        >
            <div
                class="relative aspect-[16/10] overflow-hidden bg-[#f5fff5]"
            >
                <img
                    :src="project.image"
                    :alt="project.name"
                    loading="lazy"
                    class="h-full w-full object-contain transition-transform duration-500 group-hover:scale-[1.02]"
                >
            </div>

            <div class="mt-5 flex items-start justify-between gap-6">
                <div>
                    <h3 class="text-xl font-medium tracking-tight">
                        {{ project.name }}
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        {{ project.description }}
                    </p>
                </div>

                <span
                    class="shrink-0 text-xl text-gray-400 transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1"
                >
                    ↗
                </span>
            </div>
        </a>
    </article>
</template>
