<script setup>
const stack = [
    { mark: 'PHP', name: 'PHP', note: 'Язык бэкенда' },
    { mark: 'Lv', name: 'Laravel', note: 'Фреймворк' },
    { mark: 'Dk', name: 'Docker', note: 'Окружение и запуск' },
    { mark: 'My', name: 'MySQL', note: 'База данных' },
];
</script>

<template>
    <section id="tech" class="scroll-mt-20">
        <h2 class="section-title">Технологии</h2>

        <ul class="mt-8 grid grid-cols-2 gap-4">
            <li v-for="item in stack" :key="item.name" class="glass flex flex-col gap-6 rounded-2xl p-5">
                <span
                    class="flex h-11 w-11 items-center justify-center rounded-xl border border-mint-400 bg-mint-200/60 font-display text-sm font-medium text-mint-700"
                    aria-hidden="true"
                >
                    {{ item.mark }}
                </span>
                <div>
                    <p class="font-display text-xl">{{ item.name }}</p>
                    <p class="mt-1 text-sm text-muted">{{ item.note }}</p>
                </div>
            </li>
        </ul>
    </section>
</template>
