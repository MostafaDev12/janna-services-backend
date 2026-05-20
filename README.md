# Janna October Services — Backend

A Laravel 10 MVP for the **Janna October compound services directory**.

This repo contains:

- A Blade-based **admin dashboard** to manage categories, providers, media, banners and important numbers.
- A Blade-based **public website** that lists categories and providers with full details.
- A REST **API** consumed by the Flutter mobile app (under `/api`).

> Stack: Laravel 10 · PHP 8.1+ · MySQL · Blade · Bootstrap 5 (via CDN). No React, Vue, Inertia, or npm build steps.

---

## 1. Setup

### Requirements
- PHP **8.1+**
- Composer
- MySQL 5.7+ / MariaDB 10.3+
- Laragon, XAMPP, Valet or `php artisan serve`

### Install

```bash
git clone <repo-url> janna-services-backend
cd janna-services-backend
composer install
cp .env.example .env
php artisan key:generate
```

### `.env` — minimum settings

```env
APP_NAME="Janna October Services"
APP_URL=http://janna-services-backend.test  # or http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=janna_services
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public
```

Create the database in MySQL:

```sql
CREATE DATABASE janna_services CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Migrate, seed, storage

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

`storage:link` is **required** so that uploaded images become accessible at `http://your-app/storage/...`.

### Run

```bash
php artisan serve
# → http://127.0.0.1:8000
```

On Laragon, the app is also served automatically at `http://janna-services-backend.test`.

---

## 2. Admin login (seeded)

```
URL:      /admin   (or /login)
Email:    admin@janna.local
Password: password
```

Change the password from the seeder (`database/seeders/AdminSeeder.php`) before deploying.

---

## 3. Project layout

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/       — Dashboard, Category, ServiceProvider, ProviderMedia, ImportantNumber, Banner
│   │   ├── Api/         — Category, Provider, Search, ImportantNumber, Banner
│   │   ├── Auth/        — LoginController
│   │   └── Web/         — Home, Category, Provider, Search, ImportantNumber (public site)
│   ├── Requests/Admin/  — Form requests (validation)
│   └── Resources/       — API JSON resources
└── Models/              — Category, ServiceProvider, ProviderMedia, ImportantNumber, Banner

database/
├── migrations/          — 5 MVP tables + default Laravel ones
└── seeders/             — Admin, Category, ServiceProvider, ImportantNumber, Banner

resources/views/
├── admin/               — admin Blade views (Bootstrap 5)
├── auth/login.blade.php
└── web/                 — public site Blade views

routes/
├── web.php              — public site + admin (auth-protected)
└── api.php              — public REST endpoints
```

---

## 4. Database schema (MVP)

| Table | Purpose |
|---|---|
| `users` | Admin accounts for the dashboard |
| `categories` | Service categories (name, slug, icon, image, sort_order, is_active) |
| `service_providers` | Providers belonging to a category. Fields: name, slug, descriptions, phone, whatsapp, address, location_url, working_hours, cover_image, logo, `area_type` (`inside_compound` \| `near_compound`), `is_featured`, `is_active`, sort_order |
| `provider_media` | Provider images. `type` ∈ `gallery, menu, product, cover, banner`. Each row stores one image with title and sort. |
| `important_numbers` | Emergency / utility numbers shown on the public site and via API |
| `banners` | Homepage carousel banners; can optionally link to a provider or external URL |

Slugs are auto-generated from `name` if left empty and remain unique.

---

## 5. Admin dashboard pages

Available under `/admin`:

| Page | Path |
|---|---|
| Overview | `/admin` |
| Categories | `/admin/categories` (CRUD) |
| Service Providers | `/admin/providers` (CRUD + filter) |
| Provider Media | `/admin/providers/{id}/media` (multi-upload, edit, delete, toggle active) |
| Important Numbers | `/admin/important-numbers` (CRUD) |
| Banners | `/admin/banners` (CRUD) |

Provider media supports:
- multiple-file upload at once
- per-image `type` (gallery / menu / product / cover / banner)
- per-image title, sort order, active toggle
- inline previews and replace-image

All image uploads are validated (`jpg, jpeg, png, webp`, max 4 MB) and stored under `storage/app/public/...`.

---

## 6. Public website pages

| Page | Path |
|---|---|
| Home | `/` (categories, featured providers, banner carousel, important numbers shortcut) |
| Categories list | `/categories` |
| Category detail | `/categories/{slug}` |
| Providers list | `/providers` (filters: keyword, category, area_type, featured) |
| Provider details | `/providers/{slug}` (cover, phone, WhatsApp, location, working hours, gallery, menu, related) |
| Search | `/search?keyword=...` |
| Important numbers | `/important-numbers` |

---

## 7. API endpoints (for Flutter)

Base URL: `{APP_URL}/api`

| Method | Endpoint | Description |
|---|---|---|
| GET | `/categories` | All active categories |
| GET | `/categories/{slug}` | One category |
| GET | `/categories/{slug}/providers` | Providers of a category (paginated) |
| GET | `/providers` | All active providers (paginated). Filters: `category={slug}`, `featured=1`, `area_type=inside_compound\|near_compound`, `keyword=...` |
| GET | `/providers/{slug}` | Provider details with grouped media (gallery, menu, products, banners) |
| GET | `/providers/{slug}/media` | Active media of a provider |
| GET | `/search?keyword=...` | Search providers by name, description or address |
| GET | `/important-numbers` | Public emergency / utility numbers |
| GET | `/banners` | Active home banners |

Rules applied to all endpoints:
- Returns JSON wrapped in `{ "data": ... }`.
- Image fields are returned as **full URLs** (`*_url`), never raw paths.
- Only **active** rows are returned.
- Default ordering: `sort_order ASC`, then `id DESC`.
- Paginated endpoints include the standard Laravel `links` + `meta` blocks.

Full sample responses are in [docs/api.md](docs/api.md).

---

## 8. Useful commands

```bash
# fresh DB
php artisan migrate:fresh --seed

# run a single seeder
php artisan db:seed --class=CategorySeeder

# clear caches
php artisan optimize:clear

# view all routes
php artisan route:list
```

---

## 9. Bilingual support (Arabic + English)

All directory data — categories, providers, provider media, important numbers, banners — supports both Arabic and English. The API keeps the **same JSON keys** as before (`name`, `description`, `title`, `subtitle`, `short_description`, `working_hours`, `address`); only the **values** change based on the resolved locale.

### How the locale is chosen

The `SetLocale` middleware applies on every web and API request, in this order:
1. `?lang=ar` / `?lang=en` query parameter
2. Session-stored value (browser navigation)
3. `Accept-Language` request header (e.g. `ar`, `en-US`)
4. Default: `en`

### API examples

```bash
GET /api/categories?lang=ar
GET /api/categories?lang=en
GET /api/providers?lang=ar
GET /api/providers/{slug}?lang=ar
GET /api/important-numbers?lang=ar
GET /api/banners?lang=ar

# Or with header (no query param needed):
curl -H "Accept-Language: ar" http://.../api/categories
```

### Fallback chain

For every localized field the model trait `HasLocalizedFields::localized($field)` walks:

```
{field}_{currentLocale}  →  {field}_en  →  {field}  (legacy column)  →  null
```

So a row with **only English** still renders correctly in Arabic mode (it falls back to English), and pre-bilingual rows from the original migration still display via the legacy column.

### Public website

The Blade layout sets `<html lang="ar" dir="rtl">` automatically under Arabic, loads `bootstrap.rtl.min.css`, and shows a one-tap **language switcher** in the navbar (`?lang=ar` / `?lang=en`). The choice is persisted in the session so the user only clicks once.

### Admin dashboard

Every form now has paired English + Arabic inputs (Arabic inputs render `dir="rtl"`). The legacy single-language columns (`name`, `title`, etc.) are kept and automatically mirrored from the English field on save — old code paths and the schema's NOT NULL constraints keep working.

---

## 10. Out of scope for v1

The MVP intentionally **does not** include: booking, payments, service-request workflow, chat, or resident registration. Favorites are kept on-device in the Flutter app for v1.
