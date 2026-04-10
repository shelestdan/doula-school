@extends('layouts.app')

@section('title', 'Партнёры — Школа материнства')
@section('meta_description', 'Специалисты и партнёры школы материнства: акушеры, психологи, консультанты по ГВ.')

@section('content')
<main>
    <section class="bg-bg-section pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <span class="section-eyebrow">Наша команда</span>
            <h1 class="section-heading mt-2 mb-4">Партнёры и специалисты</h1>
            <p class="text-text-muted text-lg max-w-2xl mx-auto">
                Работаю в связке с проверенными специалистами для комплексной поддержки каждой семьи.
            </p>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6">
            @if($partners->isEmpty())
                <p class="text-center text-text-muted py-16">Информация о партнёрах скоро появится.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($partners as $partner)
                        <div class="card text-center">
                            <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4 border-2 border-accent-main/30">
                                @if($partner->photo)
                                    <img src="{{ $partner->photo }}" alt="{{ $partner->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full gradient-card flex items-center justify-center text-2xl font-heading font-bold text-accent-main">
                                        {{ mb_substr($partner->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="font-heading font-semibold text-text-primary mb-1">{{ $partner->name }}</h3>
                            @if($partner->specialization)
                                <p class="text-accent-main text-sm mb-2">{{ $partner->specialization }}</p>
                            @endif
                            @if($partner->description)
                                <p class="text-text-muted text-sm leading-relaxed">{{ Str::limit($partner->description, 100) }}</p>
                            @endif
                            @if($partner->url)
                                <a href="{{ $partner->url }}" target="_blank" rel="noopener"
                                   class="mt-3 text-sm text-accent-main hover:underline inline-flex items-center gap-1">
                                    Подробнее
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
