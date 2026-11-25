<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\KnowledgeArticle;
use App\Models\Post;
use App\Models\Setting;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->take(3)->get();

        return view('pages.home', [
            'posts' => $posts,
            'brand' => $this->brand(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', ['brand' => $this->brand()]);
    }

    public function services(): View
    {
        return view('pages.services', [
            'brand' => $this->brand(),
            'services' => $this->serviceCatalog(),
        ]);
    }

    public function serviceShow(string $slug): View
    {
        $services = $this->serviceCatalog();
        abort_unless(isset($services[$slug]), 404);

        return view('services.show', [
            'brand' => $this->brand(),
            'slug' => $slug,
            'service' => $services[$slug],
            'services' => $services,
        ]);
    }

    public function blog(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->paginate(9);

        return view('blog.index', ['brand' => $this->brand(), 'posts' => $posts]);
    }

    public function blogShow(string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('blog.show', ['brand' => $this->brand(), 'post' => $post]);
    }

    public function knowledge(): View
    {
        $articles = KnowledgeArticle::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('kb.index', ['brand' => $this->brand(), 'articles' => $articles]);
    }

    public function knowledgeShow(string $slug): View
    {
        $article = KnowledgeArticle::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('kb.show', ['brand' => $this->brand(), 'article' => $article]);
    }

    public function contact(): View
    {
        return view('pages.contact', ['brand' => $this->brand()]);
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);

        return back()->with('success', 'Thanks! A Nestline designer will follow up within one business day.');
    }

    public function chat(Request $request, AiService $ai)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        return response()->json([
            'reply' => $ai->chat($data['message'], 'public'),
        ]);
    }

    /** @return array<string, mixed> */
    protected function brand(): array
    {
        return [
            'name' => Setting::getValue('company_name', 'Nestline Closet Studio'),
            'phone' => Setting::getValue('phone', '(512) 555-0148'),
            'email' => Setting::getValue('email', 'hello@nestlinecloset.com'),
            'whatsapp' => Setting::getValue('whatsapp', '15125550148'),
            'address' => Setting::getValue('address', '1840 Burnet Rd, Suite 210, Austin, TX 78756'),
            'service_area' => Setting::getValue('service_area', 'Greater Austin & Central Texas'),
        ];
    }

    /** @return array<string, array<string, string>> */
    protected function serviceCatalog(): array
    {
        return [
            'walk-in-systems' => [
                'title' => 'Walk-In Closet Systems',
                'summary' => 'Island layouts, double hanging, shoe walls, and lighting for primary suites.',
                'body' => 'Walk-in designs from Nestline Closet Studio balance capacity with calm circulation. We engineer islands, jewelry drawers, valet rods, and LED runs so every garment is visible without crowding the center aisle.',
                'image' => 'https://images.unsplash.com/photo-1558997519-83ea9252edf8?auto=format&fit=crop&w=1600&q=80',
            ],
            'reach-in-organizers' => [
                'title' => 'Reach-In Organizers',
                'summary' => 'Maximize narrow closets with adjustable hanging, drawers, and shelves.',
                'body' => 'Reach-in systems reclaim wasted air space behind bifold or sliding doors. Adjustable standards, dual hanging, and slim drawers transform guest rooms and secondary bedrooms without construction drama.',
                'image' => 'https://images.unsplash.com/photo-1595428774223-ef5262434d6f?auto=format&fit=crop&w=1600&q=80',
            ],
            'pantry-garages' => [
                'title' => 'Pantry & Garage Zones',
                'summary' => 'Pull-out trays, vertical storage, and mudroom hubs for active households.',
                'body' => 'From kitchen pantries to garage gear walls, Nestline builds zones that keep Austin households moving. Pull-outs, can risers, sports racks, and labeled bins keep supplies visible and ready.',
                'image' => 'https://images.unsplash.com/photo-1556912173-46c336c7fd55?auto=format&fit=crop&w=1600&q=80',
            ],
            'custom-millwork' => [
                'title' => 'Custom Millwork Finishes',
                'summary' => 'Wood-grain laminates, soft-close hardware, and glass accents.',
                'body' => 'Choose thermally fused laminates, hardwood accents, frosted glass, and soft-close hardware that matches your interior palette. Finish boards travel with your designer so samples are approved on site.',
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1600&q=80',
            ],
        ];
    }
}
