@props(['testimonials' => []])

<section id="testimonials" class="py-section bg-bg-base overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 rounded-full px-4 py-1.5 mb-4">
                <span class="text-sm text-accent uppercase tracking-widest font-medium">Отзывы</span>
            </div>
            <h2 class="font-heading font-bold text-section text-text-primary">Что говорят мамы</h2>
            <p class="mt-4 text-text-muted max-w-xl mx-auto">Реальные истории семей, с которыми мы прошли этот путь вместе</p>
        </div>

        {{-- Testimonials slider --}}
        <div
            x-data="testimonialsSlider()"
            class="relative"
        >
            {{-- Slides --}}
            <div class="overflow-hidden">
                <div
                    class="flex transition-transform duration-500 ease-in-out"
                    :style="`transform: translateX(-${current * 100 / visibleCount}%)`"
                >
                    @php
                        $items = !empty($testimonials) ? $testimonials : [
                            ['name' => 'Анна К.', 'text' => 'Благодаря сопровождению я вошла в роды со спокойствием и уверенностью. Столько знаний и поддержки — это бесценно!', 'rating' => 5, 'service' => 'Доула в родах'],
                            ['name' => 'Мария Л.', 'text' => 'Курс подготовки к родам помог мне преодолеть страхи и встретить рождение малыша с радостью. Рекомендую всем будущим мамам!', 'rating' => 5, 'service' => 'Подготовка к родам'],
                            ['name' => 'Екатерина В.', 'text' => 'Прошла школу материнства в Балашихе. Узнала столько нужного о родах, уходе за малышом и кормлении. Спасибо за такую работу!', 'rating' => 5, 'service' => 'Школа материнства'],
                            ['name' => 'Ольга С.', 'text' => 'Муж тоже благодарен — курс по партнёрским родам дал ему уверенность быть рядом. Роды прошли намного лучше, чем мы ожидали.', 'rating' => 5, 'service' => 'Партнёрские роды'],
                            ['name' => 'Татьяна М.', 'text' => 'Онлайн-курс очень удобен — смотрела в любое время. Всё доступно объяснено, много практических советов. Уже жду следующего!', 'rating' => 5, 'service' => 'Онлайн-курс'],
                        ];
                    @endphp

                    @foreach($items as $item)
                    <div
                        class="flex-shrink-0 px-3"
                        :style="`width: ${100 / visibleCount}%`"
                    >
                        <div class="h-full bg-bg-card border border-border-soft rounded-card p-6 flex flex-col">
                            {{-- Stars --}}
                            <div class="flex items-center gap-1 mb-4">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            {{-- Quote --}}
                            <p class="text-text-muted text-sm leading-relaxed flex-1 mb-5">
                                "{{ is_array($item) ? $item['text'] : $item->text }}"
                            </p>
                            {{-- Author --}}
                            <div class="flex items-center gap-3 pt-4 border-t border-border-soft">
                                <div class="w-10 h-10 rounded-full bg-gradient-accent flex items-center justify-center flex-shrink-0">
                                    <span class="font-heading font-bold text-white text-sm">
                                        {{ mb_substr(is_array($item) ? $item['name'] : $item->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <div class="font-medium text-text-primary text-sm">{{ is_array($item) ? $item['name'] : $item->name }}</div>
                                    <div class="text-xs text-accent">{{ is_array($item) ? $item['service'] : ($item->service_name ?? '') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Nav buttons --}}
            <button
                @click="prev()"
                :disabled="current === 0"
                class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 w-10 h-10 bg-bg-card border border-border-soft rounded-full flex items-center justify-center text-text-muted hover:text-accent hover:border-accent/50 transition-all duration-200 disabled:opacity-30 disabled:cursor-not-allowed"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button
                @click="next()"
                :disabled="current >= total - visibleCount"
                class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 w-10 h-10 bg-bg-card border border-border-soft rounded-full flex items-center justify-center text-text-muted hover:text-accent hover:border-accent/50 transition-all duration-200 disabled:opacity-30 disabled:cursor-not-allowed"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            {{-- Dots --}}
            <div class="flex items-center justify-center gap-2 mt-8">
                <template x-for="i in Math.ceil(total / visibleCount)" :key="i">
                    <button
                        @click="current = (i - 1) * visibleCount"
                        :class="Math.floor(current / visibleCount) === i - 1 ? 'bg-accent w-6' : 'bg-border-soft w-2'"
                        class="h-2 rounded-full transition-all duration-300"
                    ></button>
                </template>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function testimonialsSlider() {
    return {
        current: 0,
        total: {{ count($items ?? []) }},
        get visibleCount() {
            if (window.innerWidth >= 1024) return 3;
            if (window.innerWidth >= 640) return 2;
            return 1;
        },
        prev() { if (this.current > 0) this.current -= this.visibleCount; },
        next() { if (this.current < this.total - this.visibleCount) this.current += this.visibleCount; },
    }
}
</script>
@endpush
