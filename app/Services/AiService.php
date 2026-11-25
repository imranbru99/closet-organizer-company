<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    /** @var array<string, string> */
    protected array $faq = [
        'pricing' => 'Nestline Closet Studio designs typically start around $1,800 for a reach-in refresh and $6,500–$18,000 for full walk-in systems depending on materials, hardware, and lighting. We provide free in-home design consultations across Greater Austin.',
        'timeline' => 'Most projects move from measure to install in 2–4 weeks. Custom millwork or specialty finishes can add 1–2 weeks. We confirm a firm install window after your design is approved.',
        'materials' => 'We install thermally fused laminate, wood-grain melamine, solid hardwood accents, soft-close hardware, LED lighting, velvet-lined drawers, and glass-front cabinets. Finish samples are reviewed during your design appointment.',
        'measure' => 'A Nestline designer visits your home, measures every wall and obstruction, photographs the space, and discusses wardrobe habits so the layout matches how you actually dress and store.',
        'warranty' => 'Hardware carries a lifetime limited warranty against manufacturer defects. Laminate panels are warranted for 5 years with normal residential use. Ask your project manager for the full warranty packet at install.',
        'service area' => 'We serve Austin, Round Rock, Cedar Park, Georgetown, Pflugerville, Lakeway, Dripping Springs, and surrounding Central Texas communities within about 45 miles of downtown Austin.',
        'deposit' => 'A 50% deposit locks materials and the production slot. The balance is due on the day of completed installation after a walkthrough with your installer.',
        'reach-in' => 'Reach-in closet systems maximize hanging, shelving, and drawers behind existing doors. Ideal for bedrooms, guest rooms, and kids’ spaces when a walk-in is not available.',
        'walk-in' => 'Walk-in systems include islands, double hanging, accessory walls, shoe towers, and optional seating. We engineer flow so every garment has a home without crowding the center aisle.',
        'pantry' => 'Our pantry organizers use adjustable shelves, pull-out trays, can risers, and door racks so grocery storage stays visible and accessible—great for Austin kitchens that multitask as command centers.',
    ];

    public function chat(string $message, string $mode = 'public'): string
    {
        $message = trim($message);
        if ($message === '') {
            return 'Ask anything about Nestline Closet Studio—pricing, timelines, materials, or scheduling a design visit.';
        }

        if ($this->hasOpenAiKey()) {
            $reply = $this->callOpenAi($message, $mode);
            if ($reply) {
                return $reply;
            }
        }

        if ($this->hasGeminiKey()) {
            $reply = $this->callGemini($message, $mode);
            if ($reply) {
                return $reply;
            }
        }

        return $this->demoReply($message, $mode);
    }

    public function generateContent(string $topic, string $type = 'blog'): string
    {
        $prompt = match ($type) {
            'product' => "Write a concise product description for a closet organization product: {$topic}",
            'service' => "Write a short marketing blurb for this closet service: {$topic}",
            default => "Write a helpful blog outline about: {$topic} for Nestline Closet Studio clients in Austin, TX",
        };

        return $this->chat($prompt, 'generator');
    }

    public function automationSuggestions(): string
    {
        return $this->chat(
            'Suggest 5 practical AI automations for a custom closet organization SME ERP covering leads, measuring appointments, inventory of hardware, invoicing, and install scheduling.',
            'automation'
        );
    }

    public function troubleshoot(string $issue): string
    {
        return $this->chat("Troubleshoot this closet ERP / operations issue: {$issue}", 'troubleshoot');
    }

    protected function hasOpenAiKey(): bool
    {
        return filled(config('services.openai.key'));
    }

    protected function hasGeminiKey(): bool
    {
        return filled(config('services.gemini.key'));
    }

    protected function systemPrompt(string $mode): string
    {
        $base = 'You are the Nestline Closet Studio assistant for a US custom closet organization company in Austin, Texas. Be concise, practical, and friendly. Never invent unsafe advice.';

        return match ($mode) {
            'generator' => $base.' Generate clean marketing or blog content for closet systems only.',
            'automation' => $base.' Suggest ERP automations for closet project workflows.',
            'troubleshoot' => $base.' Help staff diagnose scheduling, inventory, invoice, or install issues.',
            default => $base.' Answer homeowner FAQs about closet design, install, and Nestline services.',
        };
    }

    protected function callOpenAi(string $message, string $mode): ?string
    {
        try {
            $response = Http::withToken(config('services.openai.key'))
                ->timeout(30)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => config('services.openai.model', 'gpt-4o-mini'),
                    'messages' => [
                        ['role' => 'system', 'content' => $this->systemPrompt($mode)],
                        ['role' => 'user', 'content' => $message],
                    ],
                    'temperature' => 0.5,
                ]);

            if ($response->successful()) {
                return trim((string) data_get($response->json(), 'choices.0.message.content'));
            }
        } catch (\Throwable) {
            return null;
        }

        return null;
    }

    protected function callGemini(string $message, string $mode): ?string
    {
        try {
            $key = config('services.gemini.key');
            $model = config('services.gemini.model', 'gemini-1.5-flash');
            $response = Http::timeout(30)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
                    'contents' => [[
                        'parts' => [[
                            'text' => $this->systemPrompt($mode)."\n\nUser: {$message}",
                        ]],
                    ]],
                ]);

            if ($response->successful()) {
                return trim((string) data_get($response->json(), 'candidates.0.content.parts.0.text'));
            }
        } catch (\Throwable) {
            return null;
        }

        return null;
    }

    protected function demoReply(string $message, string $mode): string
    {
        $lower = Str::lower($message);

        if ($mode === 'automation') {
            return "Demo automation ideas for Nestline Closet Studio:\n"
                ."1. Auto-create a measure appointment when a web lead chooses a preferred day.\n"
                ."2. Flag soft-close hinge SKUs when stock drops below reorder level.\n"
                ."3. Draft deposit invoices when a project status moves to Approved.\n"
                ."4. Send install-day SMS checklists to the assigned installer.\n"
                ."5. Summarize weekly pipeline value by closet type (reach-in, walk-in, pantry, garage).\n"
                .'Add OPENAI_API_KEY or GEMINI_API_KEY for live model responses.';
        }

        if ($mode === 'generator') {
            return "Demo draft for Nestline Closet Studio — {$message}\n\n"
                ."A thoughtfully designed closet starts with how you live, not just how much square footage you have. "
                .'Nestline designers map hanging zones, drawer banks, and accessory niches so every morning feels calmer. '
                .'Request a complimentary design visit to explore finishes that fit Austin homes—from Oak Hill bungalows to Domain condos.';
        }

        if ($mode === 'troubleshoot') {
            return "Demo troubleshooting tips:\n"
                ."- Confirm the project status and assigned designer before rescheduling installs.\n"
                ."- Check product stock_qty vs. the bill of materials for missing hardware.\n"
                ."- Verify invoice deposit (50%) is recorded before releasing materials to production.\n"
                ."- Review appointment type (measure / design review / install / punch) for conflicts.\n"
                .'Describe the exact error for more specific steps once an API key is configured.';
        }

        foreach ($this->faq as $needle => $answer) {
            if (Str::contains($lower, $needle) || Str::contains($lower, Str::replace('-', ' ', $needle))) {
                return $answer."\n\n(Demo FAQ response — configure OPENAI_API_KEY or GEMINI_API_KEY for live AI.)";
            }
        }

        if (Str::contains($lower, ['hello', 'hi', 'hey'])) {
            return 'Hi! I am the Nestline Closet Studio assistant. Ask about walk-ins, reach-ins, pantries, pricing, timelines, or book a design visit in Greater Austin.';
        }

        return 'Thanks for asking about Nestline Closet Studio. We design and install custom reach-in, walk-in, pantry, and garage closet systems across Central Texas. '
            .'Try questions like “What does a walk-in cost?” or “How long until install?” — or call (512) 555-0148. '
            .'(Demo mode: add an AI API key in .env for generative answers.)';
    }
}
