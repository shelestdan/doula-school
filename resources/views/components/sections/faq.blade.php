@props(['items' => []])

<section id="faq" class="py-section bg-bg-base">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 rounded-full px-4 py-1.5 mb-4">
                <span class="text-sm text-accent uppercase tracking-widest font-medium">FAQ</span>
            </div>
            <h2 class="font-heading font-bold text-section text-text-primary">Частые вопросы</h2>
        </div>

        <div class="space-y-3" x-data="{ open: null }">
            @php
                $questions = !empty($items) ? $items : [
                    ['q' => 'Кто такая доула и чем она отличается от акушерки?', 'a' => 'Доула — это сертифицированный специалист по сопровождению в родах. В отличие от акушерки, доула не выполняет медицинских манипуляций. Её задача — эмоциональная, физическая и информационная поддержка женщины и её партнёра на протяжении всего процесса.'],
                    ['q' => 'Зачем нужна доула, если есть акушерка и врач?', 'a' => 'Медицинский персонал роддома обеспечивает безопасность мамы и малыша. Доула занимается только вами: помогает с дыханием, массажем, поиском удобных позиций, успокаивает, отвечает на вопросы, общается с персоналом от вашего имени. Это непрерывное персональное присутствие.'],
                    ['q' => 'Когда лучше начинать подготовку к родам?', 'a' => 'Оптимально — с 26–28 недели беременности. Это даёт достаточно времени усвоить всё необходимое без спешки. Но никогда не бывает слишком поздно — даже за 4–6 недель до родов подготовка будет очень полезной.'],
                    ['q' => 'Можно ли пройти курс онлайн?', 'a' => 'Да! Все онлайн-курсы доступны в личном кабинете сразу после оплаты. Вы можете учиться в своём темпе, возвращаться к урокам и скачивать материалы. Онлайн-формат ничем не уступает офлайн по содержанию.'],
                    ['q' => 'Работаете ли вы с партнёрскими родами?', 'a' => 'Да, я провожу специальный курс для пар, которые хотят пройти через роды вместе. Муж или партнёр узнает, как реально помочь, а не просто присутствовать. После этого курса партнёры становятся настоящей опорой в родах.'],
                    ['q' => 'Есть ли офлайн-занятия?', 'a' => 'Да, школа материнства работает в Балашихе. Занятия проходят в небольших группах. Скоро откроется второй центр в Москве. Следите за новостями или запишитесь на консультацию, чтобы узнать актуальное расписание.'],
                ];
            @endphp

            @foreach($questions as $i => $item)
            <div class="bg-bg-card border border-border-soft rounded-card overflow-hidden transition-all duration-200 hover:border-accent/30">
                <button
                    @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                    class="flex items-center justify-between w-full px-6 py-4 text-left"
                    :aria-expanded="open === {{ $i }}"
                >
                    <span class="font-medium text-text-primary pr-4">{{ is_array($item) ? $item['q'] : $item->question }}</span>
                    <svg
                        class="w-5 h-5 text-accent flex-shrink-0 transition-transform duration-200"
                        :class="open === {{ $i }} ? 'rotate-180' : ''"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div
                    x-show="open === {{ $i }}"
                    x-collapse
                    class="px-6 pb-5"
                >
                    <p class="text-text-muted text-sm leading-relaxed">{{ is_array($item) ? $item['a'] : $item->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <p class="text-text-muted mb-4">Не нашли ответ?</p>
            <a href="{{ route('faq') }}" class="btn-outline mr-4">Все вопросы</a>
            <a href="{{ route('contacts') }}#form" class="btn-accent">Задать вопрос</a>
        </div>
    </div>
</section>
