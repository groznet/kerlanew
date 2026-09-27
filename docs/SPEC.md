# 🌐 Web Project Overview

## 🏷️ Project Name

> Kerla – Classifieds Listing Platform

## 🧭 Project Summary

> EN: Kerla is a regional classifieds website for Chechnya and nearby North Caucasus regions. Individuals and small businesses can post, find and manage listings (vehicles, real estate, electronics, home & garden, services, etc.). The platform is deliberately minimal: it only connects buyers and sellers. Kerla does not take part in deals, does not process payments, does not host private messaging and collects the minimum personal data required to run the service.
>
> RU: Kerla — региональная доска объявлений для Чеченской Республики и соседних регионов Северного Кавказа. Частные лица и малый бизнес могут размещать, искать и управлять объявлениями (транспорт, недвижимость, электроника, дом и сад, услуги и т.д.). Платформа намеренно минималистична: она только сводит покупателя и продавца. Kerla не участвует в сделках, не принимает платежи, не содержит личной переписки и собирает минимально необходимый объём персональных данных.

**Type:** Classifieds / Listings
**Status:** In Development
**Main Language:** Russian
**Guiding principle:** *Minimum data, minimum features, minimum legal exposure.* Every feature must pass the question: "Does this make me an operator of something new (payments, messaging, advertising, sensitive data)?" If yes → not in MVP.

---

# ⚖️ Legal Framework & Operator

## 👤 Site owner / PD operator (оператор персональных данных)

- **Operator:** ИП Тимирбулатов Керим Русланович
- **ОГРНИП / ИНН:** 323200000043744 / 201209591056
- **Email for legally significant messages:** info@kerla.ru
- These details are shown in the site footer and in the Privacy Policy (152-ФЗ ст. 18.1 ч. 2; 149-ФЗ ст. 10.7 ч. 1 п. 5 — mandatory only above 100k daily users, but shown from day one).

## 📜 Applicable laws (what each one means for Kerla)

| Law | What applies to Kerla | How the design handles it |
|---|---|---|
| **152-ФЗ «О персональных данных»** | Kerla is a PD operator (phone, name, IP, cookies). | Minimal data set, RKN notification, published policy, separate consents, data localized in Russia, deletion on request. |
| **149-ФЗ ст. 8 ч. 10** | Authorization of users in Russia must be done by mobile phone number (or Госуслуги / Russian ID system). | Sign-up and login **only** via phone number + SMS/flash-call code. No email/password or foreign social logins. |
| **149-ФЗ ст. 10.1 (ОРИ)** | A service for receiving/transmitting users' electronic messages = «организатор распространения информации»: RKN registry, storing message metadata 3 yrs and message content up to 6 months, handing data to security agencies, SORM equipment. | **No internal chat or messaging.** Contact happens off-platform by phone. |
| **149-ФЗ ст. 10.7** | Classifieds service with **>100,000 daily users in RF** gets registered by RKN and gets extra duties. | Not applicable at launch. Show owner name + legal email now; revisit if traffic ever approaches the threshold. |
| **149-ФЗ ст. 15.x** | RKN / rights holders may demand removal of prohibited content. | Report button + admin removal tools; respond to notices at info@kerla.ru within 24 h. |
| **ГК РФ ст. 152, 152.1, 152.2** | Honor & reputation; a person's image may be published only with their consent; privacy. | No user reviews/ratings, no avatars, rule: no people in listing photos. |
| **ГК РФ ст. 437–438** | Terms of Service works as a public offer, accepted by registering. | `/terms` accepted with a checkbox at sign-up. |
| **38-ФЗ «О рекламе»** | Selling banner/featured placements = advertising distribution → ad labelling, ERID, reporting to ЕРИР via ОРД. Ban on advertising on resources of banned/extremist organizations (ст. 5 ч. 10.7). | **No paid advertising in MVP.** Kerla is not promoted via Instagram/Facebook. |
| **54-ФЗ «О ККТ»** | Accepting online payments requires an online cash register and electronic receipts. | **No payments in MVP.** |

