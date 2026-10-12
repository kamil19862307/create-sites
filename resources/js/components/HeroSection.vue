<script setup>
import { site } from '../data/site';
import AboutSection from './AboutSection.vue';
</script>

<template>
    <section id="top" class="relative overflow-x-clip">
        <!-- Фон: выше блока на 10rem, нижние 14rem плавно исчезают -->
        <div class="hero-bg absolute inset-x-0 top-0 h-[calc(100%+10rem)] bg-mist" aria-hidden="true">
            <img src="/images/making-an-app.png" alt="" class="absolute inset-0 h-full w-full object-cover" />
            <div
                class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-white/50 lg:via-white/75 lg:to-transparent"
            />
        </div>

        <div class="relative mx-auto flex min-h-[400px] max-w-6xl flex-col justify-center px-5 py-16 sm:px-8 lg:min-h-[500px] lg:py-20">
            <h1 class="font-display text-5xl font-light tracking-wide sm:text-6xl lg:text-7xl">
                Разработка сайтов
            </h1>
            <p class="mt-4 font-display text-xl tracking-wide text-muted sm:text-2xl">{{ site.role }}</p>

            <div class="mt-10 max-w-xl">
                <AboutSection />
            </div>

            <div class="mt-8">
                <a href="#contact" class="btn-mint">Начать проект</a>
            </div>
        </div>
    </section>
</template>

<style scoped>
.hero-bg {
    -webkit-mask-image: linear-gradient(to bottom, #000 calc(100% - 14rem), transparent);
    mask-image: linear-gradient(to bottom, #000 calc(100% - 14rem), transparent);
}
</style>
