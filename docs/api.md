# Janna October Services — API reference (v1)

Base URL: `{APP_URL}/api` (local dev: `https://janna-services-backend.test/api`).
All responses are `application/json`. All resources are wrapped in a `data` envelope. Paginated resources also include Laravel's standard `links` and `meta` blocks.

Image fields always come as **full URLs** under keys ending with `_url`. URLs are built with `asset()`, so the scheme + host always match the host you used to call the API — i.e. requesting `https://janna-services-backend.test/api/...` produces image URLs on the same `https://janna-services-backend.test` host. There are no relative-only image paths. Only active rows are returned. Default ordering: `sort_order ASC, id DESC`.

> **Storage setup (one-time)**
> 1. `.env` → `APP_URL=https://janna-services-backend.test` (or whatever host you serve from).
> 2. Run `php artisan storage:link` so `public/storage` → `storage/app/public`. After that any file saved on the `public` disk is reachable at `{APP_URL}/storage/<path>`.
> 3. Uploaded files (covers, logos, media, banners) are stored under `storage/app/public/` and served via that symlink.

## Localization

Every endpoint supports Arabic and English. Pass the locale via:

| Source | Example |
|---|---|
| Query parameter (preferred) | `GET /api/categories?lang=ar` |
| HTTP header (mobile / CLI) | `Accept-Language: ar` |
| Default if neither given | `en` |

The same response keys are returned regardless of language — only the **values** change:

```bash
GET /api/categories?lang=en
# → { "data": [{ "id": 1, "name": "Maintenance", "description": "Plumbers..." }, ...] }

GET /api/categories?lang=ar
# → { "data": [{ "id": 1, "name": "الصيانة",      "description": "سباكون..." }, ...] }
```

Per-field fallback chain when a translation is missing:
```
{field}_{requested locale}  →  {field}_en  →  legacy column  →  null
```

Quick examples:
```bash
GET /api/categories?lang=ar
GET /api/providers?lang=ar&category=pharmacies&featured=1
GET /api/providers/casper-gambinis?lang=ar
GET /api/important-numbers?lang=ar
GET /api/banners?lang=ar
```

---

## 1. Categories

### GET `/api/categories`
List all active categories.

