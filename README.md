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

1. **Foundation** ✅ Laravel 12, Livewire, Filament, Reverb, Cashier, Prism, Horizon, Telescope, Pest, and a working workspace dashboard.
2. **Multi-tenant core** ✅ Workspaces, members, owner/admin/editor/viewer roles, invitations, switching, and tenant-scoped models.
3. **Content engine** ✅ Assessment/survey/poll/form questionnaires, ten question types, choices, scoring metadata, and branching rules.
4. **Taker flows** ✅ Share links, embeds, resumable anonymous/authenticated responses, private file answers, live polls, results, and live leaderboards.
5. **AI layer** ✅ Question generation, rubric grading, adaptive difficulty, and cross-response insights through one `AiUsage` ledger.
6. **Reporting & exports** ✅ Response review, analytics, PDF reports, Excel-compatible CSV, and signed webhooks with delivery history.
7. **Billing** ✅ Cashier + Stripe per workspace, Free/Pro/Business gates, team limits, response usage, AI metering, checkout, and portal access.
8. **Polish** ✅ Tenant-safe Sanctum API, scoped token management, workspace audit log, rate limits, staff-only admin, and accessibility foundations.

## API

Create a read-only or read/write token at `/settings/api-tokens`, then send it as a bearer token. API routes are under `/api/v1` and include workspace details, questionnaire/question/option CRUD, responses, and analytics. When a user belongs to several workspaces, pass the workspace slug in `X-Workspace`.

Tokens expire after one year and can be revoked from the same settings page. Read-only tokens cannot mutate content, and a token never grants more access than its user's workspace role.

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

Grant the first internal staff user access to `/admin` with:

```bash
php artisan user:admin staff@example.com
```
