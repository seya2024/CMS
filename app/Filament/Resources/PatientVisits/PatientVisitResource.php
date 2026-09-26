<?php

namespace App\Filament\Resources\PatientVisits;

use App\Filament\Resources\PatientVisits\Pages\CreatePatientVisit;
use App\Filament\Resources\PatientVisits\Pages\EditPatientVisit;
use App\Filament\Resources\PatientVisits\Pages\ListPatientVisits;
use App\Filament\Resources\PatientVisits\Pages\ViewPatientVisit;
use App\Filament\Resources\PatientVisits\Schemas\PatientVisitForm;
use App\Filament\Resources\PatientVisits\Schemas\PatientVisitInfolist;
use App\Filament\Resources\PatientVisits\Tables\PatientVisitsTable;
use App\Models\PatientVisit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PatientVisitResource extends Resource
{
    protected static ?string $model = PatientVisit::class;

  
    protected static ?string $recordTitleAttribute = 'Patient Visit';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|\UnitEnum|null $navigationGroup = 'OPD';

    public static function form(Schema $schema): Schema
    {
        return PatientVisitForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PatientVisitInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PatientVisitsTable::configure($table);
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
            'index' => ListPatientVisits::route('/'),
            'create' => CreatePatientVisit::route('/create'),
            'view' => ViewPatientVisit::route('/{record}'),
            'edit' => EditPatientVisit::route('/{record}/edit'),
        ];
    }
}
