<?php

namespace Tasawk\Filament\Resources\Content\FaqResource\Pages;

use Tasawk\Filament\Resources\Content\ContactTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Tasawk\Filament\Resources\Content\FaqResource;

class EditFaq extends EditRecord
{
    use EditRecord\Concerns\Translatable;

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
