<x-filament-panels::page>
    <form wire:submit="ask" class="space-y-6">
        {{ $this->form }}
        <x-filament::button type="submit">Ask assistant</x-filament::button>
    </form>

    @if($result)
        <div class="mt-6 rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <pre class="whitespace-pre-wrap text-sm text-gray-700 dark:text-gray-200">{{ $result }}</pre>
        </div>
    @endif
</x-filament-panels::page>
