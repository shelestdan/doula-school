@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
<main class="pt-24 pb-16">
    <div class="container mx-auto px-4 sm:px-6 max-w-5xl">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="font-heading text-3xl font-bold text-text-primary">
                    Привет, {{ auth()->user()->name }}!
                </h1>
                <p class="text-text-muted mt-1">Ваши курсы и заказы</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- My courses --}}
        <section>
            <h2 class="font-heading text-xl font-semibold text-text-primary mb-4">Мои курсы</h2>
            @if($grants->isEmpty())
                <div class="card text-center py-12">
                    <p class="text-text-muted mb-4">У вас пока нет купленных курсов.</p>
                    <a href="{{ route('courses.index') }}" class="btn-accent px-8">Смотреть курсы</a>
                </div>
            @else
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($grants as $grant)
                        @if($grant->course)
                            <a href="{{ route('account.course.show', $grant->course->slug) }}"
                               class="card group hover:border-accent-main/40 transition-all hover:-translate-y-1">
                                @if($grant->course->cover)
                                    <div class="aspect-[16/9] overflow-hidden rounded-t-xl -mx-6 -mt-6 mb-4">
                                        <img src="{{ $grant->course->cover }}" alt="{{ $grant->course->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                @endif
                                <h3 class="font-heading font-semibold text-text-primary group-hover:text-accent-main transition-colors">
                                    {{ $grant->course->title }}
                                </h3>
                                @if($grant->ends_at)
                                    <p class="text-xs text-text-muted mt-2">
                                        Доступ до {{ $grant->ends_at->translatedFormat('d M Y') }}
                                    </p>
                                @else
                                    <p class="text-xs text-green-400 mt-2">Постоянный доступ</p>
                                @endif
                                <div class="mt-4 text-accent-main text-sm font-medium flex items-center gap-1">
                                    Продолжить обучение
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</main>
@endsection
