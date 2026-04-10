@extends('layouts.app')

@section('title', 'Регистрация — Школа материнства')

@section('content')
<main class="min-h-screen flex items-center justify-center py-24 px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block text-2xl font-heading font-bold text-text-primary mb-6">
                {{ config('app.name') }}
            </a>
            <h1 class="font-heading text-3xl font-bold text-text-primary">Создать аккаунт</h1>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="label">Имя</label>
                    <input name="name" type="text" value="{{ old('name') }}" required
                        class="input @error('name') border-red-500 @enderror" autocomplete="name" autofocus>
                    @error('name')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required
                        class="input @error('email') border-red-500 @enderror" autocomplete="email">
                    @error('email')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">Телефон</label>
                    <input name="phone" type="tel" value="{{ old('phone') }}"
                        class="input" placeholder="+7 (___) ___-__-__">
                </div>
                <div>
                    <label class="label">Пароль</label>
                    <input name="password" type="password" required
                        class="input @error('password') border-red-500 @enderror" autocomplete="new-password">
                    @error('password')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">Повторите пароль</label>
                    <input name="password_confirmation" type="password" required class="input" autocomplete="new-password">
                </div>
                <button type="submit" class="btn-accent w-full">Зарегистрироваться</button>
            </form>

            <p class="mt-5 text-center text-sm text-text-muted">
                Уже есть аккаунт?
                <a href="{{ route('login') }}" class="text-accent-main hover:underline">Войти</a>
            </p>
        </div>
    </div>
</main>
@endsection