---

# 👥 Business Information

## 🧩 Brand Details

- **Company Name:** _Kerla_
- **Industry/Niche:** _Classifieds / Online listings board_
- **Main Product or Service:** _Free user-submitted listings for goods, real estate and services_
- **Location(s):** _Chechnya (primary), later other North Caucasus regions_
- **Target Audience:** _Adults (18+) and small businesses buying, selling or offering services locally_

## 📈 Business Goals

> Kerla aims to become the go-to local classifieds board in Chechnya — simple and fast to post, find and respond to listings.

- Build a trusted, clean regional listings board
- Drive daily listing activity and returning users
- Grow traffic via SEO and social sharing
- Expand to other North Caucasus regions later

## 💰 Monetization Strategy

**MVP: free platform, no monetization.** All paid features are deferred because each one brings a new legal regime:

| Deferred feature | Why deferred | What is required if added later |
|---|---|---|
| Featured listings / upsells (urgent, highlight, homepage) | Payments → 54-ФЗ | Payment provider with cloud cash register (e.g. Tochka / ЮKassa), electronic receipts, offer for paid services |
| Premium accounts / subscriptions | Payments + recurring billing → 54-ФЗ, consumer protection | Same as above + subscription terms, refunds |
| Banner advertising | 38-ФЗ ad labelling (ERID, «Реклама», advertiser info), reporting to ОРД/ЕРИР | ОРД contract, marking every ad |
| Lead generation | Transfers user data to third parties → 152-ФЗ transfer consent | Separate consent, data processing agreements |

## 🔍 SEO Strategy

- **Primary Keywords:** объявления Грозный, продать авто Чечня, недвижимость Грозный, бесплатные объявления, частные объявления Керла
- **Search Intent:** Transactional / Navigational
- **Target Regions:** Chechnya (Grozny, Argun, Gudermes, Shali, Urus-Martan), later Ingushetia, Dagestan, etc.
- **Notes:** Russian-language content; SEO-friendly listing URLs; sitemap.xml; seller phone numbers are never rendered into page HTML (not indexed, not scrapable).
- **Analytics:** Yandex Metrica only (Russian service, no cross-border transfer). No Google Analytics / Facebook Pixel.

## 📱 Social Media / Marketing Channels

- VK: vk.com/kerla
- Telegram: _optional_
- YouTube: @kerla
- ❌ Instagram / Facebook are not used for promoting Kerla (Meta is designated extremist in Russia; advertising on its resources is banned by 38-ФЗ ст. 5 ч. 10.7, and showing its logos on the site is a risk).

---

📬 **Domain & Communication**

Domain: kerla.ru
Main Contact / Legal Email: info@kerla.ru

---

# ✅ MVP Feature Scope

## 1. 📱 Sign up / Login by phone number

- One flow for both: enter phone → receive code → confirm → done.
- Code delivery: SMS or flash-call via a **Russian** provider (e.g. SMS.ru, SMSC, SMS Aero).
- Code: 4–6 digits, valid 5 min, max 5 attempts, resend after 60 s, rate limit per phone and per IP, Yandex SmartCaptcha before sending.
- No passwords, no email, no foreign OAuth (Google/Apple/VK ID are not in the 149-ФЗ ст. 8 ч. 10 list).
- At first sign-up, the user must:
  - [ ] accept **Terms of Service** (checkbox),
  - [ ] give **consent to personal data processing** (separate checkbox, links to a separate consent page — 152-ФЗ ст. 9 ч. 1 requires consent to be separate from other documents),
  - [ ] confirm they are **18 or older**.
- Checkboxes are never pre-ticked. Every consent is logged (see `consents` table).

## 2. 👤 Profile management

Only these fields:

| Field | Required | Public |
|---|---|---|
| Phone number | ✅ (login) | Only if seller allows (see §4) |
| Display name (can be a first name or nickname) | ✅ | ✅ |
| City / district (from list) | ✅ | ✅ |

