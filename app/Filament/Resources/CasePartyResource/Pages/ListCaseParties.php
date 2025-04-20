<?php

namespace Tasawk\Filament\Resources\CasePartyResource\Pages;

use Tasawk\Filament\Resources\CasePartyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaseParties extends ListRecords
{
    protected static string $resource = CasePartyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
