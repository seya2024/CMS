<?php

namespace App\Filament\Resources\LabResults\Pages;

use App\Filament\Resources\LabResults\LabResultResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLabResult extends EditRecord
{
    protected static string $resource = LabResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
