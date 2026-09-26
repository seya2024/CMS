<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Carbon\Carbon;

use BackedEnum;
use Filament\Support\Icons\Heroicon;

class ClinicManagementDashboard extends Page
{

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|\UnitEnum|null $navigationGroup = 'Analytics';
    protected static ?string $title = 'CSM Dasheboard';
    protected static ?int $navigationSort = -10;
    protected string $view = 'filament.pages.clinic-management-dashboard';    
   
    // ADD THIS METHOD INSTEAD:
    public function view(): string
    {
        return 'filament.pages.clinic-management-dashboard';
    }

            public function getTitle(): string
{
    return ''; 
}


    public ?string $lastRefreshed = null;
    
     public function refreshData(): void
    {
        $this->lastRefreshed = Carbon::now()->format('H:i:s');
    }

    // ─── Stats ───
    public function getOverviewStats(): array
    {
        $jitter = rand(-2, 3);
        return [
            'total_patients'      => 14832,
            'today_registered'    => 47 + $jitter,
            'today_appointments'  => 128,
            'completed_today'     => 89 + $jitter,
            'pending_today'       => 32 - $jitter,
            'no_show_today'       => 7,
            'active_doctors'      => 14,
            'available_beds'      => 23,
            'total_beds'          => 45,
            'occupancy_pct'       => round((45 - 23) / 45 * 100),
            'revenue_today'       => '$' . number_format(42580 + rand(-500, 500)),
            'revenue_month'       => '$' . number_format(892400),
            'avg_wait_time'       => 18 + rand(-2, 2),
            'patient_satisfaction'=> 94,
            'emergency_cases'     => 3,
        ];
    }


//     public function getTodayAppointments(): array
// {
//     return Appointment::whereDate('scheduled_at', today())
//         ->with(['patient', 'doctor'])
//         ->orderBy('scheduled_at')
//         ->get()
//         ->map(fn($a) => [
//             'id'      => $a->id,
//             'patient' => $a->patient->full_name,
//             'doctor'  => $a->doctor->full_name,
//             'dept'    => $a->department->name,
//             'time'    => $a->scheduled_at->format('h:i A'),
//             'status'  => $a->status,
//             'type'    => $a->appointment_type,
//         ])->toArray();
// }

        // ─── Today's Appointments ───
    public function getTodayAppointments(): array
    {
        $now = Carbon::now();
        $hour = $now->hour;
        return [
            ['id'=>'APT-4821','patient'=>'Abebe Kebede','doctor'=>'Dr. Tigist Hailu','dept'=>'Cardiology','time'=>'08:00 AM','status'=>'completed','type'=>'Follow-up'],
            ['id'=>'APT-4822','patient'=>'Sara Ahmed','doctor'=>'Dr. Dawit Mekonnen','dept'=>'Orthopedics','time'=>'08:30 AM','status'=>'completed','type'=>'New Patient'],
            ['id'=>'APT-4823','patient'=>'Hana Tadesse','doctor'=>'Dr. Selam Girma','dept'=>'Gynecology','time'=>'09:00 AM','status'=>'completed','type'=>'Follow-up'],
            ['id'=>'APT-4824','patient'=>'Yonas Bekele','doctor'=>'Dr. Tigist Hailu','dept'=>'Cardiology','time'=>'09:30 AM','status'=>'in-progress','type'=>'Consultation'],
            ['id'=>'APT-4825','patient'=>'Meron Gebre','doctor'=>'Dr. Natnael Assefa','dept'=>'Pediatrics','time'=>'10:00 AM','status'=>'waiting','type'=>'Vaccination'],
            ['id'=>'APT-4826','patient'=>'Daniel Teklu','doctor'=>'Dr. Feven Tadesse','dept'=>'Dermatology','time'=>'10:00 AM','status'=>'waiting','type'=>'New Patient'],
            ['id'=>'APT-4827','patient'=>'Liya Desta','doctor'=>'Dr. Dawit Mekonnen','dept'=>'Orthopedics','time'=>'10:30 AM','status'=>'waiting','type'=>'Follow-up'],
            ['id'=>'APT-4828','patient'=>'Solomon Alemu','doctor'=>'Dr. Selam Girma','dept'=>'Gynecology','time'=>'11:00 AM','status'=>'scheduled','type'=>'Ultrasound'],
            ['id'=>'APT-4829','patient'=>'Nardos Yohannes','doctor'=>'Dr. Natnael Assefa','dept'=>'Pediatrics','time'=>'11:00 AM','status'=>'scheduled','type'=>'Check-up'],
            ['id'=>'APT-4830','patient'=>'Bereket Haile','doctor'=>'Dr. Tigist Hailu','dept'=>'Cardiology','time'=>'11:30 AM','status'=>'scheduled','type'=>'ECG Test'],
        ];
    }

    // ─── Doctors on Duty ───
    public function getDoctorsOnDuty(): array
    {
        return [
            ['name' => 'Dr. Tigist Hailu', 'specialty' => 'Cardiology', 'patients' => 8, 'status' => 'consulting', 'avatar' => 'TH', 'color' => 'rose'],
            ['name' => 'Dr. Dawit Mekonnen', 'specialty' => 'Orthopedics', 'patients' => 6, 'status' => 'available', 'avatar' => 'DM', 'color' => 'blue'],
            ['name' => 'Dr. Selam Girma', 'specialty' => 'Gynecology', 'patients' => 7, 'status' => 'consulting', 'avatar' => 'SG', 'color' => 'purple'],
            ['name' => 'Dr. Natnael Assefa', 'specialty' => 'Pediatrics', 'patients' => 5, 'status' => 'break', 'avatar' => 'NA', 'color' => 'amber'],
            ['name' => 'Dr. Feven Tadesse', 'specialty' => 'Dermatology', 'patients' => 4, 'status' => 'available', 'avatar' => 'FT', 'color' => 'teal'],
            ['name' => 'Dr. Yared Abera', 'specialty' => 'Neurology', 'patients' => 6, 'status' => 'consulting', 'avatar' => 'YA', 'color' => 'indigo'],
            ['name' => 'Dr. Mimi Wolde', 'specialty' => 'ENT', 'patients' => 3, 'status' => 'available', 'avatar' => 'MW', 'color' => 'cyan'],
            ['name' => 'Dr. Ephrem Bekele', 'specialty' => 'General Surgery', 'patients' => 5, 'status' => 'in-surgery', 'avatar' => 'EB', 'color' => 'red'],
        ];
    }

    // ─── Department Stats ───
    public function getDepartmentStats(): array
    {
        return [
            ['name'=>'Cardiology','patients'=>24,'revenue'=>'$12,400','trend'=>+12,'icon'=>'heart'],
            ['name'=>'Orthopedics','patients'=>18,'revenue'=>'$9,800','trend'=>+8,'icon'=>'bone'],
            ['name'=>'Gynecology','patients'=>21,'revenue'=>'$11,200','trend'=>+5,'icon'=>'baby'],
            ['name'=>'Pediatrics','patients'=>15,'revenue'=>'$6,400','trend'=>-3,'icon'=>'child'],
            ['name'=>'Dermatology','patients'=>12,'revenue'=>'$5,100','trend'=>+15,'icon'=>'skin'],
            ['name'=>'Neurology','patients'=>16,'revenue'=>'$8,900','trend'=>+2,'icon'=>'brain'],
        ];
    }

    // ─── Patient Queue ───
    public function getPatientQueue(): array
    {
        return [
            ['queue_no'=>'Q-047','patient'=>'Meron Gebre','dept'=>'Pediatrics','wait_min'=>12,'priority'=>'normal'],
            ['queue_no'=>'Q-048','patient'=>'Daniel Teklu','dept'=>'Dermatology','wait_min'=>18,'priority'=>'normal'],
            ['queue_no'=>'Q-049','patient'=>'Liya Desta','dept'=>'Orthopedics','wait_min'=>25,'priority'=>'normal'],
            ['queue_no'=>'Q-050','patient'=>'Kidane Alemu','dept'=>'Cardiology','wait_min'=>8,'priority'=>'urgent'],
            ['queue_no'=>'Q-051','patient'=>'Aster Worku','dept'=>'General','wait_min'=>'—','priority'=>'emergency'],
            ['queue_no'=>'Q-052','patient'=>'Fikadu Tolossa','dept'=>'ENT','wait_min'=>5,'priority'=>'normal'],
        ];
    }

    // ─── Lab Results ───
    public function getRecentLabResults(): array
    {
        return [
            ['patient'=>'Abebe Kebede','test'=>'Complete Blood Count','status'=>'normal','time'=>'30 min ago'],
            ['patient'=>'Sara Ahmed','test'=>'X-Ray — Right Knee','status'=>'review','time'=>'45 min ago'],
            ['patient'=>'Hana Tadesse','test'=>'Blood Sugar (Fasting)','status'=>'critical','time'=>'1 hr ago'],
            ['patient'=>'Yonas Bekele','test'=>'Liver Function Test','status'=>'normal','time'=>'1.5 hr ago'],
            ['patient'=>'Meron Gebre','test'=>'Urinalysis','status'=>'normal','time'=>'2 hr ago'],
        ];
    }

      // ─── Bed Occupancy ───
    public function getWardStats(): array
    {
        return [
            ['ward'=>'General Ward','occupied'=>15,'total'=>20,'color'=>'teal'],
            ['ward'=>'ICU','occupied'=>4,'total'=>6,'color'=>'red'],
            ['ward'=>'Pediatric Ward','occupied'=>8,'total'=>10,'color'=>'amber'],
            ['ward'=>'Maternity','occupied'=>6,'total'=>9,'color'=>'purple'],
        ];
    }

    // ─── Hourly Patient Flow (24 bars) ───
    public function getHourlyFlow(): array
    {
        return [2,1,0,0,1,3,8,18,28,32,26,22,18,20,24,22,16,12,8,5,3,2,1,0];
    }

    public function getRefreshInterval(): int
    {
        return 30;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}