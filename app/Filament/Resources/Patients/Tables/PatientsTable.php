<?php

namespace App\Filament\Resources\Patients\Tables;

use App\Models\Patient;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // MRN (key identifier)
                TextColumn::make('mrn')
                    ->label('MRN')
                    ->searchable()
                    ->sortable(),

                // Full name (computed accessors recommended)
             TextColumn::make('full_name')
            ->label('Full Name')
            ->getStateUsing(fn ($record) =>
                trim($record->first_name . ' ' . $record->father_name . ' ' . $record->grandfather_name)
            )
            ->searchable(
                query: fn ($query, $search) => $query
                    ->where('first_name', 'like', "%{$search}%")
                    ->orWhere('father_name', 'like', "%{$search}%")
                    ->orWhere('grandfather_name', 'like', "%{$search}%")
            ),
                // Sex
                BadgeColumn::make('sex')
                    ->colors([
                        'primary' => 'Male',
                        'danger' => 'Female',
                    ]),

                // Date of birth
                TextColumn::make('dob')
                    ->label('DOB')
                    ->date()
                    ->sortable()
                     ->searchable()->toggleable(isToggledHiddenByDefault: true),

                // Age (computed from model accessor)
                TextColumn::make('age_display')
                    ->label('Age')
                    ->sortable(),
                // Phone
                TextColumn::make('phone')
                    ->searchable()
                    ->toggleable()
                     ->toggleable(isToggledHiddenByDefault: true),

                // Region / Zone / Woreda (relations)
                TextColumn::make('region.name')
                    ->label('Region')
                     ->searchable()
                    ->sortable(),

                TextColumn::make('zone.name')
                    ->label('Zone')
                     ->searchable()
                    ->toggleable(),

                TextColumn::make('woreda.name')
                    ->label('Woreda')
                     ->searchable()
                    ->toggleable(),

                // Status
                BadgeColumn::make('is_active')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive')
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ]),

                // Created date
                TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime()
                    ->sortable()
                     ->searchable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->label('Profile'),
                EditAction::make()->label('Edit'),
                DeleteAction::make()->label('Delete'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}