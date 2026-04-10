@extends('layouts.app')

@section('title', 'Онлайн-курсы — Школа материнства')
@section('meta_description', 'Авторские онлайн-курсы по подготовке к родам, грудному вскармливанию и материнству. Доступ навсегда.')

@section('content')
<main>
    {{-- Hero --}}
    <section class="bg-bg-section pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <span class="section-eyebrow">Онлайн-обучение</span>
            <h1 class="section-heading mt-2 mb-4">Курсы для будущих мам</h1>
            <p class="text-text-muted text-lg max-w-2xl mx-auto">
                Авторские программы с пожизненным доступом. Учитесь в своём темпе, возвращайтесь к урокам когда угодно.
            </p>
        </div>
    </section>

    {{-- Filter + Grid --}}
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6">
            <livewire:course-filter />
        </div>
    </section>
</main>
@endsection
