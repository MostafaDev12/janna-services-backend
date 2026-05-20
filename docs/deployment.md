# Deploying to a subdomain (shared hosting)

Target: `https://project.cangrow.shop/` should serve the app **without** `/public/` in the URL.

## Option A — set document root to `public/` (recommended)

If your control panel (cPanel, DirectAdmin, Plesk, …) lets you choose the document root for a subdomain:

1. Upload the whole Laravel project (everything in this repo) to a folder **above** the public web area, e.g. `/home/<user>/apps/janna-services/`.
2. Open the subdomain settings and set **Document Root** to `/home/<user>/apps/janna-services/public`.
3. Done — Apache/Nginx serves `public/index.php` directly. No URL rewriting hop, and the rest of the project (`app/`, `config/`, `.env`) is unreachable over HTTP.

If you go with this option, **delete the root `.htaccess`** that ships with this repo — it's only needed for Option B.

## Option B — keep document root at project root, use the root `.htaccess`

When the host gives you a single folder (the document root) and you can't change it, upload the project there and let the root `.htaccess` (already in this repo) rewrite `/` → `public/` internally:

```
project root  (document root)
├── .htaccess          ← rewrites everything into public/
├── app/
├── bootstrap/
├── config/
├── public/            ← real entry point
│   ├── .htaccess
│   ├── index.php
│   └── storage        ← symlink to ../storage/app/public
├── storage/
└── …
```

The root `.htaccess` also blocks direct HTTP access to `.env`, `composer.json`, `storage/`, `app/`, etc.

### Required environment changes after upload

Edit `.env` on the server:

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://project.cangrow.shop
```

> `APP_URL` matters because `Storage::url()` and any cached URL falls back to it. With it set correctly, `asset('storage/foo.png')` returns `https://project.cangrow.shop/storage/foo.png` whether or not a real request is in flight.

Then on the server:

```bash
# 1. Install deps without dev tools
composer install --no-dev --optimize-autoloader

# 2. Generate the symlink so /storage/<path> resolves to storage/app/public/<path>
php artisan storage:link

# 3. Re-cache config/routes/views with the new APP_URL
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Permissions — storage/ and bootstrap/cache/ must be writable by the web user
chmod -R 775 storage bootstrap/cache
# If your host wants a specific owner:
# chown -R <user>:<webgroup> storage bootstrap/cache
```

### Smoke test

```bash
curl -I https://project.cangrow.shop/
# → HTTP/1.1 200 OK

curl -s "https://project.cangrow.shop/api/settings?lang=en"
# → {"data":{"app_name":"...","logo_url":"https://project.cangrow.shop/storage/settings/...","..."}}

# A storage file should load directly:
curl -I https://project.cangrow.shop/storage/settings/<your-logo>.png
# → HTTP/1.1 200 OK   Content-Type: image/png
```

If `/storage/...` returns 404, run `php artisan storage:link` again — on shared hosting the symlink sometimes gets stripped during upload.

If you see the Laravel error page instead of the app:
- The web user can't write to `storage/` / `bootstrap/cache/` → fix permissions.
- `APP_KEY` is empty → run `php artisan key:generate --force`.
- Old caches → `php artisan optimize:clear`, then re-run the `:cache` commands.

## Flutter app pointing at the deployed backend

```bash
flutter run -d windows \
  --dart-define="API_BASE_URL=https://project.cangrow.shop/api"
```

Or for a release build:

```bash
flutter build apk --release \
  --dart-define=API_BASE_URL=https://project.cangrow.shop/api
```

The HTTPS self-signed-cert override in `lib/main.dart` is **debug only** — production builds validate real certs normally, which is fine because `cangrow.shop` will have a real (Let's Encrypt / panel-issued) certificate.
