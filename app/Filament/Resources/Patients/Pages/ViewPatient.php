<?php

namespace App\Filament\Resources\Patients\Pages;

use App\Filament\Resources\Patients\PatientResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;

class ViewPatient extends ViewRecord
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
{
    return [
        Action::make('close')
            ->label('Close')
            ->outlined()
            ->size('sm')
            ->icon('heroicon-o-x-mark')
            ->color('primary')
            ->url(route('filament.admin.resources.patients.index')),

Action::make('check-in')
    ->label('Check In')
    ->outlined()
    ->size('sm')
    ->icon('heroicon-o-user')
    ->color('primary')
    ->requiresConfirmation()
    ->modalHeading('Check In Patient')
    ->modalDescription('Please confirm patient check-in')
    ->modalSubmitActionLabel('Confirm Check In')
    ->modalCancelActionLabel('Cancel')
    ->form([
        TextInput::make('notes')
            ->label('Notes (Optional)')
            ->placeholder('Add any check-in notes...'),
        Select::make('priority')
            ->label('Priority')
            ->options([
                'normal' => 'Normal',
                'VIP' => 'VIP',
                'emergency' => 'Emergency',
            ])
            ->default('normal'),
    ])
    ->action(function (array $data) {
        // Process check-in with $data['notes'] and $data['priority']
        
        // Redirect after action
        return redirect()->route('filament.admin.resources.patients.index');
    }),
    

             Action::make('check-out')
            ->label('Check Out')
            ->outlined()
            ->size('sm')
            ->icon('heroicon-o-user')
            ->color('danger')
            ->url(route('filament.admin.resources.patients.index'))
    ];
}


   public function getTitle(): string
    {
        return ''; 
    }

    // public static function shouldRegisterNavigation(): bool
    // {
    //     // return Filament::auth()->user()?->role === 'super-admin';
    //     return in_array(Filament::auth()->user()?->role, ['super-admin','head','manager']);
    // }
}
