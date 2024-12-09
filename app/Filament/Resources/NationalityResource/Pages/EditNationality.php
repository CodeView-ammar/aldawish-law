<?php

namespace Tasawk\Filament\Resources\NationalityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Tasawk\Filament\Resources\NationalityResource;

class EditNationality extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = NationalityResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),

        ];
    }
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl("index");
    }
}
