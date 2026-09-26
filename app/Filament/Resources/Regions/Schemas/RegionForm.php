<?php

namespace App\Filament\Resources\Regions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class RegionForm
{
public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Region Name')
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