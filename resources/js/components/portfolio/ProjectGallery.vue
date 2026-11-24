<script setup>
import { computed, nextTick, onBeforeUnmount, ref, watch } from 'vue';

// images: [{ id, image_path, image_type, sort_order }] — порядок задаёт сервер (orderBy sort_order).
// cover: запасной вариант, если у проекта ещё нет изображений в галерее.
// Если нет и его — показываются три заглушки, чтобы слайдер был виден.
const props = defineProps({
    images: { type: Array, default: () => [] },
    cover: { type: String, default: null },
    title: { type: String, default: '' },
});

const slides = computed(() => {
    if (props.images.length) {
        return props.images.map((img, i) => ({
            src: img.image_path,
            alt: `${props.title} — изображение ${i + 1}`,
        }));
    }
    if (props.cover) {
        return [{ src: props.cover, alt: props.title }];
    }
    return [1, 2, 3].map((n) => ({ src: null, alt: `Здесь будет скриншот ${n}` }));
});
const total = computed(() => slides.value.length);
const index = ref(0);
const current = computed(() => slides.value[index.value]);

const canPrev = computed(() => index.value > 0);
const canNext = computed(() => index.value < total.value - 1);

function go(i) {
    index.value = Math.min(Math.max(i, 0), total.value - 1);
}
const prev = () => go(index.value - 1);
const next = () => go(index.value + 1);

/* ---------- свайп и перетаскивание основной области ---------- */
const viewport = ref(null);
const dragX = ref(0);
const dragging = ref(false);
let startX = 0;
let moved = false;
let captured = false;
let activePointer = null;

function onPointerDown(e) {
    if (e.pointerType === 'mouse' && e.button !== 0) return;
    startX = e.clientX;
    moved = false;
    captured = false;
    dragX.value = 0;
    dragging.value = true;
    activePointer = e.pointerId;
}

function onPointerMove(e) {
    if (!dragging.value || e.pointerId !== activePointer) return;
    const dx = e.clientX - startX;
    if (Math.abs(dx) > 6) {
        moved = true;
        if (!captured) {
            viewport.value?.setPointerCapture(e.pointerId);
            captured = true;
        }
    }
    const atEdge = (dx > 0 && !canPrev.value) || (dx < 0 && !canNext.value);
    dragX.value = atEdge ? dx / 3 : dx;
}

function onPointerUp(e) {
    if (!dragging.value || e.pointerId !== activePointer) return;
    dragging.value = false;
    const width = viewport.value?.clientWidth || 1;
    const threshold = Math.min(80, width * 0.15);
    if (dragX.value < -threshold) next();
    else if (dragX.value > threshold) prev();
    dragX.value = 0;
}

function onPointerCancel() {
    dragging.value = false;
    dragX.value = 0;
}

function onViewportClick() {
    if (moved) {
        moved = false;
        return;
    }
    openLightbox();
}

/* ---------- миниатюры ---------- */
const thumbEls = [];
watch(index, async (i) => {
    await nextTick();
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    thumbEls[i]?.scrollIntoView({ inline: 'center', block: 'nearest', behavior: reduce ? 'auto' : 'smooth' });
});

/* ---------- полноэкранный просмотр ---------- */
const lightbox = ref(false);
const dialog = ref(null);
const closeBtn = ref(null);
let opener = null;
let touchStartX = 0;

function openLightbox() {
    opener = document.activeElement;
    lightbox.value = true;
}
function closeLightbox() {
    lightbox.value = false;
}

function onDialogKey(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    } else if (e.key === 'ArrowLeft') {
        prev();
    } else if (e.key === 'ArrowRight') {
        next();
    } else if (e.key === 'Tab' && dialog.value) {
        const items = dialog.value.querySelectorAll('button:not([disabled])');
        if (!items.length) return;
        const first = items[0];
        const last = items[items.length - 1];
        if (!dialog.value.contains(document.activeElement)) {
            e.preventDefault();
            first.focus();
        } else if (e.shiftKey && document.activeElement === first) {
            e.preventDefault();
            last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
            e.preventDefault();
            first.focus();
        }
    }
}

