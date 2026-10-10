<script setup>
import StackCard from './StackCard.vue'

const technologies = [
    {
        number: '01',
        name: 'PHP / Laravel',
        description: 'Backend · API · бизнес-логика',
    },
    {
        number: '02',
        name: 'Vue',
        description: 'Интерфейсы · SPA · интерактивность',
    },
    {
        number: '03',
        name: 'Inertia',
        description: 'Связь Laravel и Vue · быстрые приложения',
    },
    {
        number: '04',
        name: 'MySQL',
        description: 'Данные · связи · структура базы',
    },
    {
        number: '05',
        name: 'Tailwind CSS',
        description: 'Адаптивный интерфейс · современный UI',
    },
    {
        number: '06',
        name: 'Docker / Git',
        description: 'Окружение · версии · deployment',
    },
]
</script>

<template>
    <section class="border-b border-gray-200">
        <div class="site-container section-padding">
            <div class="grid gap-12 md:grid-cols-[0.7fr_1.3fr]">
                <div>
                    <p
                        class="section-label"
                    >
                        Мой стек
                    </p>

                    <h2
                        class="section-title mt-6 max-w-md"
                    >
                        Технологии,
                        <br>
                        которыми
                        <br>
                        я работаю
                    </h2>
                </div>

                <div class="grid gap-x-8 gap-y-10 sm:grid-cols-2">
                    <StackCard
                        v-for="technology in technologies"
                        :key="technology.number"
                        v-bind="technology"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
