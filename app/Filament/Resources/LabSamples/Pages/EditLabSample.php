<?php

namespace App\Filament\Resources\LabSamples\Pages;

use App\Filament\Resources\LabSamples\LabSampleResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLabSample extends EditRecord
{
    protected static string $resource = LabSampleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