- **Not collected:** surname, patronymic, email, date of birth, address, passport, gender, avatar/photo.
- Users can: edit name and city, change phone number (with re-verification of the new number), see their active consents, withdraw the distribution consent, **delete their account**.
- **Account deletion:** immediately hides all listings; personal data is destroyed within 30 days (152-ФЗ ст. 21 ч. 5); only an anonymized record may remain.

## 3. 📝 Listings & management

- Create / edit / deactivate / delete / renew listings.
- Fields: category, title, description, price (optional, "договорная"), city/district, condition (for goods), up to 10 photos.
- **Photos:** resized and converted to WebP; **EXIF metadata stripped** (removes GPS location and device info).
- Listing rules shown next to the form: no people in photos, no personal data of third parties, no prohibited items.
- **Auto-expiry:** listings expire after 30 days (renewable in one click); expired listings are deleted after another 30 days.
- Statuses: `draft`, `active`, `expired`, `blocked`, `deleted`.
- Posting limits per user per day (anti-spam).
- **Favorites** ("Избранное") for logged-in users — stored only as user_id ↔ listing_id.

### Categories (MVP)

- Транспорт (авто, мото, запчасти)
- Недвижимость (продажа, аренда)
- Электроника
- Дом и сад
- Личные вещи
- Хобби и отдых
- Животные
- Услуги

**Not in MVP:**
- **Вакансии / Резюме** — job ads carry their own rules (ban on discriminatory requirements in vacancies, with fines also for the site publishing them) and CVs are personal-data heavy. Add later with a strict form and moderation.
- **Prohibited items** (never allowed, listed in `/rules`): medicines and prescription drugs, alcohol, tobacco/vapes, weapons and ammunition, drugs, counterfeit goods, documents, databases/personal data, financial services, "earn online" schemes, adult content, anything prohibited by law.

## 4. 📞 Contact the seller (instead of chat)

- On a listing page: **"Показать телефон"** button → the number is loaded via AJAX only after the click (not in the HTML, rate-limited, SmartCaptcha on abuse).
- Optional quick links using the same number: **"Позвонить"** (`tel:`), **"WhatsApp"**, **"Telegram"** — no extra data is collected.
- Showing the phone and name to the public = **distribution of personal data** → requires a **separate consent for distribution** (152-ФЗ ст. 10.1), asked when the user publishes their first listing:
  - the user chooses which data may be shown (name, phone) — per ст. 10.1 ч. 1;
  - consent can be withdrawn any time in the profile → phone hidden immediately (ст. 10.1 ч. 12–13);
  - without it the listing can be saved but not published with contacts; the user is told this plainly.
- ❌ **No internal chat / messaging** — avoids ОРИ status (149-ФЗ ст. 10.1): no RKN registration as ОРИ, no multi-year message storage, no data handover duties.

## 5. 🔎 Search & filters

- Full-text search by title/description (MySQL FULLTEXT; Meilisearch later if needed).
- Filters: category, city/district, price range, condition, "only with photo".
- Sorting: newest, cheapest, most expensive.
- Search queries are **not** stored per user (no search history).

## 6. 🚩 Reports & moderation

