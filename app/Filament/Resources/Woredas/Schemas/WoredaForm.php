<?php

namespace App\Filament\Resources\Woredas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Models\Zone;

class WoredaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('zone_id')
                ->label('Zone')
                ->options(Zone::pluck('name', 'id'))
                ->searchable()
                ->required(),

            TextInput::make('name')
                ->label('Woreda Name')
                ->required()
                ->maxLength(100)
                ->unique(ignoreRecord: true),

            TextInput::make('description')
                ->label('Description')
                ->nullable()
                ->columnSpanFull(),
        ]);
    }
}