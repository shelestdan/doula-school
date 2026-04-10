---
name: laravel-monolith-architecture
description: Используй этот skill, когда нужно спроектировать или реализовать архитектуру Laravel-монолита для проекта на PHP с Blade, Livewire, Filament, API и модульными доменами. Используй для проектирования моделей, миграций, сервисов, DTO, policies, actions, маршрутов, структуры модулей и границ ответственности. Не используй для чисто UI-задач публичного сайта, если не требуется изменение архитектуры. Не используй для узких задач платежей, SEO или Filament-админки, если можно вызвать более специализированный skill.
---

# Цель

Спроектировать и реализовывать production-friendly Laravel 12 монолит, который:
- работает на shared hosting
- остается расширяемым
- не превращается в набор god-controller'ов и случайной логики
- готов к будущему внешнему фронтенду через API

# Архитектурные принципы

- Один Laravel-монолит как единая кодовая база.
- Четкое разделение по доменам.
- Тонкие controllers.
- Бизнес-логика в Services / Actions.
- Валидация через Form Requests.
- Авторизация через Policies / Gates.
- API отделено от web-layer.
- Filament-админка не должна содержать бизнес-логику прямо внутри form/table callbacks, если эта логика важна для домена.
- Не дублировать одну и ту же логику между web, api и admin.

# Предпочтительная доменная структура

Используй домены уровня:
- Core
- Users
- RolesPermissions
- Pages
- PageBlocks
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
- AccessGrants
- Seo
- Media
- Settings
- Analytics
- Notifications

Допустимая структура:
- app/Domain/<DomainName>/Models
- app/Domain/<DomainName>/Actions
- app/Domain/<DomainName>/Services
- app/Domain/<DomainName>/DTO
- app/Domain/<DomainName>/Enums
- app/Domain/<DomainName>/Policies
- app/Domain/<DomainName>/Queries

Если проект еще не структурирован, сначала предложи целевую структуру, затем вноси изменения поэтапно.

# Что делать при архитектурной задаче

1. Сначала определить домены, затронутые задачей.
2. Выписать сущности и их связи.
3. Определить, какая логика относится к:
   - controller
   - request validation
   - action/service
   - model
   - policy
   - job / scheduler
4. Определить web routes и api routes отдельно.
5. Проверить, не дублирует ли новая сущность уже существующую.
6. Если задача крупная, сначала выдать plan, затем код.

# Стандарты моделей

- Используй явные casts.
- Используй enum там, где есть фиксированные статусы.
- Не перегружай model бизнес-логикой, кроме очевидных domain helpers / scopes.
- Добавляй scopes для частых выборок.
- Добавляй phpdoc/type hints там, где это помогает IDE и читабельности.

# Стандарты миграций

- Явные foreign keys.
- Индексы на:
  - slug
  - status
  - publish_at / published_at
  - внешние ключи
  - order/payment/provider identifiers
  - frequent filter columns
- Для nullable полей проверяй, действительно ли nullable оправдан.
- Для денормализованных полей объясняй причину.

# Стандарты сервисного слоя

Используй Action/Service, если:
- есть нетривиальная бизнес-логика
- логика нужна в нескольких entry points
- нужно тестировать поведение отдельно от UI
- операция меняет несколько сущностей

Примеры имен:
- CreateLeadAction
- PublishCourseAction
- GrantCourseAccessAction
- SyncPaymentStatusAction

# DTO

Используй DTO для:
- входных данных в action/service
- агрегирования validated payload
- boundary между request layer и domain layer

# Controllers

Controllers должны:
- авторизовать действие
- валидировать вход
- вызвать action/service
- вернуть response / redirect / resource

Controllers не должны:
- содержать длинные SQL-конструкции
- вручную собирать половину бизнес-процесса
- повторять логику из админки или API

# API readiness

Всегда думай, можно ли эту логику потом переиспользовать через `/api/v1`.
Если да, выноси ее из blade/livewire/filament callbacks в domain-level actions/services.

# Результат работы

По архитектурной задаче выдавай:
1. Краткий plan.
2. Список файлов, которые будут добавлены/изменены.
3. Код.
4. Краткое explanation, почему так.
5. Что проверить после внедрения.
