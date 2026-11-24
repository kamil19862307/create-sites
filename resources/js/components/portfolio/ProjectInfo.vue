<script setup>

const props = defineProps({
    project: { type: Object, required: true },
});

</script>

<template>
    <div>
        <h1 class="font-display text-3xl font-light leading-tight tracking-wide sm:text-4xl lg:text-5xl">
            {{ project.title }}
        </h1>

        <p v-if="project.short_description" class="mt-6 max-w-2xl text-lg leading-relaxed">
            {{ project.short_description }}
        </p>

        <div
            v-if="project.description"
            class="mt-8 max-w-2xl space-y-4 leading-relaxed text-muted project-description"
            v-html="project.description"
        ></div>

        <div v-if="project.website_url || project.github_url" class="mt-10 flex flex-wrap gap-4">
            <a v-if="project.website_url" :href="project.website_url" target="_blank" rel="noopener noreferrer" class="btn-mint">
                Посмотреть сайт
            </a>
            <a v-if="project.github_url" :href="project.github_url" target="_blank" rel="noopener noreferrer" class="btn-ghost">
                Исходный код на GitHub
            </a>
        </div>
    </div>
</template>
