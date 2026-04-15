@props(['courses' => []])

<section id="courses" class="py-section bg-bg-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6 mb-14">
            <div>
                <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 rounded-full px-4 py-1.5 mb-4">
                    <span class="text-sm text-accent uppercase tracking-widest font-medium">Обучение</span>
                </div>
                <h2 class="font-heading font-bold text-section text-text-primary">Курсы</h2>
                <p class="mt-3 text-text-muted max-w-xl">Подготовка к родам, партнёрская поддержка и первые недели после рождения малыша.</p>
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
                    ['title' => 'Сила родов', 'text' => 'База подготовки: тело, дыхание, этапы родов, решения в роддоме.', 'duration' => '8 уроков', 'price' => '3 900 ₽', 'featured' => true, 'badge' => 'Хит'],
                    ['title' => 'Партнёрские роды', 'text' => 'Конкретные действия для партнёра: поддержка, массаж, контакт с персоналом.', 'duration' => '5 уроков', 'price' => '2 500 ₽', 'featured' => false, 'badge' => ''],
                    ['title' => 'Первые месяцы с малышом', 'text' => 'Восстановление, уход, грудное вскармливание и спокойный быт дома.', 'duration' => '6 уроков', 'price' => '2 900 ₽', 'featured' => false, 'badge' => 'Новинка'],
                ] as $placeholder)
                <div class="group bg-bg-card border {{ $placeholder['featured'] ? 'border-accent/50' : 'border-border-soft' }} rounded-lg overflow-hidden transition-all duration-300 hover:border-accent/60 hover:shadow-card-hover hover:-translate-y-1">
                    {{-- Cover placeholder --}}
                    <div class="relative h-48 bg-gradient-card flex items-center justify-center">
                        @if(!empty($placeholder['badge']))
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center bg-accent text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $placeholder['badge'] }}
                                </span>
                            </div>
                        @endif
                        <div class="flex h-16 w-16 items-center justify-center rounded-lg border border-accent/25 bg-accent/10 text-accent">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3c3 2.5 6 6.2 6 10a6 6 0 01-12 0c0-3.8 3-7.5 6-10z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14c1.6 1.3 4.4 1.3 6 0"/>
                            </svg>
                        </div>
                    </div>
                    {{-- Content --}}
                    <div class="flex min-h-64 flex-col p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs bg-bg-light text-text-muted px-2 py-1 rounded">Онлайн</span>
                            <span class="text-xs text-text-subtle">{{ $placeholder['duration'] }}</span>
                        </div>
                        <h3 class="font-heading font-semibold text-text-primary mb-2 group-hover:text-accent transition-colors duration-200">{{ $placeholder['title'] }}</h3>
                        <p class="text-sm text-text-muted leading-relaxed flex-1">{{ $placeholder['text'] }}</p>
                        <div class="flex items-center justify-between gap-4 mt-5 pt-4 border-t border-border-soft">
                            <span class="font-bold text-gold">{{ $placeholder['price'] }}</span>
                            <a href="{{ route('contacts') }}#form" class="btn-accent btn-sm shrink-0">
                                Купить курс
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
