<?php

namespace App\Filament\Resources\MovimientoResource\Pages;

use App\Filament\Resources\MovimientoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditMovimiento extends EditRecord
{
    protected static string $resource = MovimientoResource::class;

      // al editar una categoría, redirige a la lista de categorías
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // al editar una categoría, muestra una notificación de éxito
    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    // al editar el movimiento, muestra una notificación personalizada
    protected function afterSave()
    {
        Notification::make()
            ->title('Movimiento se ha editado exitosamente')
            ->body('El movimiento ha sido editado correctamente.')
            ->success()
            ->send();        
    }
  

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title('Movimiento eliminado exitosamente')
                    ->body('El movimiento ha sido eliminado correctamente.')
                    ->success()
            ),
        ];
    }
}
