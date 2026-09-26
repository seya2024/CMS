<?php

namespace App\Filament\Resources\Regions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class RegionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // Region name
                TextColumn::make('name')
                    ->label('Region Name')
                    ->searchable()
                    ->sortable(),

                // Description (optional)
                TextColumn::make('description')
                    ->limit(50)
                    ->toggleable()
                    ->placeholder('-'),

                // Zones count (important for governance view)
                TextColumn::make('zones_count')
                    ->label('Zones')
                    ->counts('zones')
                    ->sortable(),

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