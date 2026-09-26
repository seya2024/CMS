<?php

namespace App\Filament\Resources\Patients\Schemas;

use Carbon\Carbon;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;

class PatientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(4)->schema([

                /* ================= LEFT PROFILE ================= */
                Section::make('Profile')->schema([
                    ImageEntry::make('photo')
                        ->label(false)
                        ->imageHeight(200)
                        ->getStateUsing(fn ($record) =>
                            $record->photo
                                ? asset('storage/' . $record->photo)
                                : asset('images/avator.png')
                        ),

                    TextEntry::make('mrn')->label('MRN'),

                    TextEntry::make('full_name')
                        ->label('Full Name')
                        ->getStateUsing(fn ($record) =>
                            "{$record->first_name} {$record->father_name} {$record->grandfather_name}"
                        ),

                    TextEntry::make('sex'),

                    TextEntry::make('dob')
                        ->label('Date of Birth')
                        ->date(),

                    TextEntry::make('age')
                        ->label('Age')
                        ->getStateUsing(fn ($record) =>
                            $record->dob
                                ? Carbon::parse($record->dob)->age
                                : null
                        ),
                ])->columnSpan(1),

                /* ================= RIGHT CONTENT ================= */
                Section::make()->schema([

                    Tabs::make('Patient Tabs')->tabs([

                        Tab::make('Overview')
                            ->icon('heroicon-m-user')
                            ->schema([

                                Section::make('Contact Information')->schema([
                                    TextEntry::make('phone'),
                                    TextEntry::make('email'),
                                    TextEntry::make('national_id')->label('National ID'),
                                ])->columns(3),

                                Section::make('Address')->schema([
                                    TextEntry::make('region.name')->label('Region')->default('-'),
                                    TextEntry::make('zone.name')->label('Zone')->default('-'),
                                    TextEntry::make('woreda.name')->label('Woreda')->default('-'),
                                    TextEntry::make('kebele'),
                                    TextEntry::make('house_no')->label('House No'),
                                ])->columns(3),

                                Section::make('Emergency Contact')->schema([
                                    TextEntry::make('emergency_contact_name')->label('Name'),
                                    TextEntry::make('emergency_contact_phone')->label('Phone'),
                                ])->columns(2),
                            ]),

Tab::make('Visits')
    ->badge(fn ($record) => $record->visits()->count())
    ->icon('heroicon-m-calendar-days')
    ->schema([
        
        TextEntry::make('visits_empty')
            ->label('')
            ->default('No visit records available.')
            ->visible(fn ($record) => $record->visits()->count() === 0)
            ->color('gray'),

        /* ================= LATEST VISIT (Always Open) ================= */
        Section::make()
         ->heading(function ($record) {
    $latest = $record->visits()->first();
    if (!$latest) return 'Latest Visit';
    $date = \Carbon\Carbon::parse($latest->check_in_time)->format('M d, Y h:i A');
    return "Latest Visit [{$date}]";
})
            ->visible(fn ($record) => $record->visits()->count() > 0)
            ->schema([
                Grid::make(4)->schema([
                    TextEntry::make('latest_visit_type')
                        ->label('Visit Type')
                        ->badge()
                        ->getStateUsing(fn ($record) => $record->visits()->first()?->visit_type)
                        ->color(fn (string $state): string => match ($state) {
                            'OPD' => 'success',
                            'Emergency' => 'danger',
                            'Follow-up' => 'info',
                            default => 'gray',
                        }),

                    TextEntry::make('latest_check_in')
                        ->label('Check-In')
                        ->getStateUsing(fn ($record) => 
                            \Carbon\Carbon::parse($record->visits()->first()->check_in_time)->format('M d, Y h:i A')
                        ),

                    TextEntry::make('latest_check_out')
                        ->label('Check-Out')
                        ->getStateUsing(function ($record) {
                            $out = $record->visits()->first()->check_out_time;
                            return empty($out) ? '—' : \Carbon\Carbon::parse($out)->format('M d, Y h:i A');
                        }),

                    TextEntry::make('latest_department')
                        ->label('Department')
                        ->getStateUsing(fn ($record) => $record->visits()->first()?->department?->name ?? '-'),
                ]),

                Grid::make(3)->schema([
                    TextEntry::make('latest_doctor')
                        ->label('Doctor')
                        ->getStateUsing(fn ($record) => $record->visits()->first()?->doctor?->name ?? 'Not Assigned'),

                    TextEntry::make('latest_checker')
                        ->label('Checked-In By')
                        ->getStateUsing(fn ($record) => $record->visits()->first()?->checker?->name ?? '-'),

                    TextEntry::make('latest_status')
                        ->label('Status')
                        ->badge()
                        ->getStateUsing(fn ($record) => 
                            !empty($record->visits()->first()->check_out_time) ? 'Completed' : 'Active'
                        )
                        ->color(fn (string $state): string => match ($state) {
                            'Completed' => 'gray',
                            'Active' => 'success',
                            default => 'gray',
                        }),
                ]),

                TextEntry::make('latest_duration')
                    ->label('Duration')
                    ->icon('heroicon-m-clock')
                    ->getStateUsing(function ($record) {
                        $visit = $record->visits()->first();
                        if (empty($visit->check_out_time)) {
                            return 'Ongoing';
                        }
                        return \Carbon\Carbon::parse($visit->check_in_time)
                            ->diffForHumans(\Carbon\Carbon::parse($visit->check_out_time), true);
                    }),
            ]),

        /* ================= OLDER VISITS (Always Collapsed) ================= */
        RepeatableEntry::make('older_visits')
            ->label('Previous Encounters')
            ->visible(fn ($record) => $record->visits()->count() > 1)
            ->getStateUsing(fn ($record) => 
                $record->visits()
                    ->get()
                    ->skip(1)
                    ->unique('id')
                    ->values()
                    ->toArray()
            )
            ->schema([
                Section::make()
                    ->heading(fn ($record) => 
                        "Visit Details [" . \Carbon\Carbon::parse($record['check_in_time'])->format('M d, Y h:i A') . "]"
                    )
                    ->collapsed()
                    ->schema([
                        Grid::make(4)->schema([
                            TextEntry::make('visit_type')
                                ->label('Visit Type')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'OPD' => 'success',
                                    'Emergency' => 'danger',
                                    'Follow-up' => 'info',
                                    default => 'gray',
                                }),

                            TextEntry::make('check_in_time')
                                ->label('Check-In')
                                ->dateTime('M d, Y h:i A'),

                            TextEntry::make('check_out_time')
                                ->label('Check-Out')
                                ->formatStateUsing(function ($state) {
                                    if (empty($state)) return '—';
                                    return \Carbon\Carbon::parse($state)->format('M d, Y h:i A');
                                }),

                            TextEntry::make('department.name')
                                ->label('Department')
                                ->default('-'),
                        ]),

                        Grid::make(3)->schema([
                            TextEntry::make('doctor.name')
                                ->label('Doctor')
                                ->default('Not Assigned'),

                            TextEntry::make('checker.name')
                                ->label('Checked-In By')
                                ->default('-'),

                            TextEntry::make('visit_status')
                                ->label('Status')
                                ->badge()
                                ->getStateUsing(fn ($record) => 
                                    !empty($record['check_out_time']) ? 'Completed' : 'Active'
                                )
                                ->color(fn (string $state): string => match ($state) {
                                    'Completed' => 'gray',
                                    'Active' => 'success',
                                    default => 'gray',
                                }),
                        ]),

                        TextEntry::make('duration')
                            ->label('Duration')
                            ->icon('heroicon-m-clock')
                            ->getStateUsing(function ($record) {
                                if (empty($record['check_out_time'])) {
                                    return 'Ongoing';
                                }
                                return \Carbon\Carbon::parse($record['check_in_time'])
                                    ->diffForHumans(\Carbon\Carbon::parse($record['check_out_time']), true);
                            }),
                    ]),
            ]),
    ]),
                        /* ================= ADMISSION TAB ================= */
                        Tab::make('Admission')
                            ->badge(fn ($record) => $record->admissions?->count() ?? 0)
                            ->icon('heroicon-m-building-office-2')
                            ->schema([
                                TextEntry::make('admissions_empty')
                                    ->label('')
                                    ->default('No admission records available.')
                                    ->visible(fn ($record) => $record->admissions?->isEmpty() ?? true)
                                    ->color('gray'),

                                RepeatableEntry::make('admissions')
                                    ->schema([
                                        Section::make(fn ($record) =>
                                            "Admission #{$record->id}"
                                        )->schema([
                                            Grid::make(4)->schema([
                                                TextEntry::make('admission_date')
                                                    ->label('Admission Date')
                                                    ->date('M d, Y'),

                                                TextEntry::make('discharge_date')
                                                    ->label('Discharge Date')
                                                    ->date('M d, Y')
                                                    ->default('Ongoing'),

                                                TextEntry::make('ward.name')
                                                    ->label('Ward')
                                                    ->default('-'),

                                                TextEntry::make('bed.bed_number')
                                                    ->label('Bed')
                                                    ->default('-'),
                                            ]),

                                            Grid::make(3)->schema([
                                                TextEntry::make('admission_type')
                                                    ->label('Type')
                                                    ->badge()
                                                    ->color(fn (string $state): string => match ($state) {
                                                        'Emergency' => 'danger',
                                                        'Elective' => 'success',
                                                        'Urgent' => 'warning',
                                                        default => 'gray',
                                                    }),

                                                TextEntry::make('attending_doctor.name')
                                                    ->label('Attending Doctor')
                                                    ->default('-'),

                                                TextEntry::make('status')
                                                    ->label('Status')
                                                    ->badge()
                                                    ->color(fn (string $state): string => match ($state) {
                                                        'Admitted' => 'warning',
                                                        'Discharged' => 'success',
                                                        'Transferred' => 'info',
                                                        default => 'gray',
                                                    }),
                                            ]),

                                            Grid::make(2)->schema([
                                                TextEntry::make('diagnosis')
                                                    ->label('Primary Diagnosis')
                                                    ->default('-'),

                                                TextEntry::make('discharge_summary')
                                                    ->label('Discharge Summary')
                                                    ->default('-')
                                                    ->hidden(fn ($record) => empty($record->discharge_summary)),
                                            ]),
                                        ])->collapsed(),
                                    ])
                                    ->visible(fn ($record) => $record->admissions?->isNotEmpty() ?? false),
                            ]),

                        /* ================= PRESCRIPTION TAB ================= */
                        Tab::make('Prescription')
                            ->badge(fn ($record) => $record->prescriptions?->count() ?? 0)
                            ->icon('heroicon-m-document-text')
                            ->schema([
                                TextEntry::make('prescriptions_empty')
                                    ->label('')
                                    ->default('No prescriptions available.')
                                    ->visible(fn ($record) => $record->prescriptions?->isEmpty() ?? true)
                                    ->color('gray'),

                                RepeatableEntry::make('prescriptions')
                                    ->schema([
                                        Section::make(fn ($record) =>
                                            "Rx #{$record->id} - " . Carbon::parse($record->prescription_date)->format('M d, Y')
                                        )->schema([
                                            Grid::make(4)->schema([
                                                TextEntry::make('prescription_date')
                                                    ->label('Date')
                                                    ->date('M d, Y'),

                                                TextEntry::make('prescribing_doctor.name')
                                                    ->label('Prescribed By')
                                                    ->default('-'),

                                                TextEntry::make('status')
                                                    ->label('Status')
                                                    ->badge()
                                                    ->color(fn (string $state): string => match ($state) {
                                                        'Active' => 'success',
                                                        'Completed' => 'gray',
                                                        'Cancelled' => 'danger',
                                                        default => 'gray',
                                                    }),

                                                TextEntry::make('items_count')
                                                    ->label('Items')
                                                    ->getStateUsing(fn ($record) => $record->items?->count() ?? 0),
                                            ]),

                                            RepeatableEntry::make('items')
                                                ->label('Medications')
                                                ->schema([
                                                    Grid::make(5)->schema([
                                                        TextEntry::make('medication.name')
                                                            ->label('Medication')
                                                            ->weight('bold'),

                                                        TextEntry::make('dosage')
                                                            ->label('Dosage'),

                                                        TextEntry::make('frequency')
                                                            ->label('Frequency'),

                                                        TextEntry::make('duration')
                                                            ->label('Duration'),

                                                        TextEntry::make('instructions')
                                                            ->label('Instructions')
                                                            ->default('-'),
                                                    ]),
                                                ]),
                                        ])->collapsed(),
                                    ])
                                    ->visible(fn ($record) => $record->prescriptions?->isNotEmpty() ?? false),
                            ]),

                        /* ================= DISPENSING TAB ================= */
                        Tab::make('Dispensing')
                            ->badge(fn ($record) => $record->dispensings?->count() ?? 0)
                            ->icon('heroicon-m-beaker')
                            ->schema([
                                TextEntry::make('dispensings_empty')
                                    ->label('')
                                    ->default('No dispensing records available.')
                                    ->visible(fn ($record) => $record->dispensings?->isEmpty() ?? true)
                                    ->color('gray'),

                                RepeatableEntry::make('dispensings')
                                    ->schema([
                                        Section::make(fn ($record) =>
                                            "Dispense #{$record->id} - " . Carbon::parse($record->dispensed_at)->format('M d, Y')
                                        )->schema([
                                            Grid::make(4)->schema([
                                                TextEntry::make('dispensed_at')
                                                    ->label('Dispensed Date')
                                                    ->date('M d, Y'),

                                                TextEntry::make('dispensed_by.name')
                                                    ->label('Dispensed By')
                                                    ->default('-'),

                                                TextEntry::make('prescription_id')
                                                    ->label('Prescription #')
                                                    ->formatStateUsing(fn ($state) => "Rx #{$state}"),

                                                TextEntry::make('status')
                                                    ->label('Status')
                                                    ->badge()
                                                    ->color(fn (string $state): string => match ($state) {
                                                        'Dispensed' => 'success',
                                                        'Partial' => 'warning',
                                                        'Returned' => 'danger',
                                                        default => 'gray',
                                                    }),
                                            ]),

                                            RepeatableEntry::make('items')
                                                ->label('Dispensed Items')
                                                ->schema([
                                                    Grid::make(5)->schema([
                                                        TextEntry::make('medication.name')
                                                            ->label('Medication')
                                                            ->weight('bold'),

                                                        TextEntry::make('quantity')
                                                            ->label('Qty'),

                                                        TextEntry::make('batch_no')
                                                            ->label('Batch No'),

                                                        TextEntry::make('expiry_date')
                                                            ->label('Expiry')
                                                            ->date('M Y'),

                                                        TextEntry::make('notes')
                                                            ->label('Notes')
                                                            ->default('-'),
                                                    ]),
                                                ]),
                                        ])->collapsed(),
                                    ])
                                    ->visible(fn ($record) => $record->dispensings?->isNotEmpty() ?? false),
                            ]),

                        /* ================= APPOINTMENTS TAB ================= */
                        Tab::make('Appointments')
                            ->badge(fn ($record) => $record->appointments?->count() ?? 0)
                            ->icon('heroicon-m-clock')
                            ->schema([
                                TextEntry::make('appointments_empty')
                                    ->label('')
                                    ->default('No appointments available.')
                                    ->visible(fn ($record) => $record->appointments?->isEmpty() ?? true)
                                    ->color('gray'),

                                RepeatableEntry::make('appointments')
                                    ->schema([
                                        Section::make(fn ($record) =>
                                            "Appointment #{$record->id}"
                                        )->schema([
                                            Grid::make(4)->schema([
                                                TextEntry::make('appointment_date')
                                                    ->label('Date')
                                                    ->date('M d, Y'),

                                                TextEntry::make('appointment_time')
                                                    ->label('Time')
                                                    ->time('h:i A'),

                                                TextEntry::make('doctor.name')
                                                    ->label('Doctor')
                                                    ->default('-'),

                                                TextEntry::make('department.name')
                                                    ->label('Department')
                                                    ->default('-'),
                                            ]),

                                            Grid::make(3)->schema([
                                                TextEntry::make('appointment_type')
                                                    ->label('Type')
                                                    ->badge()
                                                    ->color(fn (string $state): string => match ($state) {
                                                        'New Visit' => 'info',
                                                        'Follow-up' => 'success',
                                                        'Consultation' => 'warning',
                                                        'Procedure' => 'danger',
                                                        default => 'gray',
                                                    }),

                                                TextEntry::make('status')
                                                    ->label('Status')
                                                    ->badge()
                                                    ->color(fn (string $state): string => match ($state) {
                                                        'Scheduled' => 'info',
                                                        'Confirmed' => 'success',
                                                        'Completed' => 'gray',
                                                        'Cancelled' => 'danger',
                                                        'No Show' => 'warning',
                                                        default => 'gray',
                                                    }),

                                                TextEntry::make('priority')
                                                    ->label('Priority')
                                                    ->badge()
                                                    ->color(fn (string $state): string => match ($state) {
                                                        'Urgent' => 'danger',
                                                        'High' => 'warning',
                                                        'Normal' => 'info',
                                                        'Low' => 'gray',
                                                        default => 'gray',
                                                    }),
                                            ]),

                                            TextEntry::make('reason')
                                                ->label('Reason')
                                                ->default('-')
                                                ->hidden(fn ($record) => empty($record->reason)),
                                        ])->collapsed(),
                                    ])
                                    ->visible(fn ($record) => $record->appointments?->isNotEmpty() ?? false),
                            ]),

                    ])//->vertical()
                    ->activeTab(1)->persistTabInQueryString()

                ])->columnSpan(3),

            ])->columnSpan('full'),
        ]);
    }
}