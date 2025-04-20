<?php

namespace Tasawk\Filament\Resources\Pages\PagesResource\Pages;

use Tasawk\Filament\Resources\Pages\PagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;


class CreatePages extends CreateRecord
{

    use Translatable;
    protected static string $resource = PagesResource::class;

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
