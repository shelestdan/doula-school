@props(['service', 'linked' => true])

@php $tag = $linked ? 'a' : 'div'; @endphp

<{{ $tag }}
    @if($linked) href="{{ route('services.show', $service->slug) }}" @endif
    class="card group flex flex-col {{ $linked ? 'hover:border-accent-main/60 hover:-translate-y-1 cursor-pointer' : '' }} transition-all duration-300
        {{ $service->is_featured ? 'border-accent-main/40 card-featured' : '' }}">

    @if($service->is_featured)
        <div class="flex justify-end mb-3">
            <span class="badge-accent text-xs">Популярное</span>
        </div>
    @endif

    @if($service->icon)
        <div class="w-12 h-12 bg-accent-main/10 rounded-xl flex items-center justify-center mb-4 text-accent-main text-2xl">
            {!! $service->icon !!}
        </div>
    @endif

    <h3 class="font-heading font-semibold text-text-primary text-lg mb-2
        {{ $linked ? 'group-hover:text-accent-main transition-colors' : '' }}">
        {{ $service->title }}
    </h3>

    @if($service->short_desc)
        <p class="text-text-muted text-sm leading-relaxed flex-1 mb-4">{{ $service->short_desc }}</p>
    @endif

    @if($service->price || $service->price_from)
        <div class="mt-auto pt-4 border-t border-white/5">
            <span class="text-accent-main font-semibold">
                @if($service->price_from) от @endif
                {{ number_format($service->price ?? 0, 0, '.', ' ') }} ₽
            </span>
            @if($service->price_note)
                <span class="text-text-muted text-xs ml-1">{{ $service->price_note }}</span>
            @endif
        </div>
    @endif
</{{ $tag }}>
