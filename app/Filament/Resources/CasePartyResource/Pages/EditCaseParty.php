<?php

namespace Tasawk\Filament\Resources\CasePartyResource\Pages;

use Tasawk\Filament\Resources\CasePartyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaseParty extends EditRecord
{
    use EditRecord\Concerns\Translatable;

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
