@php
    $phone    = $globalSettings['phone'] ?? '+7 (999) 000-00-00';
    $email    = $globalSettings['email'] ?? '';
    $address  = $globalSettings['address'] ?? 'Балашиха, Московская область';
    $siteName = $globalSettings['site_name'] ?? 'Школа материнства';
    $socials  = [
        'vk'       => $globalSettings['social_vk'] ?? '',
        'telegram' => $globalSettings['social_telegram'] ?? '',
        'youtube'  => $globalSettings['social_youtube'] ?? '',
        'instagram'=> $globalSettings['social_instagram'] ?? '',
    ];
@endphp

<footer class="bg-bg-card border-t border-border-soft mt-auto">

    {{-- Main footer --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Brand --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="block mb-4">
                    <span class="font-heading font-bold text-xl text-text-primary">{{ $siteName }}</span>
                    <span class="block text-xs text-accent uppercase tracking-widest mt-1">Доула · Школа материнства</span>
                </a>
                <p class="text-sm text-text-muted leading-relaxed mb-6">
                    Профессиональное сопровождение в родах, подготовка к рождению ребёнка и школа материнства в Балашихе и Москве.
                </p>
                {{-- Socials --}}
                <div class="flex items-center gap-3">
                    @if(!empty($socials['vk']))
                        <a href="{{ $socials['vk'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="ВКонтакте">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M15.684 0H8.316C1.592 0 0 1.592 0 8.316v7.368C0 22.408 1.592 24 8.316 24h7.368C22.408 24 24 22.408 24 15.684V8.316C24 1.592 22.408 0 15.684 0zm3.692 17.123h-1.744c-.66 0-.864-.525-2.05-1.727-1.033-1-1.49-1.135-1.744-1.135-.356 0-.458.102-.458.593v1.575c0 .424-.135.677-1.253.677-1.846 0-3.896-1.118-5.335-3.202C4.624 10.857 4 8.408 4 8.205c0-.254.102-.491.593-.491h1.744c.44 0 .61.203.78.677.864 2.49 2.303 4.675 2.896 4.675.22 0 .322-.102.322-.66V9.721c-.068-1.186-.695-1.287-.695-1.71 0-.203.17-.407.44-.407h2.744c.373 0 .508.203.508.643v3.473c0 .372.17.508.271.508.22 0 .407-.136.813-.542 1.253-1.406 2.151-3.574 2.151-3.574.119-.254.322-.491.763-.491h1.744c.525 0 .643.27.525.643-.22 1.017-2.354 4.031-2.354 4.031-.186.305-.254.44 0 .78.186.254.796.78 1.203 1.253.745.847 1.32 1.558 1.473 2.05.17.491-.085.745-.576.745z"/></svg>
                        </a>
                    @endif
                    @if(!empty($socials['telegram']))
                        <a href="{{ $socials['telegram'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="Telegram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                        </a>
                    @endif
                    @if(!empty($socials['youtube']))
                        <a href="{{ $socials['youtube'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="YouTube">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Services --}}
            <div>
                <h3 class="font-heading font-semibold text-text-primary mb-4 text-base">Услуги</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('doula') }}" class="footer-link">Доула в родах</a></li>
                    <li><a href="{{ route('birth-prep') }}" class="footer-link">Подготовка к родам</a></li>
                    <li><a href="{{ route('partner-birth') }}" class="footer-link">Партнёрские роды</a></li>
                    <li><a href="{{ route('school') }}" class="footer-link">Школа материнства</a></li>
                    <li><a href="{{ route('courses.index') }}" class="footer-link">Онлайн-курсы</a></li>
                    <li><a href="{{ route('prices') }}" class="footer-link">Цены</a></li>
                </ul>
            </div>

            {{-- Info --}}
            <div>
                <h3 class="font-heading font-semibold text-text-primary mb-4 text-base">Информация</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('about') }}" class="footer-link">Обо мне</a></li>
                    <li><a href="{{ route('partners') }}" class="footer-link">Партнёры</a></li>
                    <li><a href="{{ route('news.index') }}" class="footer-link">Блог</a></li>
                    <li><a href="{{ route('faq') }}" class="footer-link">FAQ</a></li>
                    <li><a href="{{ route('contacts') }}" class="footer-link">Контакты</a></li>
                </ul>
            </div>

            {{-- Contacts --}}
            <div>
                <h3 class="font-heading font-semibold text-text-primary mb-4 text-base">Контакты</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="flex items-center gap-2 text-sm text-text-muted hover:text-accent transition-colors duration-200">
                            <svg class="w-4 h-4 flex-shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $phone }}
                        </a>
                    </li>
                    @if(!empty($email))
                    <li>
                        <a href="mailto:{{ $email }}" class="flex items-center gap-2 text-sm text-text-muted hover:text-accent transition-colors duration-200">
                            <svg class="w-4 h-4 flex-shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ $email }}
                        </a>
                    </li>
                    @endif
                    <li>
                        <div class="flex items-start gap-2 text-sm text-text-muted">
                            <svg class="w-4 h-4 flex-shrink-0 text-accent mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $address }}
                        </div>
                    </li>
                </ul>
                <a href="{{ route('contacts') }}#form" class="btn-accent mt-6 block text-center text-sm">
                    Записаться
                </a>
            </div>
        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-border-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-text-subtle">
                © {{ date('Y') }} {{ $siteName }}. Все права защищены.
            </p>
            <div class="flex items-center gap-4 text-xs">
                <a href="{{ route('privacy') }}" class="text-text-subtle hover:text-accent transition-colors duration-200">Политика конфиденциальности</a>
                <a href="{{ route('terms') }}" class="text-text-subtle hover:text-accent transition-colors duration-200">Пользовательское соглашение</a>
            </div>
        </div>
    </div>
</footer>
