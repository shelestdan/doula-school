@extends('layouts.app')

@section('title', 'Контакты — Школа материнства')
@section('meta_description', 'Связаться с доулой и перинатальным психологом в Балашихе и Москве.')

@section('content')
<main>
    <section class="bg-bg-section pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <span class="section-eyebrow">Обратная связь</span>
            <h1 class="section-heading mt-2 mb-4">Контакты</h1>
            <p class="text-text-muted text-lg max-w-xl mx-auto">Напишите или позвоните — отвечу в течение дня.</p>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid lg:grid-cols-2 gap-12 max-w-5xl mx-auto">
                {{-- Form --}}
                <div>
                    <h2 class="font-heading text-2xl font-semibold text-text-primary mb-6">Написать мне</h2>
                    <livewire:contact-form />
                </div>

                {{-- Info --}}
                <div class="space-y-8">
                    <div>
                        <h2 class="font-heading text-2xl font-semibold text-text-primary mb-6">Как связаться</h2>
                        <div class="space-y-5">
                            <a href="https://t.me/{{ $globalSettings['telegram_username'] ?? '' }}"
                               class="flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-accent-main/40 transition-colors group">
                                <div class="w-10 h-10 bg-[#2AABEE]/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#2AABEE]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.248l-2.08 9.802c-.153.704-.561.876-1.137.546l-3.105-2.288-1.497 1.44c-.166.167-.305.305-.624.305l.223-3.16 5.75-5.193c.25-.222-.055-.345-.386-.123L7.46 14.618l-3.065-.957c-.666-.208-.68-.666.139-.987l11.977-4.616c.554-.2 1.04.134.051.19z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-text-primary font-medium group-hover:text-accent-main transition-colors">Telegram</p>
                                    <p class="text-text-muted text-sm">Быстрый ответ</p>
                                </div>
                            </a>

                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $globalSettings['phone'] ?? '') }}"
                               class="flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-accent-main/40 transition-colors group">
                                <div class="w-10 h-10 bg-[#25D366]/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-text-primary font-medium group-hover:text-accent-main transition-colors">WhatsApp</p>
                                    <p class="text-text-muted text-sm">{{ $globalSettings['phone'] ?? '+7 (___) ___-__-__' }}</p>
                                </div>
                            </a>

                            @if($globalSettings['email'] ?? false)
                            <a href="mailto:{{ $globalSettings['email'] }}"
                               class="flex items-center gap-4 p-4 rounded-xl border border-white/10 hover:border-accent-main/40 transition-colors group">
                                <div class="w-10 h-10 bg-accent-main/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-text-primary font-medium group-hover:text-accent-main transition-colors">Email</p>
                                    <p class="text-text-muted text-sm">{{ $globalSettings['email'] }}</p>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 rounded-xl border border-white/10 bg-bg-card">
                        <p class="text-text-muted text-sm leading-relaxed">
                            <span class="text-text-primary font-medium">Работаю</span> в Балашихе, Москве и онлайн.<br>
                            Принимаю на дому или выезжаю к вам.<br>
                            <span class="text-accent-main">Консультация бесплатно</span> — первые 15 минут.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
