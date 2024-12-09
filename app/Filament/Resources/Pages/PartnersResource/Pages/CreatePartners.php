<?php

namespace Tasawk\Filament\Resources\Pages\PartnersResource\Pages;

use Tasawk\Filament\Resources\Pages\PartnersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use Tasawk\Enum\PageStatus;
use Tasawk\Enum\SectionStatus;
class CreatePartners extends CreateRecord
{
    use Translatable;
    protected static string $resource = PartnersResource::class;

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
