<section class="py-section-sm bg-bg-section relative overflow-hidden">
    {{-- Background decoration --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-72 h-72 bg-accent/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-gold/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-card border border-accent/20 rounded-2xl p-8 sm:p-12 text-center">

            {{-- Icon --}}
            <div class="w-16 h-16 bg-accent/15 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>

            <div class="inline-flex items-center gap-2 bg-gold/10 border border-gold/20 rounded-full px-4 py-1.5 mb-4">
                <span class="text-sm text-gold uppercase tracking-widest font-medium">Бесплатно</span>
            </div>

            <h2 class="font-heading font-bold text-2xl sm:text-3xl text-text-primary mb-4">
                Получите бесплатный гайд<br>«Как подготовиться к родам»
            </h2>
            <p class="text-text-muted mb-8 max-w-xl mx-auto">
                10 страниц практических советов от сертифицированной доулы: дыхание, позиции, страхи и как с ними справиться
            </p>

            {{-- Form --}}
            <livewire:lead-form source="lead_magnet" button-text="Получить гайд бесплатно" />

            <p class="text-xs text-text-subtle mt-4">
                Нажимая кнопку, вы соглашаетесь с
                <a href="{{ route('privacy') }}" class="text-accent hover:text-accent-light underline">политикой конфиденциальности</a>
            </p>
        </div>
    </div>
</section>
