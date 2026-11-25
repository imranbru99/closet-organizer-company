<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class AiTroubleshoot extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static string $view = 'filament.pages.ai-troubleshoot';

    protected static ?string $navigationGroup = 'AI Tools';

    protected static ?string $title = 'AI Troubleshooting Assistant';

    protected static ?int $navigationSort = 12;

    public ?array $data = [];

    public string $result = '';

    public function mount(): void
    {
        $this->form->fill([
            'issue' => 'Install crew is waiting but soft-close hinges show zero stock for SKU HL-SC35.',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Textarea::make('issue')->required()->rows(4)->label('Describe the issue'),
        ])->statePath('data');
    }

    public function ask(AiService $ai): void
    {
        $this->result = $ai->troubleshoot($this->form->getState()['issue']);
    }
}
