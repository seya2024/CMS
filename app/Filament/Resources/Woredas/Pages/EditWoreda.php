<?php

namespace App\Filament\Resources\Woredas\Pages;

use App\Filament\Resources\Woredas\WoredaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWoreda extends EditRecord
{
    protected static string $resource = WoredaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
