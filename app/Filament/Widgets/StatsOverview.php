<?php

// app/Filament/Widgets/StatsOverviewWidget.php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Appointments', Appointment::count()),
            Stat::make('Completed', Appointment::where('status', 'completed')->count()),
            Stat::make('Pending', Appointment::where('status', 'pending')->count()),
            // Add more: e.g. ContactMessage::count(), PageView::count(), etc.
        ];
    }
}
