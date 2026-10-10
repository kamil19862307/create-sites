<script setup>
const testimonials = [
    {
        text: 'Нужно было сделать удобный каталог техники. В результате получили простой и понятный сайт, которым удобно пользоваться каждый день.',
        name: 'Клиент проекта',
        role: 'Printerimfu',
    },
    {
        text: 'Понравился подход к работе: сначала разбираемся с задачей, затем последовательно реализуем решение.',
        name: 'Клиент',
        role: 'Разработка сайта',
    },
    {
        text: 'Сайт получился современным, быстрым и удобным на телефоне. Все основные задачи удалось решить в рамках одного проекта.',
        name: 'Клиент',
        role: 'Web-разработка',
    },
]
</script>

<template>
    <section class="border-b border-gray-200">
        <div class="mx-auto max-w-7xl px-6 py-20 md:py-28">
            <div class="grid gap-12 md:grid-cols-[0.7fr_1.3fr]">
                <div>
                    <p
                        class="text-sm font-medium uppercase tracking-[0.2em] text-gray-500"
                    >
                        Отзывы
                    </p>

                    <h2
                        class="mt-6 max-w-md text-5xl font-semibold leading-[0.95] tracking-[-0.04em] md:text-7xl"
                    >
                        Что говорят
                        <br>
                        о работе
                    </h2>
                </div>

                <div>
                    <article
                        v-for="testimonial in testimonials"
                        :key="testimonial.text"
                        class="border-t border-gray-300 py-8"
                    >
                        <p
                            class="max-w-2xl text-xl leading-relaxed tracking-tight md:text-2xl"
                        >
                            «{{ testimonial.text }}»
                        </p>

                        <div class="mt-6">
                            <p class="text-sm font-medium">
                                {{ testimonial.name }}
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ testimonial.role }}
                            </p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</template>
