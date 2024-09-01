<?php

namespace App\Filament\Pages;
use App\Filament\Resources\BlogResource\Widgets\BlogStatsOverviewWidget;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getWidgets(): array
    {
        return [
            BlogStatsOverviewWidget::class,

        ];
    }
}