function onTouchStart(e) {
    touchStartX = e.changedTouches[0].clientX;
}
function onTouchEnd(e) {
    const dx = e.changedTouches[0].clientX - touchStartX;
    if (dx < -50) next();
    else if (dx > 50) prev();
}

watch(lightbox, async (open) => {
    if (open) {
        document.body.style.overflow = 'hidden';
        window.addEventListener('keydown', onDialogKey);
        await nextTick();
        closeBtn.value?.focus();
    } else {
        document.body.style.overflow = '';
        window.removeEventListener('keydown', onDialogKey);
        opener?.focus?.();
    }
});

onBeforeUnmount(() => {
    document.body.style.overflow = '';
    window.removeEventListener('keydown', onDialogKey);
});
</script>

<template>
    <div>
        <!-- Основная область -->
        <div class="relative">
            <div
                ref="viewport"
                class="relative aspect-[16/10] max-h-[78vh] min-h-[16rem] w-full touch-pan-y select-none overflow-hidden rounded-3xl border border-line bg-mist shadow-xl shadow-ink/5"
                role="region"
                aria-roledescription="карусель"
                :aria-label="`Галерея проекта ${title}`"
                tabindex="0"
                @pointerdown="onPointerDown"
                @pointermove="onPointerMove"
                @pointerup="onPointerUp"
                @pointercancel="onPointerCancel"
                @click="onViewportClick"
                @keydown.left.prevent="prev"
                @keydown.right.prevent="next"
            >
                <div
                    class="flex h-full"
                    :class="dragging ? '' : 'transition-transform duration-300 ease-out motion-reduce:transition-none'"
                    :style="{ transform: `translateX(calc(${-index * 100}% + ${dragX}px))` }"
                >
                    <div
                        v-for="(img, i) in slides"
                        :key="i"
                        class="flex h-full w-full shrink-0 cursor-zoom-in items-center justify-center p-3 sm:p-6"
                        role="group"
                        aria-roledescription="слайд"
                        :aria-label="`${i + 1} из ${total}`"
                        :aria-hidden="i !== index"
                    >
                        <img
                            v-if="img.src"
                            :src="img.src"
                            :alt="img.alt"
                            :loading="i === 0 ? 'eager' : 'lazy'"
                            draggable="false"
                            class="h-full w-full object-contain"
                        />
                        <div v-else class="flex flex-col items-center gap-3 text-mint-700/70" aria-hidden="true">
                            <svg viewBox="0 0 24 24" class="h-16 w-16" fill="none" stroke="currentColor" stroke-width="1">
                                <rect x="3" y="4" width="18" height="14" rx="2" />
                                <path d="M3 9h18M8 21h8" />
                            </svg>
                            <span class="text-sm text-muted">Здесь будет скриншот {{ i + 1 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Кнопки лежат рядом с областью, а не внутри неё, чтобы свайп их не перехватывал -->
            <button
                type="button"
                class="glass absolute right-3 top-3 flex h-10 w-10 items-center justify-center rounded-full transition-colors hover:border-mint-400"
                aria-label="Открыть изображение на весь экран"
                @click="openLightbox"
            >
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="M4 9V4h5M20 9V4h-5M4 15v5h5M20 15v5h-5" />
                </svg>
            </button>

            <template v-if="total > 1">
                <button
                    type="button"
                    class="glass absolute left-3 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full transition-colors hover:border-mint-400 disabled:cursor-default disabled:opacity-40 sm:h-12 sm:w-12"
                    aria-label="Предыдущее изображение"
                    :disabled="!canPrev"
                    @click="prev"
                >
                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M15 5l-7 7 7 7" />
                    </svg>
                </button>
                <button
                    type="button"
                    class="glass absolute right-3 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full transition-colors hover:border-mint-400 disabled:cursor-default disabled:opacity-40 sm:h-12 sm:w-12"
                    aria-label="Следующее изображение"
                    :disabled="!canNext"
                    @click="next"
                >
                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <span
                    class="pointer-events-none absolute bottom-3 right-3 rounded-full bg-white/85 px-3 py-1 text-sm tabular-nums backdrop-blur"
                    aria-live="polite"
                >
                    {{ index + 1 }} / {{ total }}
                </span>
            </template>
        </div>

        <!-- Индикаторы: точки на мобильных -->
        <div v-if="total > 1" class="mt-3 flex justify-center md:hidden" role="group" aria-label="Выбор изображения">
            <button
                v-for="(s, i) in slides"
                :key="i"
                type="button"
                class="p-2"
                :aria-label="`Изображение ${i + 1}`"
                :aria-current="i === index ? 'true' : undefined"
                @click="go(i)"
            >
                <span
                    class="block h-2 rounded-full transition-all motion-reduce:transition-none"
                    :class="i === index ? 'w-6 bg-mint-700' : 'w-2 bg-muted/40'"
                />
            </button>
        </div>

        <!-- Миниатюры: на десктопе -->
        <ul v-if="total > 1" class="mt-4 hidden gap-3 overflow-x-auto p-1 md:flex" aria-label="Миниатюры">
            <li v-for="(img, i) in slides" :key="i" class="shrink-0">
                <button
                    :ref="(el) => (thumbEls[i] = el)"
                    type="button"
                    class="block h-16 w-24 overflow-hidden rounded-xl border bg-mist p-1 transition motion-reduce:transition-none"
                    :class="i === index ? 'border-mint-400 ring-2 ring-mint-300/70' : 'border-line opacity-70 hover:opacity-100'"
                    :aria-label="`Показать изображение ${i + 1}`"
                    :aria-current="i === index ? 'true' : undefined"
                    @click="go(i)"
                >
                    <img v-if="img.src" :src="img.src" alt="" loading="lazy" draggable="false" class="h-full w-full object-contain" />
                    <span v-else class="flex h-full items-center justify-center text-sm text-muted">{{ i + 1 }}</span>
                </button>
            </li>
        </ul>

        <!-- Полноэкранный просмотр -->
        <Teleport to="body">
            <div
                v-if="lightbox"
                ref="dialog"
                class="fixed inset-0 z-[100] flex flex-col bg-ink/95 text-white"
                role="dialog"
                aria-modal="true"
                :aria-label="`Просмотр изображения ${index + 1} из ${total}`"
            >
                <div class="flex items-center justify-between px-5 py-4 sm:px-8">
                    <span class="text-sm tabular-nums text-white/80" aria-live="polite">{{ index + 1 }} / {{ total }}</span>
                    <button
                        ref="closeBtn"
                        type="button"
                        class="flex h-11 w-11 items-center justify-center rounded-full border border-white/25 transition-colors hover:bg-white/10"
                        aria-label="Закрыть"
                        @click="closeLightbox"
                    >
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path d="M6 6l12 12M18 6L6 18" />
                        </svg>
                    </button>
                </div>

                <div
                    class="relative flex min-h-0 flex-1 items-center justify-center px-4 pb-6 sm:px-20"
                    @touchstart.passive="onTouchStart"
                    @touchend="onTouchEnd"
                >
                    <img
                        v-if="current.src"
                        :src="current.src"
                        :alt="current.alt"
                        draggable="false"
                        class="max-h-[calc(100vh-8rem)] max-w-full select-none object-contain"
                    />
                    <div
                        v-else
                        class="flex h-64 w-full max-w-2xl items-center justify-center rounded-2xl bg-white/10 text-white/70"
                    >
                        {{ current.alt }}
                    </div>

                    <template v-if="total > 1">
                        <button
                            type="button"
                            class="absolute left-3 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/25 transition-colors hover:bg-white/10 disabled:cursor-default disabled:opacity-30 sm:left-6"
                            aria-label="Предыдущее изображение"
                            :disabled="!canPrev"
                            @click="prev"
                        >
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path d="M15 5l-7 7 7 7" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            class="absolute right-3 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/25 transition-colors hover:bg-white/10 disabled:cursor-default disabled:opacity-30 sm:right-6"
                            aria-label="Следующее изображение"
                            :disabled="!canNext"
                            @click="next"
                        >
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </template>
                </div>
            </div>
        </Teleport>
    </div>
</template>
