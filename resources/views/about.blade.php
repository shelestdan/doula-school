@extends('layouts.app')

@section('title', 'Обо мне — Доула и консультант по материнству')
@section('meta_description', 'Узнайте больше о Елене Тимофеевой — доуле, консультанте по материнству и организаторе школы материнства в Балашихе.')

@section('content')
<main>
    {{-- Hero --}}
    <section class="bg-bg-section pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <span class="section-eyebrow">Обо мне</span>
            <h1 class="section-heading mt-2 mb-4">Доула и консультант по материнству</h1>
        </div>
    </section>

    {{-- About section reuse --}}
    <x-sections.about />

    {{-- Values / Philosophy --}}
    <section class="py-20 bg-bg-card">
        <div class="container mx-auto px-4 sm:px-6 max-w-4xl">
            <div class="text-center mb-12">
                <span class="section-eyebrow">Мои принципы</span>
                <h2 class="section-heading mt-2">Как я работаю</h2>
            </div>
            <div class="grid sm:grid-cols-2 gap-6">
                @foreach([
                    ['icon' => '🤝', 'title' => 'Без осуждения', 'text' => 'Принимаю любой выбор — плановое кесарево, эпидуральное, домашние роды. Поддерживаю, а не оцениваю.'],
                    ['icon' => '💡', 'title' => 'Доказательный подход', 'text' => 'Только актуальные исследования. Никакого мракобесия и псевдонауки.'],
                    ['icon' => '🌱', 'title' => 'Индивидуально', 'text' => 'Каждая беременность уникальна. Работаю под конкретную ситуацию, не по шаблону.'],
                    ['icon' => '🔒', 'title' => 'Конфиденциально', 'text' => 'Всё, что происходит на наших встречах и в родах — остаётся между нами.'],
                ] as $item)
                    <div class="p-6 rounded-2xl border border-white/10 bg-bg-base">
                        <div class="text-3xl mb-3">{{ $item['icon'] }}</div>
                        <h3 class="font-heading font-semibold text-text-primary mb-2">{{ $item['title'] }}</h3>
                        <p class="text-text-muted text-sm leading-relaxed">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 text-center max-w-2xl">
            <h2 class="section-heading mb-4">Хотите познакомиться?</h2>
            <p class="text-text-muted mb-8">Первая консультация — бесплатно. Без обязательств.</p>
            <a href="{{ route('contacts') }}" class="btn-accent px-12 py-4 text-lg">Написать мне</a>
        </div>
    </section>
</main>
@endsection
