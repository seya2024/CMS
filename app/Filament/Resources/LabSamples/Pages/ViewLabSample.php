<?php

namespace App\Filament\Resources\LabSamples\Pages;

use App\Filament\Resources\LabSamples\LabSampleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLabSample extends ViewRecord
{
    protected static string $resource = LabSampleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
