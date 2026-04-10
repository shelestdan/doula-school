@extends('layouts.app')

@section('title', ($course->meta_title ?: $course->title) . ' — Школа материнства')
@section('meta_description', $course->meta_description ?: $course->short_desc)

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "{{ $course->title }}",
  "description": "{{ $course->short_desc }}",
  "provider": {
    "@type": "Organization",
    "name": "{{ config('app.name') }}"
  },
  "offers": {
    "@type": "Offer",
    "price": "{{ $course->price }}",
    "priceCurrency": "RUB"
  }
}
</script>
@endsection

@section('content')
<main>
    {{-- Hero --}}
    <section class="bg-bg-section pt-24 pb-0">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-start">
                {{-- Left --}}
                <div class="py-12">
                    @if($course->badge)
                        <span class="badge-accent mb-4 inline-block">{{ $course->badge }}</span>
                    @endif

                    <h1 class="font-heading text-4xl lg:text-5xl font-bold text-text-primary leading-tight mb-4">
                        {{ $course->title }}
                    </h1>

                    @if($course->short_desc)
                        <p class="text-text-muted text-lg leading-relaxed mb-6">{{ $course->short_desc }}</p>
                    @endif

                    {{-- Stats --}}
                    <div class="flex flex-wrap gap-6 mb-8 text-sm text-text-muted">
                        @if($course->lessons_count)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
                                {{ $course->lessons_count }} уроков
                            </div>
                        @endif
                        @if($course->duration_hours)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $course->duration_hours }} часов
                            </div>
                        @endif
                        @if($course->level)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                {{ match($course->level) { 'beginner' => 'Начинающий', 'intermediate' => 'Средний', 'advanced' => 'Продвинутый', default => $course->level } }}
                            </div>
                        @endif
                    </div>

                    {{-- CTA --}}
                    @if($hasAccess)
                        <a href="{{ route('account.course.show', $course->slug) }}" class="btn-accent text-lg px-10 py-4">
                            Перейти к обучению
                        </a>
                    @else
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="{{ route('checkout.show', $course->slug) }}" class="btn-accent text-lg px-10 py-4">
                                Купить за {{ number_format($course->price, 0, '.', ' ') }} ₽
                            </a>
                            @if($course->hasDiscount())
                                <span class="text-text-muted line-through text-lg">{{ number_format($course->old_price, 0, '.', ' ') }} ₽</span>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Right — Cover --}}
                @if($course->cover)
                    <div class="hidden lg:block">
                        <div class="relative rounded-2xl overflow-hidden shadow-card-hover">
                            <img src="{{ $course->cover }}" alt="{{ $course->title }}" class="w-full h-96 object-cover">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- What you learn --}}
    @if($course->what_you_learn)
    <section class="py-16 bg-bg-card">
        <div class="container mx-auto px-4 sm:px-6">
            <h2 class="section-heading mb-8">Что вы узнаете</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($course->what_you_learn as $item)
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-bg-base border border-white/5">
                        <svg class="w-5 h-5 text-accent-main mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-text-primary text-sm leading-relaxed">{{ $item }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Curriculum --}}
    @if($course->modules->isNotEmpty())
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 max-w-3xl">
            <h2 class="section-heading mb-8">Программа курса</h2>
            <div class="space-y-3" x-data="{ open: 0 }">
                @foreach($course->modules as $i => $module)
                    <div class="border border-white/10 rounded-xl overflow-hidden">
                        <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                            class="w-full flex items-center justify-between p-5 text-left hover:bg-white/5 transition-colors">
                            <div>
                                <span class="text-text-muted text-sm">Модуль {{ $i + 1 }}</span>
                                <h3 class="font-semibold text-text-primary mt-0.5">{{ $module->title }}</h3>
                            </div>
                            <div class="flex items-center gap-3 shrink-0 ml-4">
                                <span class="text-text-muted text-sm">{{ $module->publishedLessons->count() }} уроков</span>
                                <svg class="w-5 h-5 text-accent-main transition-transform duration-200"
                                    :class="open === {{ $i }} ? 'rotate-180' : ''"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        <div x-show="open === {{ $i }}" x-collapse>
                            <ul class="divide-y divide-white/5 px-5 pb-4">
                                @foreach($module->publishedLessons as $lesson)
                                    <li class="flex items-center gap-3 py-3">
                                        @if($lesson->is_preview)
                                            <svg class="w-4 h-4 text-accent-main shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-text-muted shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                        @endif
                                        <span class="text-text-primary text-sm flex-1">{{ $lesson->title }}</span>
                                        @if($lesson->is_preview)
                                            <span class="text-xs text-accent-main">Превью</span>
                                        @endif
                                        @if($lesson->video_duration)
                                            <span class="text-xs text-text-muted">{{ $lesson->video_duration }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Bottom CTA --}}
    @unless($hasAccess)
    <section class="py-16 bg-bg-card">
        <div class="container mx-auto px-4 sm:px-6 text-center max-w-2xl">
            <h2 class="section-heading mb-4">Готовы начать?</h2>
            <p class="text-text-muted mb-8">Присоединяйтесь и получите пожизненный доступ к курсу.</p>
            <a href="{{ route('checkout.show', $course->slug) }}" class="btn-accent text-lg px-12 py-4">
                Записаться за {{ number_format($course->price, 0, '.', ' ') }} ₽
            </a>
        </div>
    </section>
    @endunless
</main>
@endsection
