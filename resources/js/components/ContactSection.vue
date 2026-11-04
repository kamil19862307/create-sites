<script setup>
import { reactive, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const settings = page.props.settings;

const form = reactive({ name: '', email: '', message: '' });
const status = ref('idle'); // idle | sending | ok | error

// Подготавливаем номер телефона для ссылки tel:
const phoneHref = settings?.contact_phone?.replace(/[^\d+]/g, '');

async function submit() {
    status.value = 'sending';

    try {
        const token = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

        const res = await fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify(form),
        });

        if (!res.ok) throw new Error('Request failed');

        status.value = 'ok';
        Object.assign(form, { name: '', email: '', message: '' });
    } catch {
        status.value = 'error';
    }
}
</script>

<template>
    <section id="contact" class="scroll-mt-20">
        <h2 class="section-title">Работаю с вами напрямую:</h2>

        <div class="mt-8 grid gap-10">
            <div>
                <p class="max-w-sm leading-relaxed text-muted">
                    Опишите задачу в форме или в письме, отвечу на email или по телефону.
                </p>

                <ul class="mt-6 space-y-3">
                    <li v-if="settings?.contact_phone">
                        <a
                            :href="`tel:${phoneHref}`"
                            class="font-display text-2xl hover:text-mint-700"
                        >
                            {{ settings.contact_phone }}
                        </a>
                    </li>

                    <li v-if="settings?.contact_email">
                        <a
                            :href="`mailto:${settings.contact_email}`"
                            class="font-display text-2xl hover:text-mint-700"
                        >
                            {{ settings.contact_email }}
                        </a>
                    </li>

                    <li v-if="settings?.contact_telegram">
                        <a
                            :href="settings.contact_telegram"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="hover:text-mint-700"
                        >
                            Telegram
                        </a>
                    </li>

                    <li v-if="settings?.contact_whatsapp">
                        <a
                            :href="settings.contact_whatsapp"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="hover:text-mint-700"
                        >
                            WhatsApp
                        </a>
                    </li>
                </ul>
            </div>

            <form class="glass space-y-4 rounded-2xl p-5 sm:p-6" @submit.prevent="submit">
                <div>
                    <label for="cf-name" class="mb-1.5 block text-sm text-muted">Ваше имя</label>
                    <input
                        id="cf-name"
                        v-model.trim="form.name"
                        type="text"
                        required
                        autocomplete="name"
                        class="field"
                    />
                </div>

                <div>
                    <label for="cf-email" class="mb-1.5 block text-sm text-muted">Email</label>
                    <input
                        id="cf-email"
                        v-model.trim="form.email"
                        type="email"
                        required
                        autocomplete="email"
                        class="field"
                    />
                </div>

                <div>
                    <label for="cf-message" class="mb-1.5 block text-sm text-muted">Сообщение</label>
                    <textarea
                        id="cf-message"
                        v-model.trim="form.message"
                        rows="4"
                        required
                        class="field resize-y"
                    />
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <button
                        type="submit"
                        class="btn-mint disabled:opacity-60"
                        :disabled="status === 'sending'"
                    >
                        {{ status === 'sending' ? 'Отправляю…' : 'Отправить сообщение' }}
                    </button>

                    <p
                        role="status"
                        class="text-sm"
                        :class="status === 'error' ? 'text-red-700' : 'text-mint-700'"
                    >
                        <template v-if="status === 'ok'">
                            Сообщение отправлено. Отвечу в ближайшее время.
                        </template>

                        <template v-else-if="status === 'error'">
                            Не удалось отправить.
                            <template v-if="settings?.contact_email">
                                Попробуйте ещё раз или напишите на {{ settings.contact_email }}.
                            </template>
                            <template v-else>
                                Попробуйте ещё раз позже.
                            </template>
                        </template>
                    </p>
                </div>
            </form>
        </div>
    </section>
</template>
