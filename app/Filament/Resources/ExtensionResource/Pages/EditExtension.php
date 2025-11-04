<?php

namespace App\Filament\Resources\ExtensionResource\Pages;

use App\Filament\Resources\ExtensionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class EditExtension extends EditRecord
{
    protected static string $resource = ExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export_conf')
                ->label('Exportar Conf')
                ->icon('heroicon-o-document-duplicate')
                ->color('success')
                ->modalHeading('Vista previa de configuración')
                ->modalSubmitActionLabel('Cerrar')
                ->modalWidth('3xl')
                ->modalContent(function ($record) {
                    // 1️⃣ Leer plantilla base
                    $template = Storage::disk('local')->get('base.conf');

                    // 2️⃣ Reemplazar variables
                    $content = str_replace(
                        ['{{operador}}', '{{host}}', '{{puerto}}', '{{password}}', '{{numero}}'],
                        [
                            $record->operador ?? '',
                            $record->host ?? '',
                            $record->puerto ?? '',
                            $record->password ?? '',
                            $record->numero ?? '',
                        ],
                        $template
                    );

                    // 3️⃣ Devolver HTML renderizado (no Blade sin procesar)
                    return new HtmlString(view('filament.extension-preview', [
                        'content' => $content,
                    ])->render());
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
