<?php

namespace App\Filament\Resources\MovimientoResource\Pages;

use App\Filament\Resources\MovimientoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMovimiento extends CreateRecord
{
    protected static string $resource = MovimientoResource::class;

    // al crear un nuevo movimiento, redirige a la lista de movimientos
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }
    protected function afterCreate()
    {
        Notification::make()
            ->title('Movimiento creado exitosamente')
            ->body('El movimiento ha sido creado correctamente.')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        
        return[
            $this->getCreateFormAction()
                ->label('Registrar Movimiento')
                ->color('success')
                ->icon('heroicon-o-check'),

            $this->getCreateAnotherFormAction()
                ->label('Guardar y nuevo')
                ->color('warning')
                ->icon('heroicon-o-plus'),

            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger')
                ->icon('heroicon-o-x-circle'),
        ];
    }
}
