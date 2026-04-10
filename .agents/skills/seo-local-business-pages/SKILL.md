---
name: seo-local-business-pages
description: Используй этот skill, когда задача касается SEO-архитектуры, мета-полей, canonical, robots, sitemap, redirects, structured data, slug strategy, city landing pages и локального продвижения услуг вроде 'доула Балашиха' или 'подготовка к родам Москва'. Не используй для чисто визуальных правок без SEO-эффекта.
---

# Цель

Построить чистую, расширяемую SEO-архитектуру для локального сайта услуг и курсов.

# Принципы

- SEO должно быть частью backend-модели, а не набором случайных хаков в шаблонах.
- Не создавать спамные дубли.
- Не плодить почти одинаковые city pages без уникальной ценности.
- Все мета-данные должны быть управляемы из CMS/admin.

# Что должно быть управляемым

- meta_title
- meta_description
- h1
- slug
- canonical_url
- og_title
- og_description
- og_image
- robots_meta
- noindex
- include_in_sitemap
- structured_data_json

# Поддерживаемые типы SEO-сущностей

- обычные страницы
- новости / статьи
- услуги
- курсы
- city landing pages
- redirects

# City pages

Поддерживать страницы под:
- доула Балашиха
- доула Москва
- помощь в родах Балашиха
- подготовка к родам Балашиха
- школа материнства Балашиха

При создании city pages:
- проверяй уникальность intent
- избегай машинного клонирования контента
- предусматривай масштабирование на другие города

# Structured data

Поддерживай:
- Organization
- LocalBusiness
- Course
- BreadcrumbList

# Robots / sitemap / redirects

Нужны:
- генерация sitemap.xml
- управляемый robots.txt
- 301 redirects
- canonical logic
- noindex support

# SEO-правила шаблонов

- один H1 на страницу
- корректная иерархия заголовков
- slug должны быть предсказуемыми и стабильными
- если меняется slug, подумай о redirect
- не делай мета-теги хардкодом, если сущность управляется через CMS

# Что проверять

1. Есть ли у страницы четкий search intent?
2. Не создаем ли мы дубль уже существующей страницы?
3. Есть ли у страницы уникальный title / description / h1?
4. Нужен ли canonical?
5. Нужно ли включать страницу в sitemap?
6. Нужна ли structured data?

# Результат

По SEO-задаче выдавай:
1. SEO model / fields
2. правила рендера в blade/layout
3. sitemap/robots/redirect strategy
4. city pages strategy
5. риски дублей и как они закрыты
