<?php

namespace Tasawk\Filament\Resources\Pages\PagesResource\Pages;

use Tasawk\Filament\Resources\Pages\PagesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPages extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = PagesResource::class;
    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl("index");
    }

}
