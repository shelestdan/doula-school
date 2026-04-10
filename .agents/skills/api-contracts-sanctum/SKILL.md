---
name: api-contracts-sanctum
description: Используй этот skill, когда задача касается проектирования или реализации `/api/v1`, Laravel Sanctum, resource responses, endpoint contracts, auth flow, пользовательских API для курсов, уроков, лидов, заказов и профиля. Не используй для чисто server-rendered UI-задач, если API не затронут.
---

# Цель

Сделать чистый, versioned API, который:
- поддерживает будущий отдельный фронтенд
- не дублирует хаотично web-логику
- имеет стабильные контракты
- совместим с Sanctum

# Общие правила API

- Все маршруты под `/api/v1`.
- Использовать Form Requests.
- Использовать API Resources / Transformers.
- Единый стиль ответов.
- Единый стиль ошибок.
- Не возвращать внутренние поля без необходимости.
- Не смешивать HTML concerns с API concerns.

# Предполагаемые группы endpoint'ов

## Public
- GET /api/v1/pages/{slug}
- GET /api/v1/news
- GET /api/v1/news/{slug}
- GET /api/v1/partners
- GET /api/v1/services
- GET /api/v1/courses
- GET /api/v1/courses/{slug}

## Auth
- POST /api/v1/auth/login
- POST /api/v1/auth/logout
- GET /api/v1/auth/me

## Leads
- POST /api/v1/leads
- POST /api/v1/consultations

## Student
- GET /api/v1/me/courses
- GET /api/v1/me/courses/{course}
- GET /api/v1/me/lessons/{lesson}
- POST /api/v1/me/lessons/{lesson}/complete

## Orders
- POST /api/v1/orders
- GET /api/v1/orders/{order}

# Sanctum

Используй Sanctum как стандартный слой auth для будущего SPA/mobile.
Если задача подразумевает browser-based frontend, учитывай CSRF/session сценарий.
Если задача подразумевает token use-case, проектируй его отдельно и явно.

# Правила контрактов

- Используй предсказуемые JSON поля.
- Не меняй ответ без причины.
- Сначала продумай response schema, потом код.
- Для списков — pagination там, где список может расти.
- Для связанных сущностей — не раздувай payload без нужды.

# Versioning

Любой новый API строить так, чтобы он мог жить в `/api/v1`.
Даже если сейчас нет `/api/v2`, не проектируй endpoint'ы так, будто versioning никогда не понадобится.

# Типовой ответ

Предпочтительно:
- data
- meta
- links
или другой единый стиль, если он уже принят в проекте

# Проверки безопасности

- Авторизация через policies / guards.
- Course access проверять на backend.
- Не отдавать приватные lesson/resource данные без access grant.
- Не раскрывать лишние идентификаторы провайдера платежей.

# Результат

По API-задаче сначала выдай:
1. endpoint list
2. request/response contracts
3. auth expectations
4. только затем код
