# Quiz SaaS

Multi-tenant SaaS platform for **graded quizzes**, **surveys / questionnaires**, **live polls**, and **forms / lead capture** — with AI authoring, AI grading of open-ended answers, adaptive difficulty, and AI-powered insights across responses.

The platform aims to combine, in a single Laravel app, the value of:

| Competitor | What we match |
|---|---|
| Typeform | Branching/skip logic, embeds, webhooks, polished taker UI |
| Mentimeter / Slido | Live polls, join-by-code, real-time charts (Reverb websockets) |
| SurveyMonkey | Likert / NPS, cross-response AI insights (themes, sentiment) |
| Quizlet / Kahoot | Graded assessments, skill scoring, leaderboards |
| Jotform | Conditional forms, file uploads, payments |
| Quizgecko / Eduaide / Revisely | PDF/URL → AI-generated quiz, rubric-based open-ended grading, adaptive difficulty |

## Stack

| Layer | Choice |
|---|---|
| Framework | Laravel 12 + PHP 8.3+ |
| Frontend | Livewire 3/4 + Flux UI 2 + Alpine + Tailwind 4 |
| Realtime | Laravel Reverb (live polls, leaderboards) |
| Admin | Filament 5 (back-office only) |
| Authoring UI | Custom Livewire (product-grade UX) |
| AI | Prism PHP — multi-provider abstraction (Claude / OpenAI / Gemini / Ollama) |
| Billing | Laravel Cashier + Stripe (Stripe Tax for EU VAT) |
| Queues | Laravel Horizon (Redis) |
| Debug | Laravel Telescope (dev) |
| Audit | spatie/laravel-activitylog |
| Tests | Pest 3 |

## Phased delivery plan

1. **Foundation** ✅ Laravel 12 skeleton with Livewire + Filament + Reverb + Cashier + Prism + Horizon + Telescope + Pest, MySQL-ready, login/dashboard/admin all reachable.
2. **Multi-tenant core** — workspaces, members, roles (owner/admin/editor/viewer), invitations, tenant-scoped models.
3. **Content engine** — polymorphic `questionnaires` (assessment | survey | poll | form), shared question type library, branching/skip-logic JSON.
4. **Taker flows** — share links, embeds, anonymous + auth takers, live-poll join-by-code over Reverb.
5. **AI layer (Prism)** — question generation, rubric grading, adaptive difficulty, cross-response insights — all routed through one `AiUsage` ledger.
6. **Reporting & exports** — dashboards, PDF (Browsershot), CSV/Excel, webhooks.
7. **Billing** — Cashier + Stripe per workspace, plans (Free/Pro/Business), AI metering, Stripe Tax.
8. **Polish** — API + Sanctum, activity log, audit, rate limits, a11y.

The original Laravel 5 quiz app lives on the `v5` branch and is used only as a feature reference.

## Local setup

```bash
cp .env.example .env
# fill in DB + Stripe + AI keys
composer install
npm install
php artisan key:generate
php artisan migrate
npm run build
composer dev   # serves PHP + queue worker + Reverb + vite + Pail in one process
```

Default URLs once running:

- `/` — landing
- `/login`, `/register` — public auth
- `/dashboard` — authed user dashboard
- `/admin` — Filament back-office
- `/horizon` — queue monitor
- `/telescope` — request/query/job inspector (dev)
