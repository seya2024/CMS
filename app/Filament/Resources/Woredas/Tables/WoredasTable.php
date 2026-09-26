<?php

namespace App\Filament\Resources\Woredas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class WoredasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // Woreda name
                TextColumn::make('name')
                    ->label('Woreda Name')
                    ->searchable()
                    ->sortable(),

                // Zone relation
                TextColumn::make('zone.name')
                    ->label('Zone')
                    ->sortable()
                    ->searchable(),

                // Region via zone (important hierarchy view)
                TextColumn::make('zone.region.name')
                    ->label('Region')
                    ->sortable()
                    ->toggleable(),

                // Description
                TextColumn::make('description')
                    ->limit(50)
                    ->toggleable()
                    ->placeholder('-'),

                // Created date
                TextColumn::make('created_at')
                    ->label('Created')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}