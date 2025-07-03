<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimientoResource\Pages;
use App\Filament\Resources\MovimientoResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Movimiento;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovimientoResource extends Resource
{
    protected static ?string $model = Movimiento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make('Llene los campos del formulario')
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Usuarios')
                    ->required()
                    ->options(User::all()->pluck('name', 'id')),

                Forms\Components\Select::make('categoria_id')
                    ->label('Categoría')
                    ->required()
                    ->options(Categoria::all()->pluck('nombre', 'id')), 

                Forms\Components\Select::make('tipo')
                    ->options([
                    'ingreso' => 'Ingreso',
                    'gasto' => 'Gasto'])
                    ->required(),

                Forms\Components\TextInput::make('monto')
                    ->required()
                    ->numeric(),

                Forms\Components\RichEditor::make('descripcion')
                    ->required()
                    ->label('Descripción')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('foto')
                    ->label('foto')
                    ->image()
                    ->disk('public')
                    ->directory('movimientos')
                    ->default(null),
                Forms\Components\DatePicker::make('fecha')
                    ->required(),
            ])->columns(2)
        ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')                    
                    ->label('Nro')
                    ->rowIndex()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable()
                    ->label('Usuario')
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->numeric()
                    ->searchable()
                    ->label('categoría')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->searchable()
                    ->sortable()
                    ->label('Tipo Movimiento'),
                Tables\Columns\TextColumn::make('monto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->limit(50)
                    ->html()
                    ->searchable()
                    ->sortable(),

                
                // para ver la imagen se requiere php artisan storage:link
                Tables\Columns\ImageColumn::make('foto')
                    ->searchable()
                    ->height('100px')
                    ->width('100px'),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // filtar por el nombre de la categoria en un select
                // el pluck sirve para obtener un array con el nombre de la categoria y el id
                SelectFilter::make('categoria_id')
                    ->label('Filtrar por categoría')
                    ->options(Categoria::all()->pluck('nombre', 'id'))
                    ->searchable()
                    ->placeholder('Todas las categorías'),
           

                SelectFilter::make('tipo')
                    ->label('Filtrar por tipo de movimiento')
                    ->options([
                        'ingreso' => 'Ingreso',
                        'gasto' => 'Gasto',
                    ])   
                    ->searchable()                 
                    ->placeholder('Todos los tipos'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->button()
                    ->color('primary'),
                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->color('danger')
                    ->requiresConfirmation()
                    ->successNotification(
                    Notification::make()
                            ->title('Movimiento eliminada exitosamente')
                            ->body('El Movimiento ha sido eliminada correctamente.')
                            ->success()
                ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovimientos::route('/'),
            'create' => Pages\CreateMovimiento::route('/create'),
            'edit' => Pages\EditMovimiento::route('/{record}/edit'),
        ];
    }
}
