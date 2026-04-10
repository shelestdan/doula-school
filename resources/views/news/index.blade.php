@extends('layouts.app')

@section('title', 'Блог — Школа материнства')
@section('meta_description', 'Статьи о беременности, родах, материнстве и здоровье от доулы и перинатального психолога.')

@section('content')
<main>
    <section class="bg-bg-section pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <span class="section-eyebrow">Блог</span>
            <h1 class="section-heading mt-2 mb-4">Статьи о материнстве</h1>
            <p class="text-text-muted text-lg max-w-2xl mx-auto">
                Полезные материалы о беременности, родах и первых месяцах с малышом.
            </p>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6">
            @if($posts->isEmpty())
                <p class="text-center text-text-muted py-16">Статьи скоро появятся.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        <x-news-card :post="$post" />
                    @endforeach
                </div>
                <div class="mt-12">{{ $posts->links() }}</div>
            @endif
        </div>
    </section>
</main>
@endsection
