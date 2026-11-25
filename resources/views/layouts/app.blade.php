<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $brand['name'] ?? 'Nestline Closet Studio')</title>
    <meta name="description" content="@yield('meta_description', 'Nestline Closet Studio designs and installs custom walk-in, reach-in, pantry, and garage closet systems across Greater Austin.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="nl-gradient min-h-screen antialiased">
    <header class="relative z-20 border-b border-[color:var(--nl-ink)]/8 bg-white/70 backdrop-blur-md">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="font-display text-xl font-800 tracking-tight text-[color:var(--nl-teal-dark)] sm:text-2xl" style="font-weight:800">
                Nestline Closet Studio
            </a>
            <nav class="hidden items-center gap-6 text-sm font-medium text-[color:var(--nl-slate)] md:flex">
                <a href="{{ route('services') }}" class="hover:text-[color:var(--nl-teal)]">Services</a>
                <a href="{{ route('about') }}" class="hover:text-[color:var(--nl-teal)]">About</a>
                <a href="{{ route('blog') }}" class="hover:text-[color:var(--nl-teal)]">Journal</a>
                <a href="{{ route('knowledge') }}" class="hover:text-[color:var(--nl-teal)]">Knowledge</a>
                <a href="{{ route('contact') }}" class="rounded-full bg-[color:var(--nl-teal)] px-4 py-2 text-white hover:bg-[color:var(--nl-teal-dark)]">Book design visit</a>
            </nav>
            <a href="{{ route('contact') }}" class="rounded-full bg-[color:var(--nl-teal)] px-3 py-2 text-sm text-white md:hidden">Contact</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 border-t border-[color:var(--nl-ink)]/10 bg-[color:var(--nl-ink)] text-white">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-12 sm:px-6 md:grid-cols-3">
            <div>
                <p class="font-display text-2xl font-bold">Nestline Closet Studio</p>
                <p class="mt-3 text-sm text-white/70">Custom closet organization systems for Central Texas homes—measured, designed, and installed with calm precision.</p>
            </div>
            <div class="text-sm text-white/80">
                <p>{{ $brand['address'] ?? '' }}</p>
                <p class="mt-2"><a class="hover:text-[color:var(--nl-brass)]" href="tel:+15125550148">{{ $brand['phone'] ?? '' }}</a></p>
                <p><a class="hover:text-[color:var(--nl-brass)]" href="mailto:{{ $brand['email'] ?? '' }}">{{ $brand['email'] ?? '' }}</a></p>
            </div>
            <div class="text-sm text-white/80">
                <p>Serving {{ $brand['service_area'] ?? 'Greater Austin' }}</p>
                <p class="mt-2"><a href="{{ url('/admin') }}" class="underline decoration-white/30 hover:decoration-white">Staff ERP login</a></p>
            </div>
        </div>
    </footer>

    @include('components.chatbot')
    @include('components.whatsapp')
</body>
</html>
