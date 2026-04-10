@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' — Школа материнства')
@section('meta_description', $post->meta_description ?: $post->excerpt)

@section('content')
<main>
    <article class="pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 max-w-3xl">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-text-muted mb-8">
                <a href="{{ route('home') }}" class="hover:text-accent-main">Главная</a>
                <span>/</span>
                <a href="{{ route('news.index') }}" class="hover:text-accent-main">Блог</a>
                <span>/</span>
                <span class="text-text-primary">{{ Str::limit($post->title, 40) }}</span>
            </nav>

            @if($post->category)
                <span class="text-xs text-accent-main uppercase tracking-wider font-medium">{{ $post->category }}</span>
            @endif

            <h1 class="font-heading text-4xl lg:text-5xl font-bold text-text-primary leading-tight mt-3 mb-4">
                {{ $post->title }}
            </h1>

            <div class="flex items-center gap-4 text-sm text-text-muted mb-8">
                @if($post->author)
                    <span>{{ $post->author }}</span>
                    <span>·</span>
                @endif
                <time datetime="{{ $post->publish_at?->toIso8601String() }}">
                    {{ $post->publish_at?->translatedFormat('d F Y') }}
                </time>
            </div>

            @if($post->cover)
                <div class="mb-10 rounded-2xl overflow-hidden">
                    <img src="{{ $post->cover }}" alt="{{ $post->title }}" class="w-full h-72 object-cover">
                </div>
            @endif

            <div class="prose-dark">
                {!! $post->content !!}
            </div>
        </div>
    </article>

    {{-- Related --}}
    @if($related->isNotEmpty())
    <section class="py-16 bg-bg-card">
        <div class="container mx-auto px-4 sm:px-6">
            <h2 class="section-heading mb-8">Читайте также</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $item)
                    <x-news-card :post="$item" />
                @endforeach
            </div>
        </div>
    </section>
    @endif
</main>
@endsection
