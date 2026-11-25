<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?string $title = 'Company Settings';

    protected static ?int $navigationSort = 90;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'company_name' => Setting::getValue('company_name', 'Nestline Closet Studio'),
            'phone' => Setting::getValue('phone', '(512) 555-0148'),
            'email' => Setting::getValue('email', 'hello@nestlinecloset.com'),
            'whatsapp' => Setting::getValue('whatsapp', '15125550148'),
            'address' => Setting::getValue('address', '1840 Burnet Rd, Suite 210, Austin, TX 78756'),
            'service_area' => Setting::getValue('service_area', 'Greater Austin & Central Texas'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_name')->required(),
                Forms\Components\TextInput::make('phone')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('whatsapp')->helperText('Digits only for wa.me link'),
                Forms\Components\TextInput::make('address')->columnSpanFull(),
                Forms\Components\TextInput::make('service_area')->columnSpanFull(),
            ])
            ->columns(2)
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();
        foreach ($state as $key => $value) {
            Setting::setValue($key, $value);
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}
