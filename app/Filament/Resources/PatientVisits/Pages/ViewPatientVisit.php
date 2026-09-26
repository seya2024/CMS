<?php

namespace App\Filament\Resources\PatientVisits\Pages;

use App\Filament\Resources\PatientVisits\PatientVisitResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPatientVisit extends ViewRecord
{
    protected static string $resource = PatientVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
