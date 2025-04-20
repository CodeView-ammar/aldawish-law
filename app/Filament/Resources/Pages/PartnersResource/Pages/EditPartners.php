<?php

namespace Tasawk\Filament\Resources\Pages\PartnersResource\Pages;

use Tasawk\Filament\Resources\Pages\PartnersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditPartners extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = PartnersResource::class;
    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl("index");
    }

}
