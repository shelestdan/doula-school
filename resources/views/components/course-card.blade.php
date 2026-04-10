@props(['course'])

<a href="{{ route('courses.show', $course->slug) }}"
   class="card group flex flex-col hover:border-accent-main/60 transition-all duration-300 hover:-translate-y-1">

    {{-- Cover --}}
    <div class="relative aspect-[16/9] overflow-hidden rounded-t-xl -mx-6 -mt-6 mb-5">
        @if($course->cover)
            <img src="{{ $course->cover }}" alt="{{ $course->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full gradient-card flex items-center justify-center">
                <svg class="w-12 h-12 text-accent-main/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        @endif

        @if($course->badge)
            <span class="absolute top-3 left-3 badge-accent text-xs font-semibold">{{ $course->badge }}</span>
        @endif

        @if($course->hasDiscount())
            <span class="absolute top-3 right-3 bg-accent-gold text-bg-base text-xs font-bold px-2 py-1 rounded-full">
                -{{ $course->discountPercent() }}%
            </span>
        @endif
    </div>

    {{-- Body --}}
    <div class="flex flex-col flex-1">
        @if($course->level)
            <span class="text-xs text-text-muted uppercase tracking-wider mb-2">
                {{ match($course->level) { 'beginner' => 'Начинающий', 'intermediate' => 'Средний', 'advanced' => 'Продвинутый', default => $course->level } }}
            </span>
        @endif

        <h3 class="font-heading font-semibold text-text-primary text-lg leading-snug mb-2 group-hover:text-accent-main transition-colors">
            {{ $course->title }}
        </h3>

        @if($course->short_desc)
            <p class="text-text-muted text-sm leading-relaxed mb-4 flex-1">{{ Str::limit($course->short_desc, 110) }}</p>
        @endif

        {{-- Meta --}}
        <div class="flex items-center gap-4 text-xs text-text-muted mb-4">
            @if($course->lessons_count)
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                    </svg>
                    {{ $course->lessons_count }} уроков
                </span>
            @endif
            @if($course->duration_hours)
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $course->duration_hours }} ч
                </span>
            @endif
        </div>

        {{-- Price --}}
        <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/5">
            <div>
                <span class="text-xl font-bold text-accent-main">
                    {{ number_format($course->price, 0, '.', ' ') }} ₽
                </span>
                @if($course->hasDiscount())
                    <span class="ml-2 text-sm text-text-muted line-through">
                        {{ number_format($course->old_price, 0, '.', ' ') }} ₽
                    </span>
                @endif
            </div>
            <span class="text-accent-main text-sm font-medium group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                Подробнее
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        </div>
    </div>
</a>
