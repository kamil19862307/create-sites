<script setup>
const facts = [
    {
        name: 'Laravel',
        description: 'Backend',
    },
    {
        name: 'Vue',
        description: 'Frontend',
    },
    {
        name: 'MySQL',
        description: 'Database',
    },
    {
        name: 'Docker',
        description: 'Deployment',
    },
]
</script>

<template>
    <section class="border-b border-gray-200 bg-[#f5fff5]">
        <div class="mx-auto max-w-7xl px-6 py-20 md:py-28">
            <div class="grid gap-12 md:grid-cols-[0.7fr_1.3fr]">
                <div>
                    <p
                        class="text-sm font-medium uppercase tracking-[0.2em] text-gray-500"
                    >
                        Обо мне
                    </p>

                    <h2
                        class="mt-6 max-w-md text-5xl font-semibold leading-[0.95] tracking-[-0.04em] md:text-7xl"
                    >
                        Разрабатываю
                        <br>
                        сайты
                        <br>
                        с нуля
                    </h2>
                </div>

                <div>
                    <div class="max-w-2xl">
                        <p
                            class="text-2xl leading-relaxed tracking-tight md:text-3xl"
                        >
                            Создаю современные сайты и веб-приложения,
                            которые не просто выглядят хорошо, а решают
                            конкретные задачи бизнеса.
                        </p>

                        <p
                            class="mt-8 max-w-xl text-base leading-relaxed text-gray-500"
                        >
                            Работаю с Laravel, Vue и MySQL. Беру проект
                            от идеи и структуры до разработки, настройки
                            сервера и запуска.
                        </p>

                        <a
                            href="/about"
                            class="mt-8 inline-flex items-center border-b border-gray-900 pb-1 text-sm font-medium"
                        >
                            Подробнее обо мне
                            <span class="ml-3">↗</span>
                        </a>
                    </div>

                    <div
                        class="mt-16 grid grid-cols-2 border-t border-gray-300 sm:grid-cols-4"
                    >
                        <div
                            v-for="fact in facts"
                            :key="fact.name"
                            class="border-b border-gray-300 py-5 sm:border-b-0"
                        >
                            <p class="text-lg font-medium">
                                {{ fact.name }}
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ fact.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
