<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pipeline = (float) Project::query()->whereNotIn('status', ['completed', 'cancelled'])->sum('estimated_value');
        $collected = (float) Invoice::query()->sum('amount_paid');

        return [
            Stat::make('Active Closet Projects', Project::query()->whereNotIn('status', ['completed', 'cancelled'])->count())
                ->description('In pipeline')
                ->descriptionIcon('heroicon-m-home-modern')
                ->color('success'),
            Stat::make('Customers', Customer::query()->count())
                ->description('Homeowners & builders')
                ->color('info'),
            Stat::make('Pipeline Value', '$'.number_format($pipeline, 0))
                ->description('Estimated open projects')
                ->color('warning'),
            Stat::make('Collected', '$'.number_format($collected, 0))
                ->description(Appointment::query()->whereDate('starts_at', '>=', now())->count().' upcoming appointments')
                ->color('primary'),
        ];
    }
}