- **"Пожаловаться"** button on every listing: reasons (prohibited item, fraud, wrong category, someone else's photos/data, offensive content, other). Anonymous users can report too (captcha).
- Post-moderation: listings go live immediately; automatic stop-word filter holds suspicious listings for review.
- Admin can block/delete a listing, block a user, and see the report history.
- Target: react to reports and official notices within 24 h.

## 7. 🛠️ Admin panel

- Dashboard: counts of users, listings, open reports.
- Manage listings (block/unblock/delete), users (block/delete), categories, cities, static pages, stop-words.
- Handle data-subject requests (access, correction, deletion) — 152-ФЗ ст. 14, 20, 21.
- Admin access protected by a separate strong password + 2FA and IP allowlist if possible; every admin action logged.

## 8. 🍪 Cookies & analytics

- Only necessary cookies (session, CSRF) + Yandex Metrica.
- Cookie banner with a link to the Privacy Policy; Metrica loads only after the user accepts.
- Fonts self-hosted (no Google Fonts CDN), no Google reCAPTCHA (use Yandex SmartCaptcha).

---

# 🔐 Personal Data Compliance Checklist (152-ФЗ)

**Before launch:**
- [ ] Submit **notification to Roskomnadzor** about PD processing (ст. 22) via pd.rkn.gov.ru — before collecting any real user data.
- [ ] Publish **Политика обработки персональных данных** at `/privacy` (ст. 18.1 ч. 2): operator, purposes, data list, legal basis, retention periods, storage location (Russia), user rights, how to send requests.
- [ ] Publish **Согласие на обработку ПДн** as a separate page `/consent` (ст. 9).
- [ ] Publish **Согласие на распространение ПДн** as a separate page `/consent-public` (ст. 10.1).
- [ ] Publish **Пользовательское соглашение** `/terms` and **Правила размещения объявлений** `/rules`.
- [ ] Internal document (for yourself as ИП): list of security measures and who has access (ст. 18.1, 19).

**Data localization (ст. 18 ч. 5):**
- [ ] VPS, database, backups and uploaded photos **physically in Russia** (Timeweb — choose a Russian data center, not their foreign locations).
- [ ] SMS provider, captcha, analytics, email — Russian services only.
- [ ] No cross-border transfer of PD (no Google/Meta scripts).

**Security (ст. 19):**
- [ ] HTTPS everywhere (HSTS).
- [ ] Laravel encryption for sensitive columns if needed; DB not exposed to the internet.
- [ ] Encrypted backups, stored in Russia.
- [ ] Rate limits on OTP, phone reveal, listing creation, reports.
- [ ] Server logs (IP) kept max 90 days.
- [ ] Incident plan: a PD leak must be reported to RKN within 24 h and results of investigation within 72 h (ст. 21 ч. 3.1).

**Retention:**

| Data | Kept for |
|---|---|
| OTP codes | Deleted after 24 h |
| Active account data | While the account exists |
| Deleted account data | Destroyed within 30 days |
| Expired listings | Deleted 30 days after expiry |
| Reports | 1 year, then deleted |
| Consent log | For the life of the account + 3 years (proof of consent, ст. 9 ч. 3) |
| Server logs | Up to 90 days |

---

# 🧑‍💻 Technical Overview

## ⚙️ Tech Stack

| Layer             | Technology                                                 |
| ----------------- | ---------------------------------------------------------- |
| Frontend          | HTML, Blade, TailwindCSS, Alpine.js                        |
| Backend           | PHP (Laravel)                                              |
| Database          | MySQL                                                      |
| Admin             | Custom Laravel admin panel                                 |
| Hosting           | Linux VPS in a Russian data center (Timeweb or equivalent) |
| File storage      | Local disk or S3-compatible storage in Russia              |
| SMS / OTP         | Russian SMS / flash-call provider                          |
| Captcha           | Yandex SmartCaptcha                                        |
| Analytics         | Yandex Metrica                                             |
| Versioning        | Git + GitHub (code only — never real user data or `.env`)  |
| Build Tools       | No CSS/JS builds for now. Just CDN.                        |
| Local environment | XAMPP                                                      |

## 📁 Project Structure

- `/app` – Core logic (Models, Controllers, Services, Policies)
- `/bootstrap` – Framework bootstrap
- `/config` – Configuration
- `/database` – Migrations, seeders, factories
- `/public` – Public assets and `index.php`
- `/resources` – Blade views, CSS/JS, language files
- `/routes` – `web.php`, `api.php`
- `/storage` – Logs, cache, uploads
- `/tests` – Unit and feature tests
- `/vendor` – Composer dependencies

---

## 🧱 MVC & Data Architecture

### 📂 Models

- `User` – phone-based account, display name, city, role, status
- `PhoneVerification` – OTP codes and attempts
- `Consent` – log of given/withdrawn consents
- `Listing` – classified entries
- `ListingImage` – listing photos
- `Category` – category tree
- `City` – cities/districts
- `Favorite` – saved listings
- `Report` – complaints about listings
- `AdminLog` – admin actions audit

### 🧭 Controllers

- `AuthController` – request code, verify code, logout
- `ProfileController` – view/edit profile, change phone, consents, delete account
- `ListingController` – CRUD, renew, deactivate, search & filters
- `ListingContactController` – "Показать телефон" endpoint (rate-limited)
- `FavoriteController` – add/remove favorites
- `ReportController` – submit a complaint
- `CategoryController` – public category pages
- `PageController` – static and legal pages
- `Admin\*` – dashboard, listings, users, reports, categories, cities, pages, stop-words, data-subject requests

### 🪟 Views (Blade templates)

- `layouts/app.blade.php` – main layout (footer with operator details and legal links)
- `home.blade.php` – search, categories, latest listings
- `listings/index.blade.php` – listings with filters
- `listings/show.blade.php` – single listing, "Показать телефон", "Пожаловаться"
- `listings/form.blade.php` – create/edit listing
- `auth/phone.blade.php` – phone entry + consents
- `auth/verify.blade.php` – code entry
- `dashboard/listings.blade.php` – my listings
- `dashboard/favorites.blade.php` – favorites
- `dashboard/profile.blade.php` – profile, consents, delete account
- `pages/*.blade.php` – about, FAQ, contacts, legal pages
- `admin/*.blade.php` – admin panel

### 🗄️ Database Schema

#### `users`

| Field | Type | Attributes |
|---|---|---|
| id | BIGINT | PK, Auto Increment |
| phone | VARCHAR(20) | UNIQUE, NOT NULL, E.164 format |
| phone_verified_at | TIMESTAMP | NULL |
| name | VARCHAR(60) | NOT NULL (display name) |
| city_id | BIGINT | FK → cities(id), NULL |
| show_phone | BOOLEAN | DEFAULT false (true only with distribution consent) |
| role | ENUM | ('user','admin') DEFAULT 'user' |
| status | ENUM | ('active','blocked') DEFAULT 'active' |
| last_login_at | TIMESTAMP | NULL |
| created_at / updated_at | TIMESTAMP | |
| deleted_at | TIMESTAMP | NULL (soft delete → hard delete within 30 days) |

#### `phone_verifications`

| Field | Type | Attributes |
|---|---|---|
| id | BIGINT | PK |
| phone | VARCHAR(20) | INDEX |
| code_hash | VARCHAR(255) | NOT NULL (code stored hashed) |
| attempts | TINYINT | DEFAULT 0 |
| expires_at | TIMESTAMP | NOT NULL |
| ip | VARCHAR(45) | NULL |
| created_at | TIMESTAMP | purged after 24 h |

#### `consents`

| Field | Type | Attributes |
|---|---|---|
| id | BIGINT | PK |
| user_id | BIGINT | FK → users(id) |
| type | ENUM | ('terms','pd_processing','pd_distribution','cookies') |
| document_version | VARCHAR(20) | version of the accepted text |
| fields | JSON | NULL (for distribution: e.g. ["name","phone"]) |
| ip | VARCHAR(45) | |
| user_agent | VARCHAR(255) | |
| given_at | TIMESTAMP | NOT NULL |
| withdrawn_at | TIMESTAMP | NULL |

#### `listings`

| Field | Type | Attributes |
|---|---|---|
| id | BIGINT | PK |
| user_id | BIGINT | FK → users(id), NOT NULL |
| category_id | BIGINT | FK → categories(id), NOT NULL |
| city_id | BIGINT | FK → cities(id), NOT NULL |
| title | VARCHAR(120) | NOT NULL |
| slug | VARCHAR(160) | UNIQUE, NOT NULL |
| description | TEXT | |
| price | INT UNSIGNED | NULL (NULL = договорная) |
| condition | ENUM | ('new','used') NULL |
| status | ENUM | ('draft','active','expired','blocked','deleted') |
| views | INT UNSIGNED | DEFAULT 0 (counter only, no viewer tracking) |
| published_at | TIMESTAMP | NULL |
| expires_at | TIMESTAMP | NULL |
| created_at / updated_at | TIMESTAMP | |

#### `listing_images`

| Field | Type | Attributes |
|---|---|---|
| id | BIGINT | PK |
| listing_id | BIGINT | FK → listings(id), ON DELETE CASCADE |
| path | VARCHAR(255) | NOT NULL (EXIF stripped) |
| sort_order | TINYINT | DEFAULT 0 |

#### `categories`

| Field | Type | Attributes |
|---|---|---|
| id | BIGINT | PK |
| parent_id | BIGINT | FK → categories(id), NULL |
| name | VARCHAR(100) | NOT NULL |
| slug | VARCHAR(120) | UNIQUE |
| sort_order | INT | DEFAULT 0 |
| is_active | BOOLEAN | DEFAULT true |

#### `cities`

| Field | Type | Attributes |
|---|---|---|
| id | BIGINT | PK |
| region | VARCHAR(100) | e.g. Чеченская Республика |
| name | VARCHAR(100) | NOT NULL |
| slug | VARCHAR(120) | UNIQUE |

#### `favorites`

| Field | Type | Attributes |
|---|---|---|
| user_id | BIGINT | FK → users(id), ON DELETE CASCADE |
| listing_id | BIGINT | FK → listings(id), ON DELETE CASCADE |
| created_at | TIMESTAMP | PK (user_id, listing_id) |

#### `reports`

| Field | Type | Attributes |
|---|---|---|
| id | BIGINT | PK |
| listing_id | BIGINT | FK → listings(id) |
| user_id | BIGINT | FK → users(id), NULL (anonymous allowed) |
| reason | ENUM | ('prohibited','fraud','wrong_category','third_party_data','offensive','other') |
| comment | VARCHAR(500) | NULL |
| status | ENUM | ('new','resolved','rejected') |
| created_at / resolved_at | TIMESTAMP | |

#### `admin_logs`

| Field | Type | Attributes |
|---|---|---|
| id | BIGINT | PK |
| admin_id | BIGINT | FK → users(id) |
| action | VARCHAR(50) | e.g. listing.block |
| target_type / target_id | VARCHAR / BIGINT | |
| created_at | TIMESTAMP | |

**Removed from earlier draft:** `messages` (no chat → no ОРИ duties), `transactions` (no payments → no 54-ФЗ), `email` and `password` columns in `users` (phone-only auth per 149-ФЗ ст. 8 ч. 10).

---

# 🗺️ Content Overview

## 📑 Page List

| Page Name | URL Slug | Notes |
|---|---|---|
| Home | `/` | Search bar, categories, latest listings |
| Listings | `/listings` | All active listings with filters |
| Category | `/c/{slug}` | Listings in a category (SEO pages) |
| Listing | `/listing/{slug}` | Photos, description, price, city, seller name, "Показать телефон", "Пожаловаться" |
| Submit Listing | `/listing/create` | Posting form (login required) |
| Login / Sign up | `/login` | Phone → code, consents checkboxes |
| Dashboard | `/dashboard` | My listings, favorites, profile, consents, delete account |
| About | `/about` | What Kerla is |
| FAQ | `/faq` | How to post, safety tips for buyers and sellers |
| Contacts | `/contacts` | Operator details, info@kerla.ru (plain email link, no contact form) |
| Blog (optional) | `/blog`, `/blog/{slug}` | Articles written by the Kerla team only, no comments |
| Privacy Policy | `/privacy` | Политика обработки персональных данных |
| PD Processing Consent | `/consent` | Согласие на обработку ПДн (separate document) |
| PD Distribution Consent | `/consent-public` | Согласие на распространение ПДн |
| Terms of Service | `/terms` | Пользовательское соглашение (public offer) |
| Listing Rules | `/rules` | What can and can't be posted |
| Admin Panel | `/admin` | Users, listings, reports, categories, cities, pages |

**Terms of Service must state:** Kerla is only an information board; it is not a party to deals and does not verify goods, sellers or payments; users are responsible for their listings; users must be 18+; Kerla can remove any listing that breaks the rules or the law; the site owner's details and legal email.

## ✍️ Content Language: Russian

## 🔤 Translation / i18n

Russian only at launch. Chechen language possible later (Laravel lang files).

---

# 🚫 Features intentionally NOT included

| Feature                                       | Reason                                                                                                            |
| --------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- |
| Internal chat / messages                      | Makes Kerla an ОРИ (149-ФЗ ст. 10.1): RKN registry, storing messages and metadata, SORM, handing data to agencies |
| Contact form to the seller (via Kerla)        | Same as chat — Kerla would be transmitting messages                                                               |
| Payments, premium, featured ads               | 54-ФЗ cash register + receipts, consumer law                                                                      |
| Banner advertising                            | 38-ФЗ ad marking and ОРД reporting                                                                                |
| Seller reviews & ratings                      | ГК ст. 152 (honor/reputation) disputes, moderation burden, extra PD                                               |
| Profile photos / avatars                      | ГК ст. 152.1 (image of a person), extra PD                                                                        |
| Email, surname, birth date, address, passport | Not needed → collecting them only adds responsibility                                                             |
| Login via Google / Apple / Facebook           | Not allowed as authorization for RF users (149-ФЗ ст. 8 ч. 10); cross-border transfer                             |
| Jobs & CVs category                           | Anti-discrimination rules for vacancies, heavy PD in CVs                                                          |
| Chatbot / AI features                         | Would send user data to third parties                                                                             |
| Buyer/seller "safe deal", delivery            | Kerla would become a party to transactions                                                                        |
| Business verification (ИНН checks, documents) | Extra PD and document storage                                                                                     |

---

# 🔧 Maintenance & TODOs

## 🧹 Known Issues / Bugs

- [ ] Add 404 / 500 error pages
- [ ] Test phone reveal rate limiting

## 🔄 Future Plans (each requires a separate legal review before building)

- Paid featured listings (with cloud cash register via Tochka/ЮKassa)
- Jobs category (with a strict vacancy form)
- Business profiles (company name, work hours — no personal data)
- Saved searches with notifications (would require a separate notification consent)
- Expansion to Ingushetia, Dagestan and other regions
- If daily audience ever approaches 100k users in RF → prepare for 149-ФЗ ст. 10.7 (RKN registry, counter, Госуслуги integration)

---

# ⏱️ Timeline & Milestones

- Start Date:
- Estimated Launch:
- Key Milestones:
  1. Auth (phone OTP + consents log)
  2. Listings CRUD + photos + categories/cities
  3. Search & filters
  4. Phone reveal + distribution consent
  5. Reports + admin moderation
  6. Legal pages + cookie banner
  7. RKN notification submitted
  8. Deploy to Russian VPS, QA, launch

---

# 🎨 Design & UX Notes

- UI/UX Goals: clean, simple, mobile-first; light TailwindCSS styling without extra shadows or animations
- Accessibility (WCAG): readable contrast, large tap targets, labels on all form fields
- Fonts / Typography: self-hosted font (e.g. Inter or Manrope) — no Google Fonts CDN
- Icons: inline SVG set (e.g. Heroicons / Lucide)
- Footer on every page: operator name (ИП Тимирбулатов К.Р.), ОГРНИП, info@kerla.ru, links to `/privacy`, `/terms`, `/rules`

# 👤 Website Author / Maintainer

- **Developer:** Kerim @ GrozNet
- **Contact Email:** info@groznet.com
- **Git Repo:** github.com/groznet
- **Live Site:** [groznet.com](https://groznet.com)

---

> ⚠️ This document describes the technical design. It is not legal advice — have the final Privacy Policy, consents and Terms checked by a lawyer before launch.
