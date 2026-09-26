<?php

namespace App\Filament\Resources\Zones\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Models\Region;

class ZoneForm
{

public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('region_id')
                ->label('Region')
                ->options(Region::pluck('name', 'id'))
                ->searchable()
                ->required(),

            TextInput::make('name')
                ->label('Zone Name')
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