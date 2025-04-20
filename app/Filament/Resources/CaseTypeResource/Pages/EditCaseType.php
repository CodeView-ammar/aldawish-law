<?php

namespace Tasawk\Filament\Resources\CaseTypeResource\Pages;

use Tasawk\Filament\Resources\CaseTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaseType extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = CaseTypeResource::class;

    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),

        ];
    }
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl("index");
    }
}
