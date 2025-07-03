<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoria extends CreateRecord
{
    protected static string $resource = CategoriaResource::class;


    // al crear una nueva categoría, redirige a la lista de categorías
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // al crear una nueva categoría, muestra una notificación de éxito  
    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }

    // al crear una nueva categoría, muestra una notificación personalizada
    protected function afterCreate(){
        Notification::make()
            ->title('Categoría creada exitosamente')
            ->body('La categoría ha sido creada correctamente.')
            ->success()
            ->send();        
    }

    // funcion para cambiar color y texto los botones guardar, guardar y crear otro, cancelar
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
            ->label('Registrar')
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
