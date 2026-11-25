@extends('layouts.app')

@section('title', 'Knowledge Base | Nestline Closet Studio')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
    <h1 class="font-display text-4xl font-extrabold text-[color:var(--nl-teal-dark)]">Knowledge base</h1>
    <p class="mt-3 max-w-2xl text-[color:var(--nl-slate)]">Common issues, step-by-step guides, admin manual notes, and troubleshooting for Nestline closet projects.</p>

    @php
        $labels = [
            'common-issues' => 'Common Issues',
            'guides' => 'Step-by-Step Guides',
            'admin-manual' => 'Admin Manual',
            'troubleshooting' => 'Troubleshooting',
        ];
    @endphp

    <div class="mt-12 space-y-12">
        @foreach($labels as $key => $label)
            @if(isset($articles[$key]) && $articles[$key]->isNotEmpty())
                <div>
                    <h2 class="font-display text-2xl font-bold">{{ $label }}</h2>
                    <ul class="mt-4 space-y-2">
                        @foreach($articles[$key] as $article)
                            <li>
                                <a class="text-[color:var(--nl-teal)] hover:underline" href="{{ route('knowledge.show', $article->slug) }}">{{ $article->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>
</section>
@endsection
