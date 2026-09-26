<?php

namespace App\Filament\Resources\Woredas\Pages;

use App\Filament\Resources\Woredas\WoredaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWoredas extends ListRecords
{
    protected static string $resource = WoredaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
