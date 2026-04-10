# AGENTS.md — Школа материнства / Доула

## Проект

MVP-платформа: сайт-визитка + LMS + CRM + оплата курсов.
Хостинг: Timeweb shared hosting. PHP 8.5. MySQL.

## Стек

- Laravel 12
- Blade + Livewire + Tailwind (публичный сайт)
- Filament (admin panel / CRM)
- Laravel Sanctum (API + future frontend)
- Spatie Laravel Permission (RBAC)
- Spatie Media Library (медиа)
- YooKassa (оплата)
- Database queue + cron/scheduler (фоновые задачи)

## Структура репозитория

```
app/
  Domain/          # доменные модули
    Core/
    Users/
    RolesPermissions/
    Pages/
    PageBlocks/
    News/
    Partners/
    Services/
    Prices/
    Leads/
    Consultations/
    Courses/
    Modules/
    Lessons/
    Orders/
    Payments/
    AccessGrants/
    Seo/
    Media/
    Settings/
    Analytics/
    Notifications/
  Filament/        # admin resources, pages, widgets
  Http/
    Controllers/
    Livewire/
    Requests/
resources/
  views/           # Blade templates
database/
  migrations/
  seeders/
routes/
  web.php
  api.php
```

## Skill routing

- Архитектура монолита, новые домены, модели, миграции, сервисы → `laravel-monolith-architecture`
- Инфраструктура, деплой, scheduler, очереди, shared hosting → `timeweb-shared-hosting-guardrails`
- Filament admin/CRM → `filament-crm-admin-builder`
- Публичный сайт Blade/Livewire, блочная CMS → `livewire-blade-cms-pages`
- Курсы, уроки, доступ, прогресс, кабинет ученика → `lms-courses-access-control`
- Заказы, YooKassa, webhook, выдача доступа → `yookassa-orders-payments`
- SEO, city pages, schema, sitemap, redirects → `seo-local-business-pages`
- `/api/v1`, Sanctum, contracts → `api-contracts-sanctum`
- После любой нетривиальной задачи → `qa-done-definition`

## Engineering rules

- Сначала план, затем код для крупных задач.
- Никаких решений, несовместимых с Timeweb shared hosting.
- Нет Node SSR как базовой архитектуры.
- Бизнес-логика не в Filament callbacks / Blade / Livewire — только в domain actions/services.
- Все фичи проектировать с возможностью переиспользования через `/api/v1`.
- Задача завершена только после прохождения `qa-done-definition`.

## Команды

```bash
# Локальная разработка
composer install
npm install && npm run build
php artisan migrate --seed
php artisan storage:link
php artisan serve

# Тесты
php artisan test

# Продакшен (Timeweb)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Cron entry на Timeweb (раз в минуту)
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

## Definition of done

Каждая задача считается завершенной, если:
- [ ] Миграции добавлены и откатываемы
- [ ] Routes прописаны (web + api где нужно)
- [ ] Form Requests для всех входных данных
- [ ] Policies / Gates для авторизации
- [ ] Бизнес-логика в Action/Service, не в контроллере
- [ ] Базовые тесты написаны или явно перечислены
- [ ] Нет зависимостей от long-running processes
- [ ] SEO поля учтены для публичных страниц
- [ ] Webhook идемпотентен (если касается платежей)
