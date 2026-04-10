@props(['members' => []])

@if(!empty($members) && (is_array($members) ? count($members) : $members->count()) > 0)
<section id="team" class="py-section bg-bg-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 rounded-full px-4 py-1.5 mb-4">
                <span class="text-sm text-accent uppercase tracking-widest font-medium">Команда</span>
            </div>
            <h2 class="font-heading font-bold text-section text-text-primary">Мои партнёры</h2>
            <p class="mt-4 text-text-muted max-w-xl mx-auto">Специалисты, с которыми я работаю — психологи, акушерки, инструкторы</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($members as $member)
            <div class="bg-bg-card border border-border-soft rounded-card p-6 text-center transition-all duration-300 hover:border-accent/30 hover:shadow-card">
                {{-- Photo --}}
                <div class="w-20 h-20 rounded-full overflow-hidden mx-auto mb-4 border-2 border-border-soft">
                    @if(!empty($member['photo'] ?? $member->photo ?? null))
                        <img src="{{ $member['photo'] ?? Storage::url($member->photo) }}" alt="{{ $member['name'] ?? $member->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-accent flex items-center justify-center">
                            <span class="font-heading font-bold text-white text-xl">
                                {{ mb_substr($member['name'] ?? $member->name, 0, 1) }}
                            </span>
                        </div>
                    @endif
                </div>
                <h3 class="font-heading font-semibold text-text-primary mb-1">{{ $member['name'] ?? $member->name }}</h3>
                <p class="text-sm text-accent mb-3">{{ $member['specialization'] ?? $member->specialization }}</p>
                @if(!empty($member['description'] ?? $member->description ?? null))
                    <p class="text-xs text-text-muted leading-relaxed">{{ $member['description'] ?? $member->description }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
