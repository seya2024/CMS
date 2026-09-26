<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
//use App\Models\PatientVisit;
use Carbon\Carbon;

class PatientVisit extends ChartWidget
{
    
   // protected static ?string $heading = 'Patient Visits (Last 7 Days)';
    protected ?string $heading = 'Patient Visits (Last 7 Days)';

       Protected static ?int $sort = 2; // second widget on dashboard
       
    protected function getData(): array
    {
        // $data = collect(range(6, 0))->map(function ($daysAgo) {
        //     return Patient::whereDate('created_at', Carbon::now()->subDays($daysAgo))->count();
        // });

         $data = collect([12, 18, 9, 22, 15, 30, 25]);

        return [
            'datasets' => [
                [
                    'label' => 'Visits',
                    'data' => $data,
                ],
            ],
            'labels' => collect(range(6, 0))
                ->map(fn ($d) => Carbon::now()->subDays($d)->format('D'))
                ->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}