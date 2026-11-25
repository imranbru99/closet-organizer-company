# Nestline Closet Studio — Laravel 13 + Filament 3 Website, ERP & AI

Production-ready public website and operations ERP for a US custom closet organization SME. Includes a branded marketing site, Filament admin for projects/inventory/invoices, FAQ-aware AI chatbot, admin AI tools, and a closet-specific knowledge base.

## Features
- 🏠 Premium public site (hero, services, about, ERP preview, contact)
- 🧩 Service detail pages for walk-ins, reach-ins, pantry/garage, and millwork
- 📰 Blog / journal with seeded closet organization articles
- 📚 Knowledge base (common issues, guides, admin manual, troubleshooting)
- 💬 Floating WhatsApp button + public AI chatbot (OpenAI/Gemini or FAQ demo)
- 🗂️ Filament ERP: users/roles, customers, closet projects, inventory, invoices, payments, appointments
- 📊 Dashboard widgets with pipeline stats and charts
- ⚙️ Company settings page
- ✨ Admin AI content generator, automation suggestions, and troubleshooting assistant
- 🌱 Realistic demo seeders for Austin-area closet operations

## Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js + Tailwind CSS 4
- SQLite (local demo) / MySQL (production)
- OpenAI HTTP integration with Gemini fallback keys

## Installation
```bash
git clone https://github.com/imranbru99/closet-organizer-company.git
cd closet-organizer-company
composer install
copy .env.example .env   # Windows
php artisan key:generate
type nul > database\database.sqlite   # or touch database/database.sqlite
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Visit:
- Public site: http://127.0.0.1:8000
- Admin ERP: http://127.0.0.1:8000/admin

### Admin login
- Email: `admin@example.com`
- Password: `password`

Optional AI keys in `.env`:
```
OPENAI_API_KEY=
OPENAI_MODEL=gpt-4o-mini
GEMINI_API_KEY=
GEMINI_MODEL=gemini-1.5-flash
```

## Screenshots / Visual Dashboard
![Walk-in closet system](https://images.unsplash.com/photo-1558997519-83ea9252edf8?auto=format&fit=crop&w=1200&q=80)

![Reach-in organizer detail](https://images.unsplash.com/photo-1595428774223-ef5262434d6f?auto=format&fit=crop&w=1200&q=80)

![Pantry organization zones](https://images.unsplash.com/photo-1556912173-46c336c7fd55?auto=format&fit=crop&w=1200&q=80)

![Closet millwork finishes](https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=80)

## Live Demo
Placeholder — deploy to your host and link the production URL here.

**Suggested SEO GitHub description:**  
`Nestline Closet Studio — Laravel 13 + Filament 3 closet organization website, ERP, AI chatbot, and knowledge base for a US custom closet SME.`

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |
