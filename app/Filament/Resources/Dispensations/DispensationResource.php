<?php

namespace App\Filament\Resources\Dispensations;

use App\Filament\Resources\Dispensations\Pages\CreateDispensation;
use App\Filament\Resources\Dispensations\Pages\EditDispensation;
use App\Filament\Resources\Dispensations\Pages\ListDispensations;
use App\Filament\Resources\Dispensations\Pages\ViewDispensation;
use App\Filament\Resources\Dispensations\Schemas\DispensationForm;
use App\Filament\Resources\Dispensations\Schemas\DispensationInfolist;
use App\Filament\Resources\Dispensations\Tables\DispensationsTable;
use App\Models\Dispensation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DispensationResource extends Resource
{
    protected static ?string $model = Dispensation::class;


    protected static ?string $recordTitleAttribute = 'Dispensation';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|\UnitEnum|null $navigationGroup = 'OPD';

    public static function form(Schema $schema): Schema
    {
        return DispensationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DispensationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DispensationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDispensations::route('/'),
            'create' => CreateDispensation::route('/create'),
            'view' => ViewDispensation::route('/{record}'),
            'edit' => EditDispensation::route('/{record}/edit'),
        ];
    }
}
