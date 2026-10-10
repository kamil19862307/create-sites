<script setup>
import ProjectCard from './ProjectCard.vue'

const projects = [
    {
        name: 'Printerimfu.ru',
        description: 'Каталог восстановленной техники',
        href: '/portfolio/printerimfu',
        image: '/images/portfolio/printerimfu.png',
    },
    {
        name: 'Printerimfu.ru',
        description: 'Каталог восстановленной техники',
        href: '/portfolio/printerimfu',
        image: '/images/portfolio/printerimfu.png',
    },
]
</script>

<template>
    <section
        id="portfolio"
        class="border-b border-gray-200"
    >
        <div class="mx-auto max-w-7xl px-6 py-20 md:py-28">
            <div class="flex flex-col justify-between gap-8 md:flex-row md:items-end">
                <div>
                    <p
                        class="text-sm font-medium uppercase tracking-[0.2em] text-gray-500"
                    >
                        Портфолио
                    </p>

                    <h2
                        class="mt-6 max-w-2xl text-5xl font-semibold leading-[0.95] tracking-[-0.04em] md:text-7xl"
                    >
                        Избранные
                        <br>
                        проекты
                    </h2>
                </div>

                <a
                    href="/portfolio"
                    class="inline-flex w-fit items-center border-b border-gray-900 pb-1 text-sm font-medium"
                >
                    Все проекты
                    <span class="ml-3">↗</span>
                </a>
            </div>

            <div class="mt-16 grid gap-12 md:grid-cols-2">
                <ProjectCard
                    v-for="project in projects"
                    :key="project.name"
                    :project="project"
                />
            </div>
        </div>
    </section>
</template>
