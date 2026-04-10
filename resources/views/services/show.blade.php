@extends('layouts.app')

@section('title', ($service->meta_title ?: $service->title) . ' — Школа материнства')
@section('meta_description', $service->meta_description ?: $service->short_desc)

@section('content')
<main>
    <section class="bg-bg-section pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 max-w-4xl">
            <nav class="flex items-center gap-2 text-sm text-text-muted mb-8">
                <a href="{{ route('home') }}" class="hover:text-accent-main">Главная</a>
                <span>/</span>
                <a href="{{ route('services.index') }}" class="hover:text-accent-main">Услуги</a>
                <span>/</span>
                <span class="text-text-primary">{{ $service->title }}</span>
            </nav>

            <h1 class="font-heading text-4xl lg:text-5xl font-bold text-text-primary mb-4">{{ $service->title }}</h1>

            @if($service->price || $service->price_from)
                <div class="mb-6">
                    <span class="text-2xl font-bold text-accent-main">
                        @if($service->price_from) от @endif
                        {{ number_format($service->price ?? 0, 0, '.', ' ') }} ₽
                    </span>
                    @if($service->price_note)
                        <span class="text-text-muted ml-2">{{ $service->price_note }}</span>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 max-w-4xl">
            <div class="prose-dark">
                {!! $service->description !!}
            </div>

            <div class="mt-12 pt-8 border-t border-white/10">
                <a href="{{ route('contacts') }}" class="btn-accent px-10 mr-4">Записаться</a>
                <a href="{{ route('services.index') }}" class="btn-outline px-8">Все услуги</a>
            </div>
        </div>
    </section>
</main>
@endsection
