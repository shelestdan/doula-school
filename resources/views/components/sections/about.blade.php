@props([
    'name'        => 'Имя Фамилия',
    'title'       => 'Доула · Перинатальный психолог',
    'bio'         => '',
    'photo'       => null,
    'credentials' => [],
    'values'      => [],
])

<section id="about" class="py-section bg-bg-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Photo + floating stats --}}
            <div class="relative flex justify-center">
                <div class="relative">
                    {{-- Main photo --}}
                    <div class="rounded-2xl overflow-hidden border border-border-soft shadow-card">
                        @if($photo)
                            <img src="{{ $photo }}" alt="{{ $name }}" class="w-full max-w-md h-auto object-cover">
                        @else
                            <div class="w-80 h-96 lg:w-96 lg:h-[450px] bg-gradient-card flex items-center justify-center">
                                <svg class="w-20 h-20 text-text-muted opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Floating credentials cards --}}
                    @foreach($credentials as $i => $cred)
                    <div class="absolute {{ $i === 0 ? '-bottom-6 -right-6' : '-top-6 -left-6' }} bg-bg-card border border-border-soft rounded-card p-4 shadow-card max-w-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-accent/15 flex items-center justify-center flex-shrink-0">
                                <span class="font-heading font-bold text-accent text-sm">{{ $cred['icon'] ?? substr($cred['label'], 0, 2) }}</span>
                            </div>
                            <div>
                                <div class="font-heading font-bold text-xl text-accent leading-none">{{ $cred['value'] }}</div>
                                <div class="text-xs text-text-muted mt-0.5">{{ $cred['label'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Text content --}}
            <div>
                <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 rounded-full px-4 py-1.5 mb-4">
                    <span class="text-sm text-accent uppercase tracking-widest font-medium">Обо мне</span>
                </div>

                <h2 class="font-heading font-bold text-section text-text-primary mb-2">{{ $name }}</h2>
                <p class="text-accent font-medium mb-6">{{ $title }}</p>

                @if($bio)
                    <div class="prose prose-invert prose-sm max-w-none text-text-muted leading-relaxed mb-8">
                        {!! $bio !!}
                    </div>
                @else
                    <div class="space-y-4 text-text-muted leading-relaxed mb-8">
                        <p>Я помогаю женщинам встретить роды с уверенностью и спокойствием. Как доула, я нахожусь рядом в самый важный момент вашей жизни — с начала схваток до первого взгляда на малыша.</p>
                        <p>Более 5 лет я сопровождаю семьи в родах, проводю подготовительные курсы и консультации по перинатальной психологии. Каждая история уникальна, и я рядом с каждой из них.</p>
                    </div>
                @endif

                {{-- Values --}}
                @if(!empty($values))
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    @foreach($values as $value)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-accent/15 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-text-primary text-sm">{{ $value['title'] }}</div>
                            @if(!empty($value['desc']))
                                <div class="text-xs text-text-muted mt-0.5">{{ $value['desc'] }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <a href="{{ route('about') }}" class="btn-outline">
                    Узнать больше обо мне
                </a>
            </div>
        </div>
    </div>
</section>
