@extends('layouts.app')

@section('title', 'Nestline Closet Studio | Custom Closet Systems in Austin')
@section('meta_description', 'Nestline Closet Studio designs walk-in, reach-in, pantry, and garage organizers for Greater Austin homes.')

@section('content')
<section class="relative overflow-hidden nl-grid-bg">
    <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 pb-16 pt-12 sm:px-6 lg:grid-cols-2 lg:pt-16">
        <div class="nl-fade-up">
            <p class="font-display text-4xl font-extrabold leading-[1.05] tracking-tight text-[color:var(--nl-teal-dark)] sm:text-5xl lg:text-6xl">
                Nestline Closet Studio
            </p>
            <h1 class="mt-5 max-w-xl text-xl font-medium text-[color:var(--nl-ink)] sm:text-2xl">
                Closet systems that reclaim mornings—measured for how you actually live.
            </h1>
            <p class="mt-4 max-w-lg text-[color:var(--nl-slate)]">
                Custom walk-ins, reach-ins, pantries, and garage zones designed and installed across Central Texas.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('contact') }}" class="rounded-full bg-[color:var(--nl-teal)] px-6 py-3 text-sm font-semibold text-white hover:bg-[color:var(--nl-teal-dark)]">Schedule a design visit</a>
                <a href="{{ route('services') }}" class="rounded-full border border-[color:var(--nl-ink)]/15 bg-white/70 px-6 py-3 text-sm font-semibold text-[color:var(--nl-ink)]">Explore systems</a>
            </div>
        </div>
        <div class="nl-hero-media relative">
            <img
                src="https://images.unsplash.com/photo-1558997519-83ea9252edf8?auto=format&fit=crop&w=1800&q=80"
                alt="Custom walk-in closet with organized hanging and shelving"
                class="h-[420px] w-full object-cover sm:h-[520px]"
            >
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-tr from-[color:var(--nl-teal)]/25 via-transparent to-[color:var(--nl-brass)]/20"></div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
    <div class="nl-fade-up-delay max-w-2xl">
        <h2 class="font-display text-3xl font-bold text-[color:var(--nl-ink)]">Systems built around wardrobe reality</h2>
        <p class="mt-3 text-[color:var(--nl-slate)]">One purpose per project: turn chaotic storage into a quiet, durable closet that fits your home.</p>
    </div>
    <div class="mt-10 grid gap-8 md:grid-cols-2">
        @foreach([
            ['Walk-In Closet Systems', 'Island layouts, double hanging, shoe walls.', route('services.show', 'walk-in-systems'), 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=80'],
            ['Reach-In Organizers', 'Adjustable hanging and drawers for tight footprints.', route('services.show', 'reach-in-organizers'), 'https://images.unsplash.com/photo-1595428774223-ef5262434d6f?auto=format&fit=crop&w=1200&q=80'],
            ['Pantry & Garage Zones', 'Pull-outs and vertical storage for daily flow.', route('services.show', 'pantry-garages'), 'https://images.unsplash.com/photo-1556912173-46c336c7fd55?auto=format&fit=crop&w=1200&q=80'],
            ['Custom Millwork Finishes', 'Laminates, soft-close hardware, glass accents.', route('services.show', 'custom-millwork'), 'https://images.unsplash.com/photo-1615876235394-8c8818ffe6e4?auto=format&fit=crop&w=1200&q=80'],
        ] as [$title, $copy, $url, $img])
            <a href="{{ $url }}" class="group block overflow-hidden">
                <img src="{{ $img }}" alt="{{ $title }}" class="h-56 w-full object-cover transition duration-500 group-hover:scale-[1.03]">
                <h3 class="mt-4 font-display text-xl font-bold">{{ $title }}</h3>
                <p class="mt-1 text-sm text-[color:var(--nl-slate)]">{{ $copy }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="border-y border-[color:var(--nl-ink)]/8 bg-white/60">
    <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-16 sm:px-6 lg:grid-cols-2">
        <div>
            <h2 class="font-display text-3xl font-bold">Designed in Austin. Installed with care.</h2>
            <p class="mt-4 text-[color:var(--nl-slate)]">
                Nestline Closet Studio is a Central Texas team of designers and installers. We measure every obstruction, map hanging vs. folded volume, and leave your closet ready for day-one living—not a pile of unsorted hardware.
            </p>
            <a href="{{ route('about') }}" class="mt-6 inline-block text-sm font-semibold text-[color:var(--nl-teal)]">Our approach →</a>
        </div>
        <img
            src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=1400&q=80"
            alt="Organized closet shelving and drawer details"
            class="h-80 w-full object-cover"
        >
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
    <h2 class="font-display text-3xl font-bold">ERP dashboard preview</h2>
    <p class="mt-2 max-w-2xl text-[color:var(--nl-slate)]">Staff run closet projects, inventory, invoices, and scheduling from the Nestline admin panel.</p>
    <div class="mt-8 overflow-hidden rounded-none border border-[color:var(--nl-ink)]/10 bg-[color:var(--nl-ink)] p-4 text-white shadow-xl sm:p-6">
        <div class="mb-4 flex items-center justify-between text-xs uppercase tracking-widest text-white/50">
            <span>Nestline Operations</span>
            <span>Live demo data</span>
        </div>
        <div class="grid gap-4 sm:grid-cols-4">
            <div class="bg-white/5 p-4"><p class="text-xs text-white/60">Active projects</p><p class="mt-1 font-display text-3xl font-bold text-[color:var(--nl-brass)]">12</p></div>
            <div class="bg-white/5 p-4"><p class="text-xs text-white/60">Pipeline</p><p class="mt-1 font-display text-3xl font-bold">$148k</p></div>
            <div class="bg-white/5 p-4"><p class="text-xs text-white/60">Installs this week</p><p class="mt-1 font-display text-3xl font-bold">4</p></div>
            <div class="bg-white/5 p-4"><p class="text-xs text-white/60">Low-stock SKUs</p><p class="mt-1 font-display text-3xl font-bold">3</p></div>
        </div>
        <img
            src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1600&q=80"
            alt="Modern interior representing Nestline project pipeline"
            class="mt-4 h-48 w-full object-cover opacity-90"
        >
    </div>
</section>

@if($posts->isNotEmpty())
<section class="mx-auto max-w-6xl px-4 pb-20 sm:px-6">
    <h2 class="font-display text-3xl font-bold">From the Nestline journal</h2>
    <div class="mt-8 grid gap-8 md:grid-cols-3">
        @foreach($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="block">
                @if($post->cover_image)
                    <img src="{{ $post->cover_image }}" alt="" class="h-44 w-full object-cover">
                @endif
                <h3 class="mt-3 font-display text-lg font-bold">{{ $post->title }}</h3>
                <p class="mt-1 text-sm text-[color:var(--nl-slate)]">{{ $post->excerpt }}</p>
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection
