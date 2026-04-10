@props(['post'])

<a href="{{ route('news.show', $post->slug) }}"
   class="card group flex flex-col hover:border-accent-main/40 transition-all duration-300 hover:-translate-y-1">

    @if($post->cover)
        <div class="aspect-[16/9] overflow-hidden rounded-t-xl -mx-6 -mt-6 mb-5">
            <img src="{{ $post->cover }}" alt="{{ $post->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
    @endif

    <div class="flex flex-col flex-1">
        @if($post->category)
            <span class="text-xs text-accent-main uppercase tracking-wider font-medium mb-2">{{ $post->category }}</span>
        @endif

        <h3 class="font-heading font-semibold text-text-primary text-lg leading-snug mb-2 group-hover:text-accent-main transition-colors">
            {{ $post->title }}
        </h3>

        @if($post->excerpt)
            <p class="text-text-muted text-sm leading-relaxed mb-4 flex-1">{{ Str::limit($post->excerpt, 120) }}</p>
        @endif

        <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/5 text-xs text-text-muted">
            <time datetime="{{ $post->publish_at?->toIso8601String() }}">
                {{ $post->publish_at?->translatedFormat('d F Y') }}
            </time>
            <span class="text-accent-main font-medium group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                Читать
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        </div>
    </div>
</a>
