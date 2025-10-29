<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExtensionResource\Pages;
use App\Filament\Resources\ExtensionResource\RelationManagers;
use App\Models\Extension;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;

class ExtensionResource extends Resource
{
    protected static ?string $model = Extension::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('numero')->disabled(),
            TextInput::make('operador')
                ->label('Nombre del Operador')
                ->nullable(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('numero')
            ->label('Extensión')
                    ->sortable()
                    ->searchable(),
            TextColumn::make('operador')->label('Operador')->searchable(),
        ])
        ->filters([
            Filter::make('sin_operador')
                ->label('Sin operador asignado')
                ->query(fn ($query) => $query->whereNull('operador')),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([])
        ->paginationPageOptions([10, 25, 50, 100])
        ->defaultPaginationPageOption(50)
        ->headerActions([
        Tables\Actions\Action::make('buscarLibre')
            ->label('Buscar extensión libre')
            ->icon('heroicon-o-magnifying-glass')
            ->color('success')
            ->action(function () {
                $extensionLibre = \App\Models\Extension::whereNull('operador')->first();

                if ($extensionLibre) {
                    \Filament\Notifications\Notification::make()
                        ->title('Extensión libre encontrada')
                        ->body("La primera extensión libre es: {$extensionLibre->numero}")
                        ->success()
                        ->send();
                } else {
                    \Filament\Notifications\Notification::make()
                        ->title('No hay extensiones libres')
                        ->warning()
                        ->send();
                }
            }),
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
        'index' => Pages\ListExtensions::route('/'),
        'edit' => Pages\EditExtension::route('/{record}/edit'),
    ];
}
}
