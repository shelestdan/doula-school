---
name: lms-courses-access-control
description: Используй этот skill, когда задача касается курсов, модулей, уроков, личного кабинета ученика, выдачи доступа, прогресса, preview-уроков, публикации контента и LMS-light логики. Не используй для общих CRM-задач, если они не связаны с курсами.
---

# Цель

Сделать простой, надежный LMS-light для продажи и выдачи онлайн-уроков.

# Базовые сущности

- Course
- Module
- Lesson
- CourseAccessGrant
- LessonProgress
- StudentProfile (если нужно отдельно)
- Attachment / Media

# Course

Полезные поля:
- title
- slug
- subtitle
- short_description
- full_description
- cover
- price
- old_price
- access_type
- is_active
- is_featured
- status
- published_at

# Module

- course_id
- title
- description
- sort_order

# Lesson

- course_id
- module_id
- title
- slug
- short_description
- content
- video_url
- duration
- is_preview
- is_published
- published_at
- sort_order

# AccessGrant

Используй отдельную сущность доступа.
Не завязывай доступ только на order status напрямую.

Поля:
- user_id
- course_id
- granted_by_type
- granted_by_id
- source
- starts_at
- ends_at
- revoked_at
- notes

# Принципы доступа

- Доступ определяется через access grants.
- Успешная оплата может создавать grant.
- Админ может создать grant вручную.
- Админ может отозвать доступ.
- Preview lessons доступны без покупки, если это разрешено.

# Прогресс

- Отдельная таблица lesson progress.
- Прогресс должен переживать повторные входы.
- Прогресс не должен вычисляться только на лету без сохранения, если кабинет это активно использует.

# Публикация контента

Разделяй:
- draft
- published
- scheduled (если нужно)

Никогда не показывай неопубликованный lesson публично или ученику без специальных прав.

# Личный кабинет ученика

Нужны экраны:
- мои курсы
- страница курса
- модуль/урок
- прогресс
- профиль

# Правила безопасности

- Проверять доступ к курсу до доступа к lesson.
- Проверять доступ к lesson attachments.
- Не светить приватные video_url без проверки прав.
- Не завязывать контроль доступа только на фронтенд.

# Типовые actions

- CreateCourseAction
- PublishCourseAction
- CreateLessonAction
- PublishLessonAction
- GrantCourseAccessAction
- RevokeCourseAccessAction
- MarkLessonCompletedAction
- RecalculateCourseProgressAction

# Результат

Когда используешь этот skill:
1. Сначала перечисли сущности LMS.
2. Затем связи и статусы.
3. Затем access rules.
4. Потом код.
