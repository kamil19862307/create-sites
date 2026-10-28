<script setup>
import { site } from "../data/site.js";
</script>

<template>
    <section id="about" class="scroll-mt-24">
        <div class="mt-6 flex flex-col gap-6 sm:flex-row sm:items-start">
            <div
                class="glass flex h-50 w-46 shrink-0 items-center justify-center rounded-3xl text-mint-700"
                role="img"
                aria-label="Место для портрета"
            >
                <img
                    src="/images/kamil.webp"
                    alt="Камиль Музафаров"
                    class="h-50 w-46 shrink-0 rounded-3xl object-cover"
                >
            </div>

            <div class="max-w-md leading-relaxed text-muted">
                <p>
                    Меня зовут Камиль Музафаров. Я делаю сайты для людей и бизнеса: от лендинга до веб-приложения.
                </p>

                <p class="mt-4 font-display text-xl tracking-wide sm:text-2xl">
                    Что я делаю:
                </p>

                <p class="mt-2">
                    Беру проект целиком: от идеи и структуры до готового сайта, который можно развивать.
                </p>
            </div>
        </div>
    </section>
</template>
