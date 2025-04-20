<?php

namespace Tasawk\Filament\Resources\CaseTypeResource\Pages;

use Tasawk\Filament\Resources\CaseTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCaseType extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
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
