<x-filament-panels::page>
    <div class="space-y-4">
        <p class="text-sm text-gray-600 dark:text-gray-300">
            Generate practical automation ideas tailored to Nestline Closet Studio operations.
        </p>
        <x-filament::button wire:click="loadSuggestions">Refresh suggestions</x-filament::button>

        @if($suggestions)
            <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                <pre class="whitespace-pre-wrap text-sm text-gray-700 dark:text-gray-200">{{ $suggestions }}</pre>
            </div>
        @endif
    </div>
</x-filament-panels::page>
