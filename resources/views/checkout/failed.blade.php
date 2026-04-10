@extends('layouts.app')
@section('title', 'Ошибка оплаты')
@section('content')
<main class="min-h-screen flex items-center justify-center py-24 px-4">
    <div class="text-center max-w-md">
        <div class="w-20 h-20 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
        <h1 class="font-heading text-3xl font-bold text-text-primary mb-3">Оплата не прошла</h1>
        <p class="text-text-muted mb-8">Что-то пошло не так. Попробуйте ещё раз или свяжитесь с нами.</p>
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('courses.show', $order->course) }}" class="btn-accent px-8">Попробовать снова</a>
            <a href="{{ route('contacts') }}" class="btn-outline px-8">Написать нам</a>
        </div>
    </div>
</main>
@endsection
