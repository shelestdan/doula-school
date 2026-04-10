@props(['services' => []])

<section id="services" class="py-section bg-bg-base">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 rounded-full px-4 py-1.5 mb-4">
                <span class="text-sm text-accent uppercase tracking-widest font-medium">Мои услуги</span>
            </div>
            <h2 class="font-heading font-bold text-section text-text-primary">Как я могу вам помочь</h2>
            <p class="mt-4 text-text-muted max-w-2xl mx-auto">Индивидуальный подход к каждой семье — от первой консультации до встречи малыша</p>
        </div>

        {{-- Services grid --}}
        @if(!empty($services))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        @else
            {{-- Default placeholder services --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    ['icon' => '🤱', 'title' => 'Доула в родах', 'desc' => 'Профессиональное сопровождение в роддоме с начала схваток. Я рядом 24/7, поддерживаю физически и эмоционально.', 'url' => '/doula', 'featured' => true],
                    ['icon' => '🧘', 'title' => 'Подготовка к родам', 'desc' => 'Индивидуальные и групповые занятия по подготовке к родам: дыхание, позиции, психологическая готовность.', 'url' => '/birth-prep', 'featured' => false],
                    ['icon' => '💑', 'title' => 'Партнёрские роды', 'desc' => 'Подготовка пары к совместным родам. Роль партнёра, как поддержать, что делать в каждом периоде.', 'url' => '/partner-birth', 'featured' => false],
                    ['icon' => '🏫', 'title' => 'Школа материнства', 'desc' => 'Офлайн-занятия в Балашихе. Комплексная подготовка: роды, уход за новорождённым, грудное вскармливание.', 'url' => '/school', 'featured' => false],
                    ['icon' => '💬', 'title' => 'Консультация', 'desc' => 'Индивидуальная консультация по любым вопросам: подготовка к родам, страхи, выбор роддома.', 'url' => '/contacts', 'featured' => false],
                    ['icon' => '📚', 'title' => 'Онлайн-курсы', 'desc' => 'Самостоятельное обучение в удобное время. Видеоуроки, материалы и практические задания.', 'url' => '/courses', 'featured' => false],
                ] as $item)
                <a href="{{ $item['url'] }}" class="group block">
                    <div class="h-full bg-bg-card border {{ $item['featured'] ? 'border-accent/50' : 'border-border-soft' }} rounded-card p-6 transition-all duration-300 hover:border-accent/60 hover:shadow-card-hover hover:-translate-y-1">
                        @if($item['featured'])
                            <div class="inline-flex items-center gap-1.5 bg-accent/15 text-accent text-xs font-medium px-3 py-1 rounded-full mb-4">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                Главная услуга
                            </div>
                        @endif
                        <div class="text-3xl mb-4">{{ $item['icon'] }}</div>
                        <h3 class="font-heading font-semibold text-card text-text-primary mb-3 group-hover:text-accent transition-colors duration-200">{{ $item['title'] }}</h3>
                        <p class="text-sm text-text-muted leading-relaxed mb-4">{{ $item['desc'] }}</p>
                        <div class="flex items-center gap-1 text-accent text-sm font-medium">
                            Подробнее
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        @endif

        {{-- CTA --}}
        <div class="text-center mt-12">
            <a href="{{ route('services.index') }}" class="btn-outline">
                Все услуги и цены
            </a>
        </div>
    </div>
</section>
