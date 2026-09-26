<?php

namespace App\Filament\Resources\Dispensations\Pages;

use App\Filament\Resources\Dispensations\DispensationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDispensation extends ViewRecord
{
    protected static string $resource = DispensationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
