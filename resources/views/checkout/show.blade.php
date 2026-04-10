@extends('layouts.app')

@section('title', 'Оформление заказа — ' . $course->title)

@section('content')
<main class="min-h-screen py-24 px-4">
    <div class="container mx-auto max-w-4xl">
        <h1 class="font-heading text-3xl font-bold text-text-primary mb-8">Оформление заказа</h1>

        <div class="grid lg:grid-cols-[1fr_380px] gap-8">
            {{-- Order form --}}
            <div class="card">
                <h2 class="font-heading text-xl font-semibold text-text-primary mb-6">Ваши данные</h2>
                <div class="space-y-3">
                    <div class="flex justify-between py-2 border-b border-white/10">
                        <span class="text-text-muted">Имя</span>
                        <span class="text-text-primary">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-white/10">
                        <span class="text-text-muted">Email</span>
                        <span class="text-text-primary">{{ auth()->user()->email }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('checkout.create', $course->slug) }}" class="mt-8">
                    @csrf
                    <p class="text-text-muted text-sm mb-6">
                        Нажимая кнопку, вы соглашаетесь с
                        <a href="{{ route('privacy') }}" class="text-accent-main hover:underline">политикой конфиденциальности</a>
                        и <a href="{{ route('terms') }}" class="text-accent-main hover:underline">условиями использования</a>.
                    </p>
                    <button type="submit" class="btn-accent w-full text-lg py-4">
                        Оплатить {{ number_format($course->price, 0, '.', ' ') }} ₽
                    </button>
                </form>
            </div>

            {{-- Order summary --}}
            <div class="card h-fit">
                <h2 class="font-heading text-lg font-semibold text-text-primary mb-4">Ваш заказ</h2>
                @if($course->cover)
                    <div class="aspect-[16/9] overflow-hidden rounded-xl mb-4">
                        <img src="{{ $course->cover }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <h3 class="font-semibold text-text-primary mb-1">{{ $course->title }}</h3>
                @if($course->short_desc)
                    <p class="text-text-muted text-sm mb-4">{{ Str::limit($course->short_desc, 80) }}</p>
                @endif
                <div class="border-t border-white/10 pt-4 mt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-text-muted">Итого</span>
                        <div class="text-right">
                            <span class="text-xl font-bold text-accent-main">
                                {{ number_format($course->price, 0, '.', ' ') }} ₽
                            </span>
                            @if($course->hasDiscount())
                                <p class="text-sm text-text-muted line-through">
                                    {{ number_format($course->old_price, 0, '.', ' ') }} ₽
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-4 p-3 rounded-lg bg-green-500/10 border border-green-500/20">
                    <p class="text-green-400 text-xs flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Безопасная оплата через ЮKassa
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
