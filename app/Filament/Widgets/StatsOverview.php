<?php
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Patient;
use App\Models\Appointment;
use Carbon\Carbon;

class StatsOverview extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '10s';
     Protected static ?int $sort = 1; // first widget on dashboard
       
    protected function getStats(): array
    {
        // 1. Total Registered Patients
        $totalPatients = Patient::count();

        // 2. Today's Appointments
        $todayAppointments = 52;
       // Appointment::whereDate('scheduled_at', today())->count();

        // 3. Pending/Waiting Queue
        $pendingQueue = 24;
        //  Appointment::whereDate('scheduled_at', today())
        //     ->where('status', 'pending') // Change 'pending' if your status column uses a different word
        //    ->count();

        // 4. Active Doctors (You can replace this with a DB query if you have a doctors table)
        $activeDoctors = 14; 

        return [
            Stat::make('Total Patients', number_format($totalPatients))
                ->description('All registered patients')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-users'),

            Stat::make("Today's Appointments", $todayAppointments)
                ->description('+12% from yesterday')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning')
                ->icon('heroicon-o-calendar-days'),

            Stat::make('Pending Queue', $pendingQueue)
                ->description('Waiting to be seen')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->icon('heroicon-o-clock'),

            Stat::make('Active Doctors', $activeDoctors)
                ->description('Currently on duty')
                ->color('info')
                ->icon('heroicon-o-user-group'),
        ];
    }
} 