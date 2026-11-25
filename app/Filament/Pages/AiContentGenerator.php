<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class AiContentGenerator extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.ai-content-generator';

    protected static ?string $navigationGroup = 'AI Tools';

    protected static ?string $title = 'AI Content Generator';

    protected static ?int $navigationSort = 10;

    public ?array $data = [];

    public string $result = '';

    public function mount(): void
    {
        $this->form->fill([
            'type' => 'blog',
            'topic' => 'How to plan a walk-in closet for a primary suite',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')->options([
                'blog' => 'Blog / knowledge outline',
                'product' => 'Product description',
                'service' => 'Service marketing blurb',
            ])->required(),
            Forms\Components\Textarea::make('topic')->required()->rows(3)->columnSpanFull(),
        ])->columns(1)->statePath('data');
    }

    public function generate(AiService $ai): void
    {
        $state = $this->form->getState();
        $this->result = $ai->generateContent($state['topic'], $state['type']);
    }
}
