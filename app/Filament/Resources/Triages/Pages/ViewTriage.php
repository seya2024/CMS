<?php

namespace App\Filament\Resources\Triages\Pages;

use App\Filament\Resources\Triages\TriageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTriage extends ViewRecord
{
    protected static string $resource = TriageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
