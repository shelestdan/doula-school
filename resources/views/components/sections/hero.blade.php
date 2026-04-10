@props([
    'name'     => 'Имя Фамилия',
    'title'    => 'Доула · Перинатальный психолог',
    'headline' => 'Рядом с тобой в самый важный момент жизни',
    'subline'  => 'Профессиональное сопровождение в родах, подготовка к рождению малыша и школа материнства в Балашихе и Москве',
    'photo'    => null,
    'stats'    => [],
])

<section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-hero pt-20">

    {{-- Decorative background elements --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 -left-32 w-96 h-96 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-accent/5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gold/3 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Text content --}}
            <div class="order-2 lg:order-1 text-center lg:text-left">

                {{-- Badge: specialist title --}}
                <div class="inline-flex items-center gap-2 bg-accent/15 border border-accent/30 rounded-full px-4 py-1.5 mb-6">
                    <span class="w-2 h-2 bg-accent rounded-full animate-pulse-soft"></span>
                    <span class="text-sm text-accent font-medium tracking-wide">{{ $title }}</span>
                </div>

                {{-- Name --}}
                <p class="text-text-muted text-lg font-body mb-2 uppercase tracking-widest">{{ $name }}</p>

                {{-- Main headline --}}
                <h1 class="font-heading font-bold text-hero text-text-primary leading-tight mb-6">
                    {!! nl2br(e($headline)) !!}
                </h1>

                {{-- Sub headline --}}
                <p class="text-lg text-text-muted leading-relaxed mb-8 max-w-xl mx-auto lg:mx-0">
                    {{ $subline }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('contacts') }}#form" class="btn-accent btn-lg">
                        Записаться на консультацию
                    </a>
                    <a href="{{ route('courses.index') }}" class="btn-outline btn-lg">
                        Смотреть курсы
                    </a>
                </div>

                {{-- Stats --}}
                @if(!empty($stats))
                <div class="flex flex-wrap gap-6 mt-10 justify-center lg:justify-start">
                    @foreach($stats as $stat)
                    <div class="text-center lg:text-left">
                        <div class="font-heading font-bold text-2xl text-accent">{{ $stat['value'] }}</div>
                        <div class="text-xs text-text-muted mt-0.5">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Photo --}}
            <div class="order-1 lg:order-2 flex justify-center">
                <div class="relative">
                    {{-- Glow ring --}}
                    <div class="absolute inset-0 rounded-2xl bg-gradient-accent opacity-20 blur-2xl scale-105"></div>
                    {{-- Border frame --}}
                    <div class="relative rounded-2xl border border-accent/30 overflow-hidden shadow-card-hover">
                        @if($photo)
                            <img
                                src="{{ $photo }}"
                                alt="{{ $name }}"
                                class="w-full max-w-sm lg:max-w-md h-auto object-cover"
                                loading="eager"
                            >
                        @else
                            {{-- Placeholder --}}
                            <div class="w-80 h-96 lg:w-96 lg:h-[480px] bg-gradient-card flex items-center justify-center">
                                <div class="text-center text-text-muted">
                                    <svg class="w-24 h-24 mx-auto mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <p class="text-sm">Фото специалиста</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- Floating badge --}}
                    <div class="absolute -bottom-4 -left-4 bg-bg-card border border-border-soft rounded-card px-4 py-3 shadow-card">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            <span class="text-xs font-medium text-text-primary">Сертифицированный специалист</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce text-text-muted">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>
