# Kerla — classifieds board (kerla.ru)

Regional classifieds site for Chechnya. Laravel + Blade + TailwindCSS + Alpine.js + MySQL.
Full product spec: `docs/SPEC.md` — read the relevant section before building a feature.

## Commands

- Install: `composer install && npm install && cp .env.example .env && php artisan key:generate`
- DB: `php artisan migrate --seed`
- Dev: `php artisan serve` + `npm run dev`
- Tests: `php artisan test` (run after every feature; keep them green)
- Code style: `./vendor/bin/pint`

## Stack & conventions

- Latest stable Laravel, PHP 8.3+, MySQL 8. Blade views, no SPA framework.
- TailwindCSS: light, simple, readable. No extra shadows, gradients or animations.
- Alpine.js only for small interactions (phone reveal, image preview, dropdowns).
- UI text in Russian via `lang/ru` files, never hard-coded in views.
- Thin controllers; logic in `app/Services`; authorization via Policies; validation via Form Requests.
- Every feature gets a feature test (Pest or PHPUnit).
- SEO-friendly slugs for listings and categories.

## Hard rules (legal: 152-ФЗ, 149-ФЗ) — never break these

1. **Auth is phone-only**: phone number + one-time code (SMS/flash-call). No email, no passwords, no Google/Apple/VK/Facebook login.
2. **No chat, no messaging, no "message the seller" form.** Contact is only via "Показать телефон" (AJAX, rate-limited, number never in the HTML source).
3. **No payments, no subscriptions, no ad banners** — do not add payment packages or ad slots.
4. **Minimal user data**: phone, display name, city. Do not add fields such as email, surname, birth date, address, avatar or gender.
5. **Consents**: Terms, PD-processing consent and 18+ confirmation are separate, unticked checkboxes at sign-up. PD-distribution consent (name/phone shown publicly) is asked separately before the first listing is published. Every consent is logged in `consents` (type, document version, IP, user agent, timestamps).
6. **Phone shown publicly only if** the user has an active distribution consent (`users.show_phone`). Withdrawal hides it immediately.
7. **Strip EXIF** from all uploaded images; convert to WebP; max 10 per listing.
8. **No third-party foreign services**: no Google Analytics, Google Fonts CDN, reCAPTCHA, Facebook Pixel or foreign CDNs. Use Yandex Metrica (loaded only after cookie consent), Yandex SmartCaptcha and self-hosted fonts.
9. **Deletion**: account deletion hides listings at once and hard-deletes personal data within 30 days (scheduled command). OTP records purged after 24 h. Expired listings deleted 30 days after expiry.
10. No reviews/ratings, no Jobs category, no AI/chatbot features. If a task seems to need any of the above, stop and ask.

## SMS in development

- `app/Contracts/SmsSender` interface with drivers: `log` (default locally — writes the code to `storage/logs`) and a real Russian provider (e.g. SMS.ru) selected by `SMS_DRIVER` in `.env`.
- Never commit real API keys; `.env` is git-ignored.

## Build order (one milestone at a time, tests passing before the next)

1. Phone auth (OTP, rate limits, captcha stub) + consents log
2. Categories, cities (seeders), listings CRUD, images, statuses, auto-expiry
3. Search & filters, favorites
4. Phone reveal + distribution consent flow
5. Reports + admin panel (moderation, users, categories, cities, stop-words, admin action log)
6. Legal/static pages, footer with operator details, cookie banner
7. Scheduled cleanup commands (deletion, OTP purge, expiry)

## Data model

Tables: users, phone_verifications, consents, listings, listing_images, categories, cities, favorites, reports, admin_logs.
Exact columns: `docs/SPEC.md` → "Database Schema".