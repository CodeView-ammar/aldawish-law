<?php

namespace Tasawk\Filament\Resources\Pages\OurServicesResource\Pages;

use Tasawk\Filament\Resources\Pages\OurServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOurServices extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = OurServicesResource::class;
    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl("index");
    }
}
