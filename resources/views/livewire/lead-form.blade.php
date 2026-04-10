<div>
    @if($sent)
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-accent-main/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-xl font-heading font-semibold text-text-primary mb-2">Заявка принята!</h3>
            <p class="text-text-muted">Мы свяжемся с вами в ближайшее время.</p>
        </div>
    @else
        <form wire:submit="submit" class="space-y-4" novalidate>
            <div>
                <label for="lead-name" class="label">Ваше имя *</label>
                <input wire:model="name" id="lead-name" type="text" class="input @error('name') border-red-500 @enderror"
                    placeholder="Как вас зовут?" autocomplete="name">
                @error('name')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lead-phone" class="label">Телефон *</label>
                <input wire:model="phone" id="lead-phone" type="tel" class="input @error('phone') border-red-500 @enderror"
                    placeholder="+7 (___) ___-__-__" autocomplete="tel" x-mask="+7 (999) 999-99-99">
                @error('phone')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lead-email" class="label">Email</label>
                <input wire:model="email" id="lead-email" type="email" class="input @error('email') border-red-500 @enderror"
                    placeholder="your@email.ru" autocomplete="email">
                @error('email')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lead-message" class="label">Сообщение</label>
                <textarea wire:model="message" id="lead-message" rows="3" class="input resize-none @error('message') border-red-500 @enderror"
                    placeholder="Ваш вопрос или пожелание..."></textarea>
            </div>

            <button type="submit" class="btn-accent w-full" wire:loading.attr="disabled" wire:loading.class="opacity-75">
                <span wire:loading.remove>Отправить заявку</span>
                <span wire:loading class="flex items-center justify-center gap-2">
                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    Отправляем...
                </span>
            </button>

            <p class="text-xs text-text-muted text-center">
                Нажимая кнопку, вы соглашаетесь с
                <a href="{{ route('privacy') }}" class="text-accent-main hover:underline">политикой конфиденциальности</a>
            </p>
        </form>
    @endif
</div>
