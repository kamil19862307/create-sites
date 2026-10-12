<script setup>
import { site } from '../data/site';
const year = new Date().getFullYear();
</script>

<template>
    <footer class="border-t border-line bg-mist">
        <div class="mx-auto grid max-w-6xl gap-10 px-5 py-12 sm:px-8 md:grid-cols-3">
            <div>
                <p class="font-display text-xl">{{ site.name }}</p>
                <p class="mt-1 text-sm text-muted">{{ site.role }}</p>
            </div>

            <nav aria-label="Разделы сайта">
                <ul class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm text-muted">
                    <li v-for="item in site.nav" :key="item.href">
                        <a :href="item.href" class="hover:text-ink">{{ item.label }}</a>
                    </li>
                </ul>
            </nav>

            <ul class="space-y-2 text-sm md:text-right">
                <li><a :href="`tel:${site.phone}`" class="hover:text-mint-700">{{ site.phoneLabel }}</a></li>
                <li><a :href="`mailto:${site.email}`" class="hover:text-mint-700">{{ site.email }}</a></li>
            </ul>
        </div>
        <p class="border-t border-line py-4 text-center text-xs text-muted">© {{ year }} {{ site.name }}</p>
    </footer>
</template>
