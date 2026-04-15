@extends('layouts.app')

@section('title', ($globalSettings['site_name'] ?? 'Школа материнства') . ' — Доула, подготовка к родам в Балашихе и Москве')
@section('description', 'Сертифицированная доула и школа материнства. Сопровождение в родах, подготовка к родам, партнёрские роды, онлайн-курсы. Балашиха, Москва.')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "{{ $globalSettings['site_name'] ?? 'Школа материнства' }}",
  "description": "Доула и школа материнства — сопровождение в родах, подготовка к родам, партнёрские роды",
  "url": "{{ url('/') }}",
  "telephone": "{{ $globalSettings['phone'] ?? '' }}",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Балашиха",
    "addressRegion": "Московская область",
    "addressCountry": "RU"
  },
  "areaServed": ["Балашиха", "Москва"],
  "serviceType": ["Доула", "Подготовка к родам", "Школа материнства"]
}
</script>
@endsection

@section('content')

    {{-- 1. HERO --}}
    <x-sections.hero
        :name="$specialist['name'] ?? ''"
        :title="$specialist['title'] ?? 'Доула · Перинатальный психолог'"
        :headline="$specialist['headline'] ?? 'Рядом с тобой\nв самый важный момент жизни'"
        :subline="$specialist['subline'] ?? 'Профессиональное сопровождение в родах, подготовка к рождению малыша и школа материнства в Балашихе и Москве'"
        :photo="$specialist['photo'] ?? null"
        :stats="$heroStats ?? []"
    />

    {{-- 2. TRUST STRIP --}}
    @if(!empty($certifications))
    <div class="bg-bg-card border-y border-border-soft py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-center gap-6 text-sm text-text-muted">
                @foreach($certifications as $cert)
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        {{ $cert }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- 3. ABOUT --}}
    <x-sections.about
        :name="$specialist['name'] ?? ''"
        :title="$specialist['title'] ?? 'Доула · Перинатальный психолог'"
        :bio="$specialist['bio'] ?? ''"
        :photo="$specialist['about_photo'] ?? null"
        :secondary-photo="$specialist['certificate_photo'] ?? null"
        :credentials="$credentials ?? []"
        :values="$values ?? []"
    />

    {{-- 4. SERVICES --}}
    <x-sections.services :services="$services ?? []" />

    {{-- 5. COURSES --}}
    <x-sections.courses :courses="$courses ?? collect([])" />

    {{-- 6. TESTIMONIALS --}}
    <x-sections.testimonials :testimonials="$testimonials ?? []" />

    {{-- 7. LEAD MAGNET --}}
    <x-sections.lead-magnet />

    {{-- 8. BLOG PREVIEW --}}
    @if(!empty($latestNews) && $latestNews->count() > 0)
    <section class="py-section bg-bg-base">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-14">
                <div>
                    <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 rounded-full px-4 py-1.5 mb-4">
                        <span class="text-sm text-accent uppercase tracking-widest font-medium">Блог</span>
                    </div>
                    <h2 class="font-heading font-bold text-section text-text-primary">Последние статьи</h2>
                </div>
                <a href="{{ route('news.index') }}" class="btn-outline hidden sm:block">Все статьи</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestNews as $post)
                    <x-news-card :post="$post" />
                @endforeach
            </div>
            <div class="text-center mt-8 sm:hidden">
                <a href="{{ route('news.index') }}" class="btn-outline">Все статьи</a>
            </div>
        </div>
    </section>
    @endif

    {{-- 9. TEAM (lower on page as requested) --}}
    <x-sections.team :members="$partners ?? []" />

    {{-- 10. FAQ --}}
    <x-sections.faq :items="$faqItems ?? []" />

    {{-- 11. FINAL CTA --}}
    <section class="py-section-sm bg-gradient-hero relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute inset-0 bg-accent/5"></div>
        </div>
        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading font-bold text-3xl sm:text-4xl text-text-primary mb-6">
                Готовы начать путь<br>к осознанным родам?
            </h2>
            <p class="text-text-muted mb-8 text-lg">
                Запишитесь на бесплатную консультацию — обсудим ваш запрос и подберём подходящую программу
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contacts') }}#form" class="btn-accent btn-lg">
                    Записаться на консультацию
                </a>
                <a href="tel:{{ preg_replace('/[^+\d]/', '', $globalSettings['phone'] ?? '') }}" class="btn-outline btn-lg">
                    Позвонить
                </a>
            </div>
        </div>
    </section>

@endsection
