@extends('layouts.app')

@section('title', 'About Nestline Closet Studio')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
    <p class="font-display text-5xl font-extrabold text-[color:var(--nl-teal-dark)]">Nestline Closet Studio</p>
    <h1 class="mt-4 max-w-2xl text-2xl text-[color:var(--nl-ink)]">A Central Texas closet company obsessed with calm storage.</h1>
    <div class="mt-10 grid gap-10 lg:grid-cols-2">
        <div class="space-y-4 text-[color:var(--nl-slate)]">
            <p>We started Nestline to fix the gap between beautiful Pinterest closets and the realities of Texas humidity, kids’ sports gear, and homeowners who need systems that survive daily use.</p>
            <p>Every project includes an on-site measure, a designer who maps hanging versus folded capacity, a clear material proposal, and a tidy install with a walkthrough before we leave.</p>
            <p>Our shop works with thermally fused laminates, soft-close hardware, LED lighting, and accessory kits sized for real wardrobes—not generic kits that waste corners.</p>
        </div>
        <img src="https://images.unsplash.com/photo-1615874959474-d391514d09f7?auto=format&fit=crop&w=1400&q=80" alt="Closet interior with warm lighting" class="h-full min-h-80 w-full object-cover">
    </div>
</section>
@endsection
