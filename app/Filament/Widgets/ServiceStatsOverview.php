<?php

namespace App\Filament\Widgets;

use App\Models\Ticketing;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ServiceStatsOverview extends BaseWidget
{


    protected static bool $isLazy = true;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Ticket', Ticketing::count())
                ->color('success')
                ->description('Test Widget')
                ->chart([7,3,1,8,5,4,9,3])
        ];
    }
}
