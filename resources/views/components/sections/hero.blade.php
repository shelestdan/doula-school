@props([
    'name' => 'Имя Фамилия',
    'title' => 'Доула · Консультант по материнству',
    'headline' => 'Рядом с тобой в самый важный момент жизни',
    'subline' => 'Профессиональное сопровождение в родах, подготовка к рождению малыша и школа материнства в Балашихе и Москве',
    'photo' => null,
    'stats' => [],
])

<section data-hero class="relative flex min-h-[92svh] items-center overflow-hidden bg-gradient-hero pt-24">
    @if($photo)
        <img
            src="{{ $photo }}"
            alt="{{ $name }}"
            class="absolute inset-0 h-full w-full object-cover"
            loading="eager"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-bg-base via-bg-base/82 to-bg-base/35"></div>
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-bg-base to-transparent"></div>
    @else
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_72%_28%,rgba(240,192,96,0.14),transparent_30%),linear-gradient(135deg,#0F0320_0%,#1A0530_58%,#150428_100%)]"></div>
    @endif

    <div class="relative mx-auto w-full max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
        <div class="max-w-2xl">
            <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-accent/30 bg-accent/15 px-4 py-1.5">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                <span class="text-sm font-medium tracking-wide text-accent">{{ $title }}</span>
            </div>

            @if($name)
                <p class="mb-3 text-sm uppercase tracking-widest text-text-muted">{{ $name }}</p>
            @endif

            <h1 class="mb-6 font-heading text-hero font-bold leading-tight text-text-primary">
                {!! nl2br(e($headline)) !!}
            </h1>

            <p class="mb-8 max-w-xl text-lg leading-relaxed text-text-muted">
                {{ $subline }}
            </p>

            <div class="flex flex-col gap-4 sm:flex-row">
                <a href="{{ route('contacts') }}#form" class="btn-accent btn-lg">
                    Записаться на консультацию
                </a>
                <a href="{{ route('courses.index') }}" class="btn-outline btn-lg">
                    Смотреть курсы
                </a>
            </div>

            @if(!empty($stats))
                <div class="mt-10 grid max-w-xl grid-cols-3 gap-5 border-t border-white/10 pt-6">
                    @foreach($stats as $stat)
                        <div>
                            <div class="font-heading text-2xl font-bold text-accent">{{ $stat['value'] }}</div>
                            <div class="mt-1 text-xs leading-snug text-text-muted">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
