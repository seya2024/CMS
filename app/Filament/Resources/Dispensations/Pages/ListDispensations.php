<?php

namespace App\Filament\Resources\Dispensations\Pages;

use App\Filament\Resources\Dispensations\DispensationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDispensations extends ListRecords
{
    protected static string $resource = DispensationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
