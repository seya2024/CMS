<?php

namespace App\Filament\Resources\Woredas;

use App\Filament\Resources\Woredas\Pages\CreateWoreda;
use App\Filament\Resources\Woredas\Pages\EditWoreda;
use App\Filament\Resources\Woredas\Pages\ListWoredas;
use App\Filament\Resources\Woredas\Schemas\WoredaForm;
use App\Filament\Resources\Woredas\Tables\WoredasTable;
use App\Models\Woreda;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WoredaResource extends Resource
{
    protected static ?string $model = Woreda::class;
    protected static ?string $recordTitleAttribute = 'Woreda';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';



    public static function form(Schema $schema): Schema
    {
        return WoredaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WoredasTable::configure($table);
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
            'index' => ListWoredas::route('/'),
           // 'create' => CreateWoreda::route('/create'),
           //'edit' => EditWoreda::route('/{record}/edit'),
        ];
    }
}
