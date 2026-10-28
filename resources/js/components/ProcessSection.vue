<script setup>
const steps = [
    { title: 'Обсуждение задачи', text: 'Узнаём задачу, аудиторию и цель сайта. Фиксируем объём и ожидания.' },
    { title: 'Проектирование', text: 'Собираем структуру страниц и визуальное решение до начала вёрстки.' },
    { title: 'Разработка', text: 'Пишем код, подключаем логику, делаем панель сайтом' },
    { title: 'Тестирование и контент', text: 'Проверяем на разных устройствах и наполняем сайт нужным контентом' },
    { title: 'Запуск и поддержка', text: 'Покупаем хостинг, доменное имя и выпускаем сайт в мир' },
];
</script>

<template>
    <section id="process" class="scroll-mt-20">
        <h2 class="section-title">Процесс работы</h2>

        <ol
            class="relative mt-8 space-y-7 before:absolute before:bottom-4 before:left-4 before:top-4 before:w-px before:-translate-x-1/2 before:bg-line"
        >
            <li v-for="(step, i) in steps" :key="step.title" class="relative pl-14">
                <span
                    class="absolute left-0 top-0 flex h-8 w-8 items-center justify-center rounded-full border border-mint-400 bg-white text-sm text-mint-700"
                >
                    {{ i + 1 }}
                </span>
                <h3 class="font-display text-lg leading-8">{{ step.title }}</h3>
                <p class="mt-1 max-w-sm text-sm leading-relaxed text-muted">{{ step.text }}</p>
            </li>
        </ol>
    </section>
</template>
