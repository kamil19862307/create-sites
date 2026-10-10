<script setup>
const navigation = [
    { label: 'Главная', href: '/' },
    { label: 'Портфолио', href: '/portfolio' },
    { label: 'Обо мне', href: '/about' },
    { label: 'Контакты', href: '/contacts' },
]
</script>

<template>
    <header class="border-b border-gray-200">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <a
                href="/"
                class="text-lg font-semibold tracking-tight"
            >
                КМ Разработка сайтов
            </a>

            <nav class="hidden items-center gap-8 md:flex">
                <a
                    v-for="item in navigation"
                    :key="item.href"
                    :href="item.href"
                    class="text-sm text-gray-600 transition hover:text-gray-900"
                >
                    {{ item.label }}
                </a>
            </nav>

            <button
                type="button"
                class="rounded-lg border border-gray-200 px-3 py-2 text-sm md:hidden"
            >
                Меню
            </button>
        </div>
    </header>
</template>
