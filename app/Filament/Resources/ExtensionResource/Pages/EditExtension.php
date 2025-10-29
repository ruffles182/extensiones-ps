<?php

namespace App\Filament\Resources\ExtensionResource\Pages;

use App\Filament\Resources\ExtensionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExtension extends EditRecord
{
    protected static string $resource = ExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }

    //tal vez esto se vaya... 
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
