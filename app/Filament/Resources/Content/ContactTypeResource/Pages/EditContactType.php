<?php

namespace Tasawk\Filament\Resources\Content\ContactTypeResource\Pages;

use Tasawk\Filament\Resources\Content\ContactTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactType extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ContactTypeResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl("index");
    }
}
