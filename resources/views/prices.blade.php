@extends('layouts.app')

@section('title', 'Цены — Школа материнства')
@section('meta_description', 'Стоимость услуг доулы и онлайн-курсов по подготовке к родам. Балашиха, Москва и онлайн.')

@section('content')
<main>
    <section class="bg-bg-section pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <span class="section-eyebrow">Стоимость</span>
            <h1 class="section-heading mt-2 mb-4">Цены</h1>
            <p class="text-text-muted text-lg max-w-xl mx-auto">Прозрачное ценообразование без скрытых платежей.</p>
        </div>
    </section>

    {{-- Services --}}
    @if($services->isNotEmpty())
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 max-w-5xl">
            <h2 class="section-heading mb-8">Услуги</h2>
            <div class="divide-y divide-white/10 border border-white/10 rounded-2xl overflow-hidden">
                @foreach($services as $service)
                    <div class="flex items-center justify-between p-5 hover:bg-white/3 transition-colors">
                        <div class="flex-1 pr-4">
                            <a href="{{ route('services.show', $service->slug) }}"
                               class="font-medium text-text-primary hover:text-accent-main transition-colors">
                                {{ $service->title }}
                            </a>
                            @if($service->short_desc)
                                <p class="text-text-muted text-sm mt-0.5">{{ Str::limit($service->short_desc, 80) }}</p>
                            @endif
                        </div>
                        <div class="text-right shrink-0">
                            <span class="font-bold text-accent-main">
                                @if($service->price_from) от @endif
                                {{ number_format($service->price ?? 0, 0, '.', ' ') }} ₽
                            </span>
                            @if($service->price_note)
                                <p class="text-text-muted text-xs">{{ $service->price_note }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Courses --}}
    @if($courses->isNotEmpty())
    <section class="py-16 bg-bg-card">
        <div class="container mx-auto px-4 sm:px-6 max-w-5xl">
            <h2 class="section-heading mb-8">Онлайн-курсы</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 text-center max-w-2xl">
            <h2 class="font-heading text-2xl font-semibold text-text-primary mb-4">Не знаете что выбрать?</h2>
            <p class="text-text-muted mb-8">Напишите — вместе разберёмся, какой формат подходит именно вам.</p>
            <a href="{{ route('contacts') }}" class="btn-accent px-10">Получить консультацию</a>
        </div>
    </section>
</main>
@endsection
