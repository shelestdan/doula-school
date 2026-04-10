---
name: filament-crm-admin-builder
description: Используй этот skill, когда задача касается Filament admin panel, CRM-интерфейса, resources, custom pages, widgets, forms, tables, filters, relation managers, dashboard и админских workflow. Не используй для публичных Blade/Livewire страниц, если задача не затрагивает админку.
---

# Цель

Строить современную, удобную и расширяемую CRM/админку на Filament.

# Основные модули админки

- Dashboard
- Pages
- Page Blocks
- News
- Partners
- Services
- Prices
- Leads
- Consultations
- Courses
- Modules
- Lessons
- Orders
- Payments
- Users
- Roles and Permissions
- SEO
- Settings

# Принципы

- Filament — только UI-слой и orchestration.
- Бизнес-логика — в domain actions/services.
- Формы должны быть удобными для не-технического администратора.
- Таблицы должны поддерживать реальные CRM-сценарии:
  - search
  - filters
  - sorting
  - bulk actions
  - status badges
  - быстрые переходы
- Не усложнять UI без причины.

# Dashboard

На dashboard по умолчанию предусматривать виджеты:
- новые лиды
- заявки по статусам
- оплаченные заказы
- выручка за период
- популярные курсы
- ближайшие консультации
- недавно обновленные страницы

# Leads CRM

Обязательно поддерживать:
- статус
- assigned_to
- теги
- источник
- utm-метки
- комментарии менеджера
- timeline / history
- экспорт
- быстрые смены статуса

# Формы

Во всех Filament forms:
- понятные русские labels
- helper text там, где возможна ошибка контент-менеджера
- slug generation только там, где это уместно
- явные валидационные правила
- для тяжелых форм — разделение на tabs/sections

# Таблицы

Во всех таблицах:
- столбцы только действительно полезные
- скрывать второстепенные колонки в toggleable columns
- использовать color badges для статусов
- action buttons должны быть короткими и очевидными
- если запись критична — показывать audit-like fields

# Settings

В settings-панели предусматривать:
- название проекта
- контакты
- соцсети
- адреса и города
- default SEO
- коды аналитики
- юридические тексты
- логотип и favicon

# Custom pages

Используй custom Filament pages, если:
- нужен сложный dashboard
- нужен визуальный конструктор управления
- требуется агрегированная аналитика
- обычный Resource не подходит

# Когда создавать Resource

Создавай Resource, если есть CRUD-сущность:
- Course
- Lesson
- Lead
- NewsPost
- Partner
- Redirect
- SeoPage
- Order
- Payment

# Когда создавать Relation Manager

Используй Relation Manager, если:
- дочерняя сущность логически живет внутри родителя
- удобно редактировать в контексте родителя

Примеры:
- Course -> Modules
- Module -> Lessons
- Lead -> Notes
- Page -> Blocks

# UX правила

- Админка должна быть usable с первого дня.
- Не перегружать экраны.
- Любое опасное действие — confirm.
- Публикация/архивация/удаление должны быть визуально различимы.
- Для курсов и уроков показывать draft/published state очевидно.

# Результат

По Filament-задаче выдавай:
1. Какие resources/pages/widgets нужны.
2. Какие формы/таблицы будут созданы.
3. Где лежит бизнес-логика.
4. Как это выглядит в реальном workflow администратора.
