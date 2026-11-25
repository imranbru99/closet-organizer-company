<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProjectsChart extends ChartWidget
{
    protected static ?string $heading = 'Projects by Closet Type';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $rows = Project::query()
            ->select('closet_type', DB::raw('count(*) as total'))
            ->groupBy('closet_type')
            ->pluck('total', 'closet_type');

        $labels = $rows->keys()->map(fn ($k) => $k ? ucwords(str_replace('-', ' ', $k)) : 'Unspecified')->all();

        return [
            'datasets' => [
                [
                    'label' => 'Projects',
                    'data' => $rows->values()->all(),
                    'backgroundColor' => ['#0B6E6A', '#B8975A', '#5C6B73', '#2A9D8F', '#E9C46A', '#264653'],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
