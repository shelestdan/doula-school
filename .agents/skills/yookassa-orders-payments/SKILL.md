---
name: yookassa-orders-payments
description: Используй этот skill, когда задача касается заказов, checkout flow, интеграции YooKassa, webhook, статусов оплаты, идемпотентности, журналирования payment events и автоматической выдачи доступа после оплаты. Не используй для общей CMS-логики, если платежи не затронуты.
---

# Цель

Построить надежный платежный контур для продажи курсов.

# Базовые сущности

- Order
- OrderItem (если пока один товар, все равно учитывай возможность расширения)
- Payment
- PaymentEvent
- Refund (опционально)
- PromoCode (архитектурно предусмотреть)

# Статусы заказа

Минимально:
- pending
- awaiting_payment
- paid
- canceled
- refunded

# Статусы платежа

Хранить:
- provider
- provider_payment_id
- provider_status
- internal_status
- amount
- currency
- paid_at
- raw payload fragments where needed

# Ключевые правила

- Не выдавать доступ к курсу до подтвержденной успешной оплаты.
- Не создавать повторный доступ при дублирующихся webhook.
- Все webhook handler'ы должны быть идемпотентны.
- Все внешние payload'ы логировать безопасно и структурированно.
- Статусы заказа и платежа должны синхронизироваться, но не сливаться в одну сущность.

# Checkout flow

1. Пользователь нажимает "Купить курс".
2. Создается order.
3. Создается payment record.
4. Создается external payment в YooKassa.
5. Пользователь проходит оплату.
6. Webhook или verify step подтверждает статус.
7. Order переводится в paid.
8. Создается course access grant.
9. Пользователь получает подтверждение.

# Webhook rules

- Проверять источник/подпись, если применимо.
- Сохранять payment event до обработки.
- Обрабатывать повторные события безопасно.
- Если order уже paid и access уже выдан, повторно не выдавать.
- Обновление статусов делать через service/action, а не прямо в controller.

# Типовые actions

- CreateOrderAction
- CreatePaymentAction
- InitiateYooKassaPaymentAction
- HandleYooKassaWebhookAction
- ConfirmOrderPaidAction
- GrantCourseAccessAfterPaymentAction

# Ошибки

Предусмотреть сценарии:
- пользователь вернулся без webhook
- webhook пришел позже
- webhook дублировался
- провайдер вернул нестандартный статус
- order существует, payment не найден
- payment найден, course access уже есть

# UI и admin

В админке должны быть:
- список заказов
- список платежей
- статусы
- provider ids
- сумма
- привязка к пользователю и курсу
- журнал событий
- ручная сверка статуса при необходимости

# Результат

По платежной задаче всегда выдай:
1. payment flow
2. сущности и статусы
3. идемпотентность
4. код
5. что проверить на тестовом сценарии
