<?php

namespace Tasawk\Filament\Resources\Pages\OurServicesResource\Pages;

use Tasawk\Filament\Resources\Pages\OurServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateOurServices extends CreateRecord
{
    use Translatable;
    protected static string $resource = OurServicesResource::class;

    protected function getHeaderActions(): array
    {

        return [
            Actions\LocaleSwitcher::make(),
        ];
    }


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl("index");
    }

}
