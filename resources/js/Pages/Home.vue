<script setup>

import PublicLayout from '@/Layouts/PublicLayout.vue'
import HeroSection from '@/Components/Hero/HeroSection.vue'
import StackSection from '@/Components/Stack/StackSection.vue'
import ProcessSection from '@/Components/Process/ProcessSection.vue'
import AboutSection from '@/Components/About/AboutSection.vue'
import PortfolioSection from '@/Components/Portfolio/PortfolioSection.vue'
import TestimonialsSection from '@/Components/Testimonials/TestimonialsSection.vue'
import ContactSection from '@/Components/Contact/ContactSection.vue'


</script>

<template>
    <PublicLayout>
        <HeroSection />
        <StackSection />
        <ProcessSection />
        <AboutSection />
        <PortfolioSection />
        <TestimonialsSection />
        <ContactSection />
    </PublicLayout>
</template>
