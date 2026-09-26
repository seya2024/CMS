<?php

namespace App\Filament\Resources\Triages;

use App\Filament\Resources\Triages\Pages\CreateTriage;
use App\Filament\Resources\Triages\Pages\EditTriage;
use App\Filament\Resources\Triages\Pages\ListTriages;
use App\Filament\Resources\Triages\Pages\ViewTriage;
use App\Filament\Resources\Triages\Schemas\TriageForm;
use App\Filament\Resources\Triages\Schemas\TriageInfolist;
use App\Filament\Resources\Triages\Tables\TriagesTable;
use App\Models\Triage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TriageResource extends Resource
{
    protected static ?string $model = Triage::class;

    protected static ?string $recordTitleAttribute = 'Triage';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|\UnitEnum|null $navigationGroup = 'OPD';

    public static function form(Schema $schema): Schema
    {
        return TriageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TriageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TriagesTable::configure($table);
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
            'index' => ListTriages::route('/'),
            'create' => CreateTriage::route('/create'),
            'view' => ViewTriage::route('/{record}'),
            'edit' => EditTriage::route('/{record}/edit'),
        ];
    }
}
