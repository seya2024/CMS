<?php

namespace App\Filament\Resources\LabOrders;

use App\Filament\Resources\LabOrders\Pages\CreateLabOrder;
use App\Filament\Resources\LabOrders\Pages\EditLabOrder;
use App\Filament\Resources\LabOrders\Pages\ListLabOrders;
use App\Filament\Resources\LabOrders\Pages\ViewLabOrder;
use App\Filament\Resources\LabOrders\Schemas\LabOrderForm;
use App\Filament\Resources\LabOrders\Schemas\LabOrderInfolist;
use App\Filament\Resources\LabOrders\Tables\LabOrdersTable;
use App\Models\LabOrder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LabOrderResource extends Resource
{
    protected static ?string $model = LabOrder::class;


    protected static ?string $recordTitleAttribute = 'Lab Result';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|\UnitEnum|null $navigationGroup = 'Laboratory';


    public static function form(Schema $schema): Schema
    {
        return LabOrderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LabOrderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LabOrdersTable::configure($table);
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
            'index' => ListLabOrders::route('/'),
            'create' => CreateLabOrder::route('/create'),
            'view' => ViewLabOrder::route('/{record}'),
            'edit' => EditLabOrder::route('/{record}/edit'),
        ];
    }
}
