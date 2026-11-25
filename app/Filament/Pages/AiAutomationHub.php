<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Pages\Page;

class AiAutomationHub extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static string $view = 'filament.pages.ai-automation-hub';

    protected static ?string $navigationGroup = 'AI Tools';

    protected static ?string $title = 'AI Automation Suggestions';

    protected static ?int $navigationSort = 11;

    public string $suggestions = '';

    public function loadSuggestions(AiService $ai): void
    {
        $this->suggestions = $ai->automationSuggestions();
    }
}
