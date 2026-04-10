@extends('layouts.app')

@section('title', $lesson->title . ' — ' . $course->title)

@section('content')
<main class="pt-20 pb-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-[1fr_320px] gap-8 items-start">

            {{-- Player --}}
            <div>
                <nav class="flex items-center gap-2 text-sm text-text-muted mb-4">
                    <a href="{{ route('account.dashboard') }}" class="hover:text-accent-main">Кабинет</a>
                    <span>/</span>
                    <a href="{{ route('account.course.show', $course->slug) }}" class="hover:text-accent-main">{{ $course->title }}</a>
                    <span>/</span>
                    <span class="text-text-primary">{{ $lesson->title }}</span>
                </nav>

                <h1 class="font-heading text-2xl font-bold text-text-primary mb-4">{{ $lesson->title }}</h1>

                @if($lesson->video_url)
                    <div class="aspect-video rounded-2xl overflow-hidden bg-black mb-6">
                        <iframe src="{{ $lesson->video_url }}" class="w-full h-full"
                            allowfullscreen allow="autoplay; encrypted-media"
                            frameborder="0"></iframe>
                    </div>
                @endif

                @if($lesson->content)
                    <div class="prose-dark mt-6">
                        {!! $lesson->content !!}
                    </div>
                @endif

                <div class="mt-8 flex items-center gap-4">
                    <button
                        x-data="{ done: {{ $progress[$lesson->id] ?? false ? 'true' : 'false' }} }"
                        @click="
                            fetch('{{ route('account.lesson.complete', [$course->slug, $lesson->id]) }}', {
                                method: 'POST',
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content}
                            }).then(() => done = true)
                        "
                        :class="done ? 'btn-outline' : 'btn-accent'"
                        :disabled="done"
                        class="px-8">
                        <span x-show="!done">Отметить как пройденный</span>
                        <span x-show="done" class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Пройдено
                        </span>
                    </button>
                </div>
            </div>

            {{-- Sidebar --}}
            <aside class="sticky top-24">
                <div class="card p-4">
                    <h2 class="font-semibold text-text-primary mb-3 text-sm uppercase tracking-wide">Программа</h2>
                    @foreach($course->modules as $module)
                        <div class="mb-4">
                            <p class="text-text-muted text-xs font-medium uppercase tracking-wider mb-2">{{ $module->title }}</p>
                            <ul class="space-y-1">
                                @foreach($module->publishedLessons as $item)
                                    <li>
                                        <a href="{{ route('account.lesson.show', [$course->slug, $item->id]) }}"
                                           class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-colors
                                               {{ $item->id === $lesson->id ? 'bg-accent-main/10 text-accent-main' : 'text-text-muted hover:text-text-primary hover:bg-white/5' }}">
                                            @if(isset($progress[$item->id]))
                                                <svg class="w-3.5 h-3.5 text-green-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            @else
                                                <span class="w-3.5 h-3.5 rounded-full border border-current shrink-0 opacity-40"></span>
                                            @endif
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
</main>
@endsection
