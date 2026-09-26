<?php

namespace App\Filament\Resources\PatientVisits\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;

class PatientVisitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('patient.name')
                    ->label('Patient')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('check_in_time')
                    ->label('Check In Time')
                    ->dateTime('d-M-Y H:i')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('check_out_time')
                    ->label('Check Out Time')
                    ->dateTime('d-M-Y H:i')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                BadgeColumn::make('visit_type')
                    ->label('Visit Type')
                    ->colors([
                        'primary' => 'regular',
                        'success' => 'emergency',
                        'warning' => 'follow-up',
                        'danger' => 'urgent',
                        'info' => 'consultation',
                    ])
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('doctor.name')
                    ->label('Doctor')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('department.name')
                    ->label('Department')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('checker.name')
                    ->label('Checked By')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d-M-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d-M-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}