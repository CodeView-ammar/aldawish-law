<?php

namespace Tasawk\Filament\Resources\CasePartyResource\Pages;

use Tasawk\Filament\Resources\CasePartyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCaseParty extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = CasePartyResource::class;
    protected function getHeaderActions(): array {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl("index");
    }
}
