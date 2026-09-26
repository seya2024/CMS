<?php

namespace App\Filament\Resources\Triages\Pages;

use App\Filament\Resources\Triages\TriageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTriage extends EditRecord
{
    protected static string $resource = TriageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
