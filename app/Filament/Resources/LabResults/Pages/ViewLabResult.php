<?php

namespace App\Filament\Resources\LabResults\Pages;

use App\Filament\Resources\LabResults\LabResultResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLabResult extends ViewRecord
{
    protected static string $resource = LabResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
