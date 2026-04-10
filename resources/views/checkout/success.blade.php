@extends('layouts.app')
@section('title', 'Оплата прошла успешно')
@section('content')
<main class="min-h-screen flex items-center justify-center py-24 px-4">
    <div class="text-center max-w-md">
        <div class="w-20 h-20 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h1 class="font-heading text-3xl font-bold text-text-primary mb-3">Оплата прошла!</h1>
        <p class="text-text-muted mb-8">Доступ к курсу уже открыт в вашем кабинете.</p>
        <a href="{{ route('account.dashboard') }}" class="btn-accent px-10">Перейти к обучению</a>
    </div>
</main>
@endsection
