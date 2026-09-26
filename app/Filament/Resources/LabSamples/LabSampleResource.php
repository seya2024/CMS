<?php

namespace App\Filament\Resources\LabSamples;

use App\Filament\Resources\LabSamples\Pages\CreateLabSample;
use App\Filament\Resources\LabSamples\Pages\EditLabSample;
use App\Filament\Resources\LabSamples\Pages\ListLabSamples;
use App\Filament\Resources\LabSamples\Pages\ViewLabSample;
use App\Filament\Resources\LabSamples\Schemas\LabSampleForm;
use App\Filament\Resources\LabSamples\Schemas\LabSampleInfolist;
use App\Filament\Resources\LabSamples\Tables\LabSamplesTable;
use App\Models\LabSample;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LabSampleResource extends Resource
{
    protected static ?string $model = LabSample::class;


    protected static ?string $recordTitleAttribute = 'LabSample';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;
    protected static string|\UnitEnum|null $navigationGroup = 'Laboratory';

    public static function form(Schema $schema): Schema
    {
        return LabSampleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LabSampleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LabSamplesTable::configure($table);
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
            'index' => ListLabSamples::route('/'),
            'create' => CreateLabSample::route('/create'),
            'view' => ViewLabSample::route('/{record}'),
            'edit' => EditLabSample::route('/{record}/edit'),
        ];
    }
}
