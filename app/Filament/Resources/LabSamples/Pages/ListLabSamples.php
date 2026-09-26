<?php

namespace App\Filament\Resources\LabSamples\Pages;

use App\Filament\Resources\LabSamples\LabSampleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLabSamples extends ListRecords
{
    protected static string $resource = LabSampleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