**Response 200**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Maintenance",
      "slug": "maintenance",
      "description": "Plumbers, electricians, AC repair and handymen.",
      "icon_url": null,
      "image_url": "https://janna-services-backend.test/storage/categories/images/abc.jpg",
      "sort_order": 1,
      "is_active": true,
      "providers_count": 4
    }
  ]
}
```

### GET `/api/categories/{slug}`
Single category by slug.

**Response 200**
```json
{
  "data": {
    "id": 3,
    "name": "Pharmacies",
    "slug": "pharmacies",
    "description": "24/7 and local pharmacies.",
    "icon_url": null,
    "image_url": null,
    "sort_order": 3,
    "is_active": true
  }
}
```

### GET `/api/categories/{slug}/providers`
Providers belonging to a category. Paginated (15/page).

**Response 200**
```json
{
  "data": [
    {
      "id": 3,
      "name": "19011 El-Ezaby Pharmacy",
      "slug": "19011-el-ezaby-pharmacy",
      "short_description": "24/7 pharmacy with delivery.",
      "phone": "19011",
      "whatsapp": "+201019011000",
      "address": "Near Janna gate 2",
      "working_hours": "Open 24 hours",
      "cover_image_url": null,
      "logo_url": null,
      "area_type": "near_compound",
      "is_featured": true,
      "category": { "id": 3, "name": "Pharmacies", "slug": "pharmacies" }
    }
  ],
  "links": { "first": "...", "last": "...", "prev": null, "next": null },
  "meta":  { "current_page": 1, "per_page": 15, "total": 2, "last_page": 1 }
}
```

---

## 2. Providers

### GET `/api/providers`
List all active providers (paginated, 15/page).

**Query parameters**

| Param | Example | Description |
|---|---|---|
| `category` | `pharmacies` | Filter by category slug |
| `featured` | `1` | Only featured providers |
| `area_type` | `inside_compound` or `near_compound` | Filter by location |
| `keyword` | `coffee` | Search in name + descriptions |

**Response 200** — same shape as the category-providers endpoint above.

### GET `/api/providers/{slug}`
Full provider details with grouped media.

**Response 200**
```json
{
  "data": {
    "id": 6,
    "name": "Janna Maintenance Team",
    "slug": "janna-maintenance-team",
    "description": "Compound-affiliated maintenance with same-day visits.",
    "short_description": "Plumbing, electricity, AC and handyman services.",
    "phone": "+201500001111",
    "whatsapp": "+201500001111",
    "address": "Compound office",
    "location_url": "https://maps.google.com/?q=...",
    "working_hours": "8:00 AM - 8:00 PM",
    "cover_image_url": "http://.../storage/providers/covers/xyz.jpg",
    "logo_url": null,
    "area_type": "inside_compound",
    "is_featured": true,
    "category": { "id": 1, "name": "Maintenance", "slug": "maintenance" },
    "gallery": [
      { "id": 10, "type": "gallery", "title": "Front view",   "image_url": "https://janna-services-backend.test/storage/providers/media/g1.jpg", "sort_order": 0 },
      { "id": 11, "type": "gallery", "title": "Workshop",     "image_url": "https://janna-services-backend.test/storage/providers/media/g2.jpg", "sort_order": 1 },
      { "id": 12, "type": "gallery", "title": "Service area", "image_url": "https://janna-services-backend.test/storage/providers/media/g3.jpg", "sort_order": 2 }
    ],
    "menu":     [],
    "products": [],
    "banners":  []
  }
}
```

### GET `/api/providers/{slug}/media`
All active media items for one provider. Returns a flat list.

**Response 200**
```json
{
  "data": [
    { "id": 10, "type": "gallery", "title": null, "image_url": "http://.../storage/providers/media/g1.jpg", "sort_order": 0 },
    { "id": 11, "type": "menu",    "title": "Breakfast", "image_url": "http://.../storage/providers/media/m1.jpg", "sort_order": 1 }
  ]
}
```

Possible `type` values: `gallery`, `menu`, `product`, `cover`, `banner`.

---

## 3. Search

### GET `/api/search?keyword=`
Search active providers by name, short_description, description or address.

Returns the same shape as `/api/providers`. If `keyword` is missing or empty, `data` is `[]`.

```json
{
  "data": [
    {
      "id": 3,
      "name": "19011 El-Ezaby Pharmacy",
      "slug": "19011-el-ezaby-pharmacy",
      "short_description": "24/7 pharmacy with delivery.",
      "phone": "19011",
      "whatsapp": "+201019011000",
      "address": "Near Janna gate 2",
      "working_hours": "Open 24 hours",
      "cover_image_url": null,
      "logo_url": null,
      "area_type": "near_compound",
      "is_featured": true,
      "category": { "id": 3, "name": "Pharmacies", "slug": "pharmacies" }
    }
  ],
  "links": { ... },
  "meta": { ... }
}
```

---

## 4. Important numbers

### GET `/api/important-numbers`
All active emergency/utility numbers (not paginated).

**Response 200**
```json
{
  "data": [
    { "id": 1, "title": "Police",                "phone": "122", "whatsapp": null,            "description": "Emergency police line.", "sort_order": 1 },
    { "id": 2, "title": "Ambulance",             "phone": "123", "whatsapp": null,            "description": "Medical emergencies.",   "sort_order": 2 },
    { "id": 5, "title": "Compound Security",     "phone": "+20238001000", "whatsapp": "+20238001000", "description": "Reachable 24/7 at any gate.", "sort_order": 5 }
  ]
}
```

---

## 5. Settings (app branding)

### GET `/api/settings`
Returns the single row of app branding maintained from the admin **App settings** page. Used by the Flutter splash and home app bar.

All strings respect `lang=ar` / `lang=en`. `logo_url` and `icon_url` are full URLs (or `null` when nothing has been uploaded).

**Response 200**
```json
{
  "data": {
    "app_name": "Janna October Services",
    "tagline": "Your community services directory",
    "logo_url": "https://janna-services-backend.test/storage/settings/logo.png",
    "icon_url": "https://janna-services-backend.test/storage/settings/icon.png",
    "primary_color": "#0F4C45",
    "secondary_color": "#F2A11F"
  }
}
```

Arabic example:

```bash
GET /api/settings?lang=ar
# → { "data": { "app_name": "خدمات جنّة أكتوبر", "tagline": "دليل خدمات مجتمعك", ... } }
```

Hex colors may be `null` if the admin hasn't set them. Treat them as optional theming hints — the Flutter side still has a hardcoded baseline.

---

## 6. Banners

### GET `/api/banners`
All active home banners (not paginated).

**Response 200**
```json
{
  "data": [
    {
      "id": 1,
      "title": "Welcome to Janna Services",
      "subtitle": "Your community directory",
      "image_url": "https://janna-services-backend.test/storage/banners/welcome.jpg",
      "link_url": null,
      "provider": null,
      "sort_order": 1
    },
    {
      "id": 2,
      "title": "Featured this week",
      "subtitle": "Top-rated providers around the compound",
      "image_url": "https://janna-services-backend.test/storage/banners/featured.jpg",
      "link_url": null,
      "provider": { "id": 6, "name": "Janna Maintenance Team", "slug": "janna-maintenance-team" },
      "sort_order": 2
    }
  ]
}
```

If `provider` is set, the Flutter app should navigate the user to the provider details screen using `provider.slug`. Otherwise use `link_url` as an external URL (or ignore if both are null).

---

## 7. Errors

| Status | When |
|---|---|
| `404` | Slug not found, or row exists but `is_active = false` |
| `422` | (admin-only mutating endpoints) validation failure — not applicable to the public API endpoints listed here |
| `500` | Server error — body will contain `{ "message": "..." }` |

---

## 8. Flutter integration tips

- Treat `*_url` as nullable — providers may have no cover/logo and categories may have no image.
- `area_type` is the simplest filter to surface as a chip in the providers list.
- For paginated endpoints, follow `meta.last_page` and `links.next`.
- The `provider_media` `type` field lets the app render separate tabs (Gallery, Menu, Products) without an extra request — `/providers/{slug}` already groups them.
- The `/search` endpoint paginates the same way as `/providers`, so a single shared list widget can render either.
