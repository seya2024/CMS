<?php

namespace App\Filament\Resources\Patients\Pages;

use App\Filament\Resources\Patients\PatientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
              CreateAction::make()
                ->label('Add Patient')
                ->createAnother(true)
                ->outlined()
                  ->size('sm')
                 ->icon('heroicon-o-plus')
                 //->authorize(fn ($record = null) => app(\App\Policies\BasePolicy::class)->create(Filament::auth()->user(), $record ?? ATM::class)),

        ];
    }
}
