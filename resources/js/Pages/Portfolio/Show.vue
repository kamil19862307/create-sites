<script setup>
import { Head } from '@inertiajs/vue3';
import SiteHeader from '../../components/SiteHeader.vue';
import SiteFooter from '../../components/SiteFooter.vue';
import ProjectGallery from '../../components/portfolio/ProjectGallery.vue';
import ProjectInfo from '../../components/portfolio/ProjectInfo.vue';
import ProjectTechnologies from '../../components/portfolio/ProjectTechnologies.vue';
import RelatedProjects from '../../components/portfolio/RelatedProjects.vue';


defineProps({
    project: { type: Object, required: true },
    related: { type: Array, default: () => [] },
});
</script>

<template>
    <Head :title="project.title" />

    <SiteHeader />

    <!-- Верхняя полоса с галереей: мягкий мятный оттенок вместо баннера главной -->
    <section class="bg-gradient-to-b from-mist to-white">
        <div class="mx-auto max-w-6xl px-5 pb-12 pt-5 sm:px-8 lg:pb-16">
            <a href="/#portfolio" class="inline-flex items-center gap-2 py-2 text-sm text-muted transition-colors hover:text-ink">
                <span aria-hidden="true">←</span>
                Все проекты
            </a>

            <div class="mt-3">
                <ProjectGallery :images="project.images" :cover="project.cover_image" :title="project.title" />
            </div>
        </div>
    </section>

    <div class="mx-auto grid max-w-6xl gap-12 px-5 pb-16 sm:px-8 lg:grid-cols-[minmax(0,1fr)_21rem] lg:gap-16 lg:pb-24">
        <ProjectInfo :project="project" />

        <aside class="lg:sticky lg:top-24 lg:self-start">
            <ProjectTechnologies :technologies="project.technologies" />
        </aside>
    </div>

    <RelatedProjects :projects="related" />

    <SiteFooter />
</template>
