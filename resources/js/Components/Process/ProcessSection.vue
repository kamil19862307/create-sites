<script setup>
const steps = [
    {
        number: '01',
        title: 'Обсуждаем задачу',
        description: 'Разбираемся, что нужно сайту и какие задачи он должен решать.',
    },
    {
        number: '02',
        title: 'Продумываем структуру',
        description: 'Определяем страницы, блоки и пользовательский сценарий.',
    },
    {
        number: '03',
        title: 'Разрабатываю',
        description: 'Собираю рабочий сайт на Laravel и Vue, подключаю базу данных и необходимую логику.',
    },
    {
        number: '04',
        title: 'Размещаем',
        description: 'Настраиваем сервер, домен, SSL и выкладываем проект в интернет.',
    },
    {
        number: '05',
        title: 'Сайт готов',
        description: 'Проверяем результат и передаём готовый проект.',
    },
]
</script>

<template>
    <section class="relative border-b border-gray-200">
        <div
            class="pointer-events-none absolute right-0 top-0 hidden h-64 w-64 translate-x-1/3 -translate-y-1/3 rotate-45 border border-gray-900/10 md:block"
            aria-hidden="true"
        ></div>
        <div class="mx-auto max-w-7xl px-6 py-20 md:py-28">
            <div class="grid gap-12 md:grid-cols-[0.7fr_1.3fr]">
                <div>
                    <p
                        class="text-sm font-medium uppercase tracking-[0.2em] text-gray-500"
                    >
                        Процесс
                    </p>

                    <h2
                        class="mt-6 max-w-md text-5xl font-semibold leading-[0.95] tracking-[-0.04em] md:text-7xl"
                    >
                        От идеи
                        <br>
                        до готового
                        <br>
                        сайта
                    </h2>
                </div>

                <div>
                    <article
                        v-for="step in steps"
                        :key="step.number"
                        class="grid gap-4 border-t border-gray-300 py-7 md:grid-cols-[80px_1fr]"
                    >
                        <span class="text-sm text-gray-400">
                            {{ step.number }}
                        </span>

                        <div>
                            <h3
                                class="text-2xl font-medium tracking-tight md:text-3xl"
                            >
                                {{ step.title }}
                            </h3>

                            <p
                                class="mt-3 max-w-xl text-sm leading-relaxed text-gray-500 md:text-base"
                            >
                                {{ step.description }}
                            </p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</template>
