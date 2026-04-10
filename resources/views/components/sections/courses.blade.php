@props(['courses' => []])

<section id="courses" class="py-section bg-bg-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6 mb-14">
            <div>
                <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 rounded-full px-4 py-1.5 mb-4">
                    <span class="text-sm text-accent uppercase tracking-widest font-medium">Обучение</span>
                </div>
                <h2 class="font-heading font-bold text-section text-text-primary">Мои курсы</h2>
                <p class="mt-3 text-text-muted max-w-xl">Онлайн-курсы по подготовке к родам и материнству — учитесь в удобное время</p>
            </div>
            <a href="{{ route('courses.index') }}" class="btn-outline flex-shrink-0">
                Все курсы
            </a>
        </div>

        {{-- Courses grid --}}
        @if(!empty($courses) && $courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
        @else
            {{-- Placeholder --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    ['title' => 'Сила Родов', 'type' => 'Онлайн', 'duration' => '8 уроков', 'price' => 'от 3 900 ₽', 'featured' => true,  'badge' => 'Хит'],
                    ['title' => 'Партнёрские роды', 'type' => 'Онлайн', 'duration' => '5 уроков', 'price' => 'от 2 500 ₽', 'featured' => false, 'badge' => ''],
                    ['title' => 'Первые месяцы', 'type' => 'Онлайн', 'duration' => '6 уроков', 'price' => 'от 2 900 ₽', 'featured' => false, 'badge' => 'Новинка'],
                ] as $placeholder)
                <div class="group bg-bg-card border {{ $placeholder['featured'] ? 'border-accent/50' : 'border-border-soft' }} rounded-card overflow-hidden transition-all duration-300 hover:border-accent/60 hover:shadow-card-hover hover:-translate-y-1">
                    {{-- Cover placeholder --}}
                    <div class="relative h-48 bg-gradient-card flex items-center justify-center">
                        @if(!empty($placeholder['badge']))
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center bg-accent text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $placeholder['badge'] }}
                                </span>
                            </div>
                        @endif
                        <svg class="w-16 h-16 text-text-muted opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                        </svg>
                    </div>
                    {{-- Content --}}
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs bg-bg-light text-text-muted px-2 py-1 rounded">{{ $placeholder['type'] }}</span>
                            <span class="text-xs text-text-subtle">{{ $placeholder['duration'] }}</span>
                        </div>
                        <h3 class="font-heading font-semibold text-text-primary mb-2 group-hover:text-accent transition-colors duration-200">{{ $placeholder['title'] }}</h3>
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-border-soft">
                            <span class="font-bold text-gold">{{ $placeholder['price'] }}</span>
                            <a href="{{ route('courses.index') }}" class="text-accent text-sm font-medium hover:text-accent-light transition-colors duration-200 flex items-center gap-1">
                                Подробнее
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
