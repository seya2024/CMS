<?php

namespace App\Filament\Resources\Dispensations\Pages;

use App\Filament\Resources\Dispensations\DispensationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDispensation extends EditRecord
{
    protected static string $resource = DispensationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
