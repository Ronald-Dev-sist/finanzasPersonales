<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Mockery\Matcher\Not;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

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

    // al editar una categoría, muestra una notificación personalizada
    protected function afterSave(){
        Notification::make()
            ->title('Categoría se ha editado exitosamente')
            ->body('La categoría ha sido editada correctamente.')
            ->success()
            ->send();        
    }

    
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->title('Categoría eliminada exitosamente')
                        ->body('La categoría ha sido eliminada correctamente.')
                        ->success()
                ),
                
        ];

    }

    
}
