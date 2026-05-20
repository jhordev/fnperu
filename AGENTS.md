# AGENTS.md

## Architecture

Three independent PHP apps share a common codebase:

```
fnperu-main/
├── public_html/          → DocumentRoot (Apache). Entry: index.php
│   └── dashboard/        → Admin panel entry: dashboard/index.php
├── web_fnperu/           → Public site (namespace FNPERU), MVC
├── admin_fnperu/         → Admin panel (namespace ADMINFN), MVC
├── cursos_moodle/        → Moodle integration module
├── require_funcions.php  → Shared helper functions (redirect, json, purify, etc.)
└── db_backups/           → SQL backups for both DBs
```

Moodle (separate install): `/var/www/html/campus/`, data at `/var/moodledata/`

## Config files

- `web_fnperu/Config/.env` — public site config (base_url, DB for fn_peru + campus)
- `admin_fnperu/Config/.env` — admin panel config
- `cursos_moodle/Config/Config.php` — Moodle integration constants

`HOST_CURL` in cursos_moodle must always be `localhost` (server-to-server API calls). Change `BASE_URL` and `CAMPUS_URL` for production.

## Database

Two MySQL databases (both on `localhost`, user `fnperu`):
- `u175908272_fn_peru` — site content (urbanizaciones, cursos)
- `u175908272_campus` — Moodle (tables prefixed `mdl_`)

## Routes

URL routing is handled by custom MVC in each app's `Core/Routes.php`. Routes are defined as arrays with `Route`, `Controller`, `Method`, `Parameters`, and optional `redirect_here`. Routes map to `Controllers/` + `Views/` in each app.

## Admin panel credentials

Hardcoded in `admin_fnperu/Controllers/Login.php:54`:
- User: `admin`, Pass: `2022.FNperu-admin`

## Shared helpers

`require_funcions.php` at project root provides: `redirect()`, `json()`, `purify()`, `isAlphaNumeric()`, `isAlphaDash()`, `nameForFiles()`, `getExtension()`, `mb_ucfirst()`.

## Important constraints

- `development = false` in both `.env` files before production deploy.
- Increment `media_version` in both apps to bust asset caches.
- `dataroot` for Moodle must be outside DocumentRoot.
- chmod 755 on `admin_fnperu/Writable/` and `public_html/assets/admin/` for uploads.
- After domain change: update Moodle wwwroot in DB and run `php campus/admin/cli/purge_caches.php`.

## CSS Structure (web principal)

CSS assets live in `public_html/assets/web/cfn/`. The old flat files (`templateWeb.css`, `generalStyles.css`, per-page CSS in `cursos/`, `nosotros/`, `urbanization/`) have been reorganized into a modular structure loaded by a single `template.css`:

```
public_html/assets/web/cfn/
├── base/
│   ├── reset.css        → normalize + CSS vars + body base
│   ├── typography.css   → font-size .fs-* y font-weight .fw-* utility classes
│   ├── layout.css       → .contaner_general, .contaner_edit
│   └── utilities.css    → z-index, preloader, spinner, datatable, modal, page-heading
├── components/
│   ├── header.css       → header + nav menu
│   ├── footer.css       → footer social icons
│   ├── cards.css        → .product-item card layout
│   ├── buttons.css      → .button, .btn_cursos, .btn_talleres, etc.
│   ├── badges.css       → .matriculas_abiertas, .div_for_precio, etc.
│   └── detail-shared.css → shared layout for curso/urbanizacion detail pages + carousel
├── pages/
│   ├── inicio.css       → inicio page (cards grid, antes_footer, banner)
│   ├── nuestros-cursos.css → filterable cursos list
│   ├── ver-curso.css    → curso detail page overrides
│   ├── nosotros.css     → nosotros page
│   ├── contactenos.css  → contactenos page + form
│   ├── urbanization.css → urbanization detail overrides
│   └── error-404.css   → 404 page
└── template.css         → @imports all base + components + pages
```

**Loading**: `web_fnperu/Views/WebTemplate/header.php` loads a single `<link>` to `template.css` plus one optional per-page CSS via `$page_css`. Per-page CSS paths are relative to `web/cfn/pages/`.

**Controller routing**: `$data['page_css']` in controllers maps to filenames in `pages/`:
- `web_fnperu/Controllers/Cursos.php` → `'pages/inicio'` / `'pages/ver-curso'`
- `web_fnperu/Controllers/Nosotros.php` → `'pages/nosotros'` / `'pages/contactenos'`
- `web_fnperu/Controllers/Urbanizaciones.php` → `'pages/urbanization'`