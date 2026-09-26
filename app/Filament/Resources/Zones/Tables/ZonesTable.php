<?php

namespace App\Filament\Resources\Zones\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ZonesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // Zone name
                TextColumn::make('name')
                    ->label('Zone Name')
                    ->searchable()
                    ->sortable(),
                // Region (important for hierarchy)
                TextColumn::make('region.name')
                    ->label('Region')
                    ->searchable()
                    ->sortable(),
                // Woreda count (very useful in admin view)
                TextColumn::make('woredas_count')
                    ->label('Woredas')
                    ->counts('woredas')
                    ->sortable(),
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
