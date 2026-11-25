<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'Operations';

    protected static ?string $navigationLabel = 'Closet Projects';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('number')->required()->unique(ignoreRecord: true)->default(fn () => 'NL-'.now()->format('ymd').'-'.random_int(100, 999)),
            Forms\Components\Select::make('customer_id')->relationship('customer', 'name')->searchable()->preload()->required(),
            Forms\Components\Select::make('assigned_to')->relationship('assignee', 'name')->searchable()->preload(),
            Forms\Components\TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
            Forms\Components\Select::make('closet_type')->options([
                'reach-in' => 'Reach-In',
                'walk-in' => 'Walk-In',
                'pantry' => 'Pantry',
                'garage' => 'Garage',
                'mudroom' => 'Mudroom',
                'kids' => 'Kids Closet',
            ]),
            Forms\Components\Select::make('status')->options([
                'lead' => 'Lead',
                'measured' => 'Measured',
                'design' => 'Design',
                'approved' => 'Approved',
                'production' => 'Production',
                'install' => 'Install Scheduled',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ])->required()->default('lead'),
            Forms\Components\TextInput::make('estimated_value')->numeric()->prefix('$'),
            Forms\Components\DatePicker::make('start_date'),
            Forms\Components\DatePicker::make('due_date'),
            Forms\Components\Textarea::make('scope')->rows(3)->columnSpanFull(),
            Forms\Components\Textarea::make('notes')->rows(2)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->limit(30),
                Tables\Columns\TextColumn::make('customer.name')->searchable(),
                Tables\Columns\TextColumn::make('closet_type')->badge(),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'completed' => 'success',
                    'cancelled' => 'danger',
                    'install', 'production' => 'warning',
                    default => 'info',
                }),
                Tables\Columns\TextColumn::make('estimated_value')->money('USD'),
                Tables\Columns\TextColumn::make('due_date')->date(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
