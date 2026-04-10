<div>
    {{-- Filters --}}
    <div class="flex flex-col sm:flex-row gap-3 mb-8">
        <div class="flex-1">
            <input wire:model.live.debounce.300ms="search" type="search"
                class="input" placeholder="Поиск курсов...">
        </div>
        <select wire:model.live="level" class="input sm:w-48">
            <option value="">Все уровни</option>
            <option value="beginner">Начинающий</option>
            <option value="intermediate">Средний</option>
            <option value="advanced">Продвинутый</option>
        </select>
        <select wire:model.live="sort" class="input sm:w-48">
            <option value="featured">По популярности</option>
            <option value="new">Сначала новые</option>
            <option value="price_asc">Цена ↑</option>
            <option value="price_desc">Цена ↓</option>
        </select>
    </div>

    {{-- Grid --}}
    <div wire:loading.class="opacity-50 pointer-events-none transition-opacity">
        @if($courses->isEmpty())
            <div class="text-center py-16 text-text-muted">
                <svg class="w-12 h-12 mx-auto mb-4 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p>Курсы не найдены. Попробуйте другой запрос.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $courses->links() }}
            </div>
        @endif
    </div>
</div>
