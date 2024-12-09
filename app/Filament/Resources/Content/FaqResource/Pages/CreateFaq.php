<?php

namespace Tasawk\Filament\Resources\Content\FaqResource\Pages;

use Tasawk\Filament\Resources\Content\ContactTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Tasawk\Filament\Resources\Content\FaqResource;

class CreateFaq extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = FaqResource::class;
    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl("index");
    }
}
