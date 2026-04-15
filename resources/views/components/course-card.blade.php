@props(['course'])

@php
    $slug = (string) ($course->slug ?? '');
    $levelLabel = match($course->level) {
        'beginner' => 'Базовый уровень',
        'intermediate' => 'Средний уровень',
        'advanced' => 'Продвинутый уровень',
        default => $course->level,
    };
    $iconType = str_contains($slug, 'partner')
        ? 'partner'
        : (str_contains($slug, 'mesyats') || str_contains($slug, 'malysh') ? 'baby' : 'birth');
    $paymentsEnabled = (bool) (($globalSettings ?? [])['yookassa_enabled'] ?? false);
    $checkoutUrl = $paymentsEnabled
        ? route('checkout.show', $course->slug)
        : route('contacts') . '?course=' . rawurlencode($course->slug) . '#form';
@endphp

<article class="group flex h-full flex-col overflow-hidden rounded-lg border border-border-soft bg-bg-card transition duration-300 hover:-translate-y-1 hover:border-accent/60 hover:shadow-card">
    <a href="{{ route('courses.show', $course->slug) }}" class="block">
        <div class="relative aspect-[16/10] overflow-hidden bg-gradient-card">
            @if($course->cover)
                <img
                    src="{{ $course->cover }}"
                    alt="{{ $course->title }}"
                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    loading="lazy"
                >
            @else
                <div class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_30%_20%,rgba(240,192,96,0.20),transparent_34%),linear-gradient(135deg,#1A0530,#150428)]">
                    <div class="flex h-16 w-16 items-center justify-center rounded-lg border border-accent/25 bg-accent/10 text-accent">
                        @if($iconType === 'partner')
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11a4 4 0 10-8 0m8 0a4 4 0 11-8 0m8 0v1a4 4 0 01-8 0v-1m-3 9a7 7 0 0114 0M5 20a5 5 0 0110 0"/>
                            </svg>
                        @elseif($iconType === 'baby')
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21c4 0 7-3 7-7 0-5-4-9-7-11-3 2-7 6-7 11 0 4 3 7 7 7z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h.01M15 13h.01M10 17c1.2.8 2.8.8 4 0"/>
                            </svg>
                        @else
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3c3 2.5 6 6.2 6 10a6 6 0 01-12 0c0-3.8 3-7.5 6-10z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14c1.6 1.3 4.4 1.3 6 0"/>
                            </svg>
                        @endif
                    </div>
                </div>
            @endif

            @if($course->badge)
                <span class="absolute left-3 top-3 badge-accent text-xs font-semibold">{{ $course->badge }}</span>
            @endif

            @if($course->hasDiscount())
                <span class="absolute right-3 top-3 rounded-full bg-gold px-2 py-1 text-xs font-bold text-bg-base">
                    -{{ $course->discountPercent() }}%
                </span>
            @endif
        </div>
    </a>

    <div class="flex flex-1 flex-col p-5">
        @if($levelLabel)
            <span class="mb-2 text-xs uppercase tracking-wider text-text-muted">{{ $levelLabel }}</span>
        @endif

        <a href="{{ route('courses.show', $course->slug) }}" class="mb-2 block">
            <h3 class="font-heading text-lg font-semibold leading-snug text-text-primary transition-colors group-hover:text-accent">
                {{ $course->title }}
            </h3>
        </a>

        @if($course->short_desc)
            <p class="mb-5 flex-1 text-sm leading-relaxed text-text-muted">{{ Str::limit($course->short_desc, 118) }}</p>
        @endif

        <div class="mb-5 flex flex-wrap items-center gap-3 text-xs text-text-muted">
            @if($course->lessons_count)
                <span>{{ $course->lessons_count }} уроков</span>
            @endif
            @if($course->duration_hours)
                <span>{{ $course->duration_hours }} ч</span>
            @endif
            <span>доступ навсегда</span>
        </div>

        <div class="mt-auto flex items-center justify-between gap-4 border-t border-white/5 pt-4">
            <div>
                <span class="text-xl font-bold text-accent">{{ number_format($course->price, 0, '.', ' ') }} ₽</span>
                @if($course->hasDiscount())
                    <span class="ml-2 text-sm text-text-muted line-through">
                        {{ number_format($course->old_price, 0, '.', ' ') }} ₽
                    </span>
                @endif
            </div>

            <a href="{{ $checkoutUrl }}" class="btn-accent btn-sm shrink-0">
                Купить курс
            </a>
        </div>
    </div>
</article>
