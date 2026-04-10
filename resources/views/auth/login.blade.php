@extends('layouts.app')

@section('title', 'Вход — Школа материнства')

@section('content')
<main class="min-h-screen flex items-center justify-center py-24 px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block text-2xl font-heading font-bold text-text-primary mb-6">
                {{ config('app.name') }}
            </a>
            <h1 class="font-heading text-3xl font-bold text-text-primary">Вход в кабинет</h1>
        </div>

        <div class="card">
            @if(session('status'))
                <div class="mb-4 p-3 rounded-lg bg-green-500/10 border border-green-500/30 text-green-400 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="label" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="input @error('email') border-red-500 @enderror" autocomplete="email" autofocus>
                    @error('email')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label" for="password">Пароль</label>
                    <input id="password" name="password" type="password" required
                        class="input @error('password') border-red-500 @enderror" autocomplete="current-password">
                    @error('password')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-white/20 bg-bg-card text-accent-main">
                        <span class="text-sm text-text-muted">Запомнить меня</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-accent-main hover:underline">Забыли пароль?</a>
                </div>
                <button type="submit" class="btn-accent w-full">Войти</button>
            </form>

            <p class="mt-5 text-center text-sm text-text-muted">
                Нет аккаунта?
                <a href="{{ route('register') }}" class="text-accent-main hover:underline">Зарегистрироваться</a>
            </p>
        </div>
    </div>
</main>
@endsection
