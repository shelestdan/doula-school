@php
    $phone    = $globalSettings['phone'] ?? '+7 (999) 000-00-00';
    $siteName = $globalSettings['site_name'] ?? 'Школа материнства';
    $nav = [
        ['title' => 'Обо мне',    'url' => route('about')],
        ['title' => 'Доула',      'url' => route('doula')],
        ['title' => 'Подготовка', 'url' => '#', 'children' => [
            ['title' => 'Подготовка к родам',           'url' => route('birth-prep')],
            ['title' => 'Партнёрские роды',             'url' => route('partner-birth')],
            ['title' => 'Школа материнства',            'url' => route('school')],
        ]],
        ['title' => 'Курсы',      'url' => route('courses.index')],
        ['title' => 'Новости',    'url' => route('news.index')],
        ['title' => 'Партнёры',   'url' => route('partners')],
        ['title' => 'Цены',       'url' => route('prices')],
        ['title' => 'Контакты',   'url' => route('contacts')],
    ];
@endphp

<header
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'bg-bg-base/95 backdrop-blur-md shadow-lg shadow-accent/5' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
                @if(!empty($globalSettings['logo']))
                    <img src="{{ Storage::url($globalSettings['logo']) }}" alt="{{ $siteName }}" class="h-12 w-auto">
                @else
                    <div class="flex flex-col">
                        <span class="font-heading font-bold text-xl text-text-primary leading-tight">{{ $siteName }}</span>
                        <span class="text-xs text-accent font-body uppercase tracking-widest">Доула · Подготовка к родам</span>
                    </div>
                @endif
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-1">
                @foreach($nav as $item)
                    @if(!empty($item['children']))
                        <div class="relative group" x-data="{ open: false }">
                            <button
                                @click="open = !open"
                                @click.outside="open = false"
                                class="flex items-center gap-1 px-3 py-2 text-sm font-body text-text-muted hover:text-text-primary transition-colors duration-200 group-hover:text-accent"
                            >
                                {{ $item['title'] }}
                                <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute top-full left-0 mt-1 w-56 bg-bg-card border border-border-soft rounded-card shadow-card overflow-hidden"
                            >
                                @foreach($item['children'] as $child)
                                    <a
                                        href="{{ $child['url'] }}"
                                        class="block px-4 py-3 text-sm text-text-muted hover:text-text-primary hover:bg-bg-light transition-colors duration-200 border-b border-border-soft last:border-0"
                                    >{{ $child['title'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a
                            href="{{ $item['url'] }}"
                            class="px-3 py-2 text-sm font-body text-text-muted hover:text-accent transition-colors duration-200 relative group"
                        >
                            {{ $item['title'] }}
                            <span class="absolute bottom-0 left-3 right-3 h-px bg-accent scale-x-0 group-hover:scale-x-100 transition-transform duration-200 origin-left"></span>
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- Desktop CTA + Phone --}}
            <div class="hidden lg:flex items-center gap-4">
                <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="text-sm text-text-muted hover:text-accent transition-colors duration-200">
                    {{ $phone }}
                </a>
                <a href="{{ route('contacts') }}#form" class="btn-accent text-sm">
                    Записаться
                </a>
            </div>

            {{-- Mobile Burger --}}
            <button
                @click="open = !open"
                class="lg:hidden p-2 text-text-muted hover:text-accent transition-colors duration-200"
                :aria-expanded="open"
                aria-label="Открыть меню"
            >
                <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden bg-bg-card border-t border-border-soft"
        @click.outside="open = false"
    >
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
            @foreach($nav as $item)
                @if(!empty($item['children']))
                    <div x-data="{ expanded: false }">
                        <button @click="expanded = !expanded" class="flex items-center justify-between w-full px-4 py-3 text-text-muted hover:text-text-primary hover:bg-bg-light rounded-btn transition-colors duration-200">
                            <span>{{ $item['title'] }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="expanded" class="ml-4 mt-1 space-y-1">
                            @foreach($item['children'] as $child)
                                <a href="{{ $child['url'] }}" class="block px-4 py-2 text-sm text-text-muted hover:text-accent transition-colors duration-200">
                                    {{ $child['title'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $item['url'] }}" class="block px-4 py-3 text-text-muted hover:text-text-primary hover:bg-bg-light rounded-btn transition-colors duration-200">
                        {{ $item['title'] }}
                    </a>
                @endif
            @endforeach
            <div class="pt-4 border-t border-border-soft space-y-3">
                <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="block px-4 py-2 text-text-muted hover:text-accent transition-colors duration-200">
                    {{ $phone }}
                </a>
                <a href="{{ route('contacts') }}#form" class="btn-accent w-full text-center block">
                    Записаться на консультацию
                </a>
            </div>
        </div>
    </div>
</header>
