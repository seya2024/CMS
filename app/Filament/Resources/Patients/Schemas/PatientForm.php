<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Schemas\Schema;
use App\Models\Region;
use App\Models\Zone;
use App\Models\Woreda;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Filament\Forms\Components\DateTimePicker;


class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
                
                // --------------------
                // STEP 1: Identity
                // --------------------
                Step::make('Patient Identity')
                    ->schema([
                        TextInput::make('mrn')
                            ->label('MRN')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->hidden()
                            ->dehydrated(),

                        TextInput::make('first_name')
                            ->trim()
                            ->required()
                            ->maxLength(100)
                            // 1. VISUAL: Change text to uppercase as they type
                            ->extraAlpineAttributes(['@input' => '$event.target.value = $event.target.value.toUpperCase()'])
                            // 2. BACKEND: Guarantee uppercase in database
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state ?? '')),

                        TextInput::make('father_name')
                            ->trim()
                            ->maxLength(100)
                            ->required()
                            ->extraAlpineAttributes(['@input' => '$event.target.value = $event.target.value.toUpperCase()'])
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state ?? '')),

                        TextInput::make('grandfather_name')
                            ->maxLength(100)
                            ->nullable()
                            ->extraAlpineAttributes(['@input' => '$event.target.value = $event.target.value.toUpperCase()'])
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state ?? '')),

                        Select::make('sex')
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                            ])
                            ->required(),

                        DateTimePicker::make('dob')
                        ->displayFormat('d/m/Y H:i')
                            ->required(),
                    ])
                    ->columns(2),

                // --------------------
                // STEP 2: Address (MPI core part)
                // --------------------
                Step::make('Address Information')
                    ->schema([
                        Select::make('region_id')
                            ->label('Region')
                            ->options(Region::pluck('name', 'id'))
                            ->searchable()
                            ->live()
                            ->required(),

                        Select::make('zone_id')
                            ->label('Zone')
                            ->options(fn ($get) =>
                                Zone::where('region_id', $get('region_id'))
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->live()
                            ->required(),

                        Select::make('woreda_id')
                            ->label('Woreda')
                            ->options(fn ($get) =>
                                Woreda::where('zone_id', $get('zone_id'))
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->required(),

                        TextInput::make('kebele')
                            ->nullable(),

                        TextInput::make('house_no')
                            ->nullable(),
                    ])
                    ->columns(2),

                // --------------------
                // STEP 3: Contact & Identity
                // --------------------
                Step::make('Contact Information')
                    ->schema([
                        TextInput::make('phone')
                            ->required()
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->nullable(),

                        TextInput::make('national_id')
                            ->length(16)
                            ->label('FAN')
                            ->helperText('Fayda Alias Number (National ID)')
                            ->nullable(),

                        TextInput::make('email')
                            ->email()
                            ->label('Email Address')
                            ->nullable(),

                        TextInput::make('emergency_contact_name')
                            ->label('ECN')
                            ->helperText('Emergency Contact Name')
                            ->nullable(),

                        TextInput::make('emergency_contact_phone')
                            ->helperText('Emergency Contact Phone')
                            ->label('ECP')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->nullable(),
                    ])
                    ->columns(2),
            ])
            ->skippable(false)
            ->columnSpanFull(),
        ]);
    }
}