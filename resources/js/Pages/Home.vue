<script setup>
import { Head } from '@inertiajs/vue3';

import SiteHeader from '../components/SiteHeader.vue';
import HeroSection from '../components/HeroSection.vue';
import TechSection from '../components/TechSection.vue';
import PortfolioSection from '../components/PortfolioSection.vue';
import ProcessSection from '../components/ProcessSection.vue';
import ReviewsSection from '../components/ReviewsSection.vue';
import ContactSection from '../components/ContactSection.vue';
import SiteFooter from '../components/SiteFooter.vue';

defineProps({
    title: String,
    message: String,
});
</script>

<template>
    <Head :title="title" />

    <SiteHeader />

    <main>
        <HeroSection />

        <!-- Заходит на фон баннера: без верхней границы, поверх картинки -->
        <div class="relative z-10">
            <div class="mx-auto max-w-6xl px-5 py-16 sm:px-8 lg:py-24">
                <TechSection />
            </div>
        </div>

        <div class="border-t border-line">
            <div class="mx-auto grid max-w-6xl gap-16 px-5 py-16 sm:px-8 lg:grid-cols-2 lg:gap-20 lg:py-24">
                <PortfolioSection />
                <ProcessSection />
            </div>
        </div>

        <div class="border-t border-line">
            <div class="mx-auto grid max-w-6xl gap-16 px-5 py-16 sm:px-8 lg:grid-cols-2 lg:gap-20 lg:py-24">
                <ReviewsSection />
                <ContactSection />
            </div>
        </div>
    </main>

    <SiteFooter />
</template>
