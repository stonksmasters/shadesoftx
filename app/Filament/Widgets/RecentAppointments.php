<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\Widget;

class RecentAppointments extends Widget
{
    protected static string $view = 'filament.widgets.recent-appointments';

    // This method makes $appointments available to your Blade view
    protected function getViewData(): array
    {
        return [
            'appointments' => Appointment::latest()->take(5)->get(),
        ];
    }
}