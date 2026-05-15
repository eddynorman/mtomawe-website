# Mtomawe Zoo & Gardens — Website

Laravel 13 application for a public marketing site plus a password-protected **admin CMS**. The public experience uses **Bootstrap 5**, **Font Awesome 6**, and light scroll-reveal motion; the admin area uses the same stack with **Quill** rich-text editors for HTML content. MySQL is the expected production database (SQLite works for local demos and automated tests).

## Features

- **Public site**
  - Home: configurable top strip (name, address, map link, phone, email), navigation, hero **carousel**, About / Mission / Vision from the database, footer with social icons and editable legal/tagline copy.
  - **Gallery** with category tabs and responsive image grids.
  - **News** (posts) with pagination and detail pages addressed by slug.
  - **Contact** form (name, phone, email, message) stored for staff review; rate limited.
- **Admin (`/admin`)**
  - Look & feel: colours, font stacks, base font size, business contact fields, Google Maps URL.
  - Page text: rich HTML blocks (About, Mission, Vision, footer snippets).
  - Carousel, gallery categories & images (uploads go to the `public` disk under `storage/app/public`).
  - Posts with optional publish datetime and draft/live flag.
  - Contact inbox with read/unread state and delete.
  - Social links (Font Awesome classes + URLs).
- **Seed data** (`ZooSiteSeeder`) provisions an admin user, theme defaults, demo copy, **local SVG assets** under `public/images/seed/`, sample gallery/posts, and placeholder social URLs (replace with real profiles).

## Requirements

- PHP 8.3+ (project targets 8.4 per tooling)
- Composer 2
- Node 20+ (for Vite 8)
- MySQL 8+ (recommended) or SQLite for development/tests

## Quick start (local)

```bash
cd mtomawe_website
cp .env.example .env
php artisan key:generate
```

Configure `.env`:

- Set `DB_*` for MySQL (default database name `mtomawe_website` is suggested in `.env.example`), **or** use SQLite by setting `DB_CONNECTION=sqlite` and `DB_DATABASE=/absolute/path/to/database.sqlite`.
- Optionally set `SEED_ADMIN_PASSWORD` (used only by `ZooSiteSeeder`; defaults to `password`).

Then:

```bash
composer install
php artisan migrate --seed
php artisan storage:link   # required so uploaded carousel/gallery files are web-accessible
npm install && npm run build   # or `npm run dev` during UI work
php artisan serve
```

Visit `http://127.0.0.1:8000` for the public site and `http://127.0.0.1:8000/login` for staff access.

### Default seeded admin

| Field    | Value                 |
|----------|-----------------------|
| Email    | `admin@mtomawe-zoo.test` |
| Password | value of `SEED_ADMIN_PASSWORD` from `.env`, or `password` if unset |

Change this password immediately on any shared or production environment.

## Development scripts

- `composer run dev` — runs `php artisan serve`, queue worker, logs, and Vite together (see `composer.json`).
- `npm run dev` / `npm run build` — frontend bundles (`resources/js/app.js` for the public site + auth, `resources/js/admin.js` for the CMS with Quill).
- `php artisan test --compact` — PHPUnit (uses in-memory SQLite per `phpunit.xml`).

## Project structure (high level)

| Area | Path |
|------|------|
| Public controllers | `app/Http/Controllers/*.php` |
| Admin controllers | `app/Http/Controllers/Admin/*.php` |
| Models | `app/Models/*.php` |
| Site-wide key/value settings | `site_settings` table + `App\Services\SiteSettingsService` |
| CMS HTML fragments | `content_blocks` + `App\Support\ContentSlugs` |
| Public layout & pages | `resources/views/layouts/public.blade.php`, `resources/views/public/*` |
| Admin layout & pages | `resources/views/layouts/admin.blade.php`, `resources/views/admin/*` |
| Routes | `routes/web.php`, `routes/auth.php` |
| Seed images (repo) | `public/images/seed/*.svg` |

## Deployment notes

1. Set `APP_ENV=production`, `APP_DEBUG=false`, strong `APP_KEY`, and mail credentials as needed.
2. Run `php artisan migrate --force` (and `--seed` only if you intentionally want demo data on first boot).
3. Run `npm ci && npm run build` on the server or in your CI image; deploy `public/build`.
4. Ensure `php artisan storage:link` exists on the server and the `storage/` tree is writable.
5. Point your web server document root to `public/`.
6. Replace placeholder **Google Maps** URL and **social** URLs in the admin settings after go-live.
7. Consider disabling open `register` routes in production (remove from `routes/auth.php` or gate behind env) so only invited accounts exist.

## Instagram / photography

Official venue photography and branding should come from the zoo’s own media or licensed assets. The seed SVGs are **generic illustrations** so the repo ships runnable visuals; swap them for real photos through the admin carousel and gallery screens.

## Licence

MIT (same as Laravel skeleton). Add your client-specific licence terms as required.
