<div>
    @if($sent)
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-accent-main/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-xl font-heading font-semibold text-text-primary mb-2">Сообщение отправлено!</h3>
            <p class="text-text-muted">Свяжусь с вами в ближайшее время.</p>
        </div>
    @else
        <form wire:submit="submit" class="space-y-4" novalidate>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="label">Имя *</label>
                    <input wire:model="name" type="text" class="input @error('name') border-red-500 @enderror" placeholder="Ваше имя">
                    @error('name')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="label">Телефон *</label>
                    <input wire:model="phone" type="tel" class="input @error('phone') border-red-500 @enderror" placeholder="+7 (___) ___-__-__">
                    @error('phone')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="label">Email</label>
                <input wire:model="email" type="email" class="input @error('email') border-red-500 @enderror" placeholder="your@email.ru">
                @error('email')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="label">Сообщение</label>
                <textarea wire:model="message" rows="4" class="input resize-none" placeholder="Ваш вопрос..."></textarea>
            </div>

            <button type="submit" class="btn-accent w-full sm:w-auto px-10"
                wire:loading.attr="disabled" wire:loading.class="opacity-75">
                <span wire:loading.remove>Отправить</span>
                <span wire:loading>Отправляем...</span>
            </button>
        </form>
    @endif
</div>
