@extends('layouts.app')

@section('title', $course->title . ' — Обучение')

@section('content')
<main class="pt-24 pb-16">
    <div class="container mx-auto px-4 sm:px-6 max-w-5xl">
        <nav class="flex items-center gap-2 text-sm text-text-muted mb-6">
            <a href="{{ route('account.dashboard') }}" class="hover:text-accent-main">Кабинет</a>
            <span>/</span>
            <span class="text-text-primary">{{ $course->title }}</span>
        </nav>

        <h1 class="font-heading text-3xl font-bold text-text-primary mb-2">{{ $course->title }}</h1>

        @php
            $total = $course->modules->sum(fn($m) => $m->publishedLessons->count());
            $done  = $progress->count();
        @endphp

        <div class="flex items-center gap-4 mb-8">
            <div class="flex-1 max-w-xs bg-white/10 rounded-full h-2">
                <div class="bg-accent-main h-2 rounded-full transition-all duration-500"
                     style="width: {{ $total ? round($done / $total * 100) : 0 }}%"></div>
            </div>
            <span class="text-text-muted text-sm">{{ $done }} / {{ $total }} уроков</span>
        </div>

        <div class="space-y-3">
            @foreach($course->modules as $module)
                <div class="card">
                    <h2 class="font-heading font-semibold text-text-primary mb-4">{{ $module->title }}</h2>
                    <ul class="space-y-2">
                        @foreach($module->publishedLessons as $lesson)
                            <li>
                                <a href="{{ route('account.lesson.show', [$course->slug, $lesson->id]) }}"
                                   class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 transition-colors group">
                                    @if(isset($progress[$lesson->id]))
                                        <span class="w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center shrink-0">
                                            <svg class="w-3.5 h-3.5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                                    @else
                                        <span class="w-6 h-6 rounded-full border border-white/20 shrink-0 group-hover:border-accent-main transition-colors"></span>
                                    @endif
                                    <span class="text-text-primary text-sm flex-1 group-hover:text-accent-main transition-colors">
                                        {{ $lesson->title }}
                                    </span>
                                    @if($lesson->video_duration)
                                        <span class="text-text-muted text-xs">{{ $lesson->video_duration }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        @if($firstLesson)
            <div class="mt-8 text-center">
                <a href="{{ route('account.lesson.show', [$course->slug, $firstLesson->id]) }}"
                   class="btn-accent px-12 py-4 text-lg">
                    {{ $done > 0 ? 'Продолжить' : 'Начать обучение' }}
                </a>
            </div>
        @endif
    </div>
</main>
@endsection
