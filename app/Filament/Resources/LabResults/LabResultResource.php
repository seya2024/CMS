<?php

namespace App\Filament\Resources\LabResults;

use App\Filament\Resources\LabResults\Pages\CreateLabResult;
use App\Filament\Resources\LabResults\Pages\EditLabResult;
use App\Filament\Resources\LabResults\Pages\ListLabResults;
use App\Filament\Resources\LabResults\Pages\ViewLabResult;
use App\Filament\Resources\LabResults\Schemas\LabResultForm;
use App\Filament\Resources\LabResults\Schemas\LabResultInfolist;
use App\Filament\Resources\LabResults\Tables\LabResultsTable;
use App\Models\LabResult;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LabResultResource extends Resource
{
    protected static ?string $model = LabResult::class;

 
    protected static ?string $recordTitleAttribute = 'Lab Result';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|\UnitEnum|null $navigationGroup = 'Laboratory';


    public static function form(Schema $schema): Schema
    {
        return LabResultForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LabResultInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LabResultsTable::configure($table);
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
            'index' => ListLabResults::route('/'),
            'create' => CreateLabResult::route('/create'),
            'view' => ViewLabResult::route('/{record}'),
            'edit' => EditLabResult::route('/{record}/edit'),
        ];
    }
}
