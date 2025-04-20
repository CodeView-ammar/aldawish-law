<?php

namespace Tasawk\Filament\Resources\CaseTypeResource\Pages;

use Tasawk\Filament\Resources\CaseTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaseTypes extends ListRecords
{
    protected static string $resource = CaseTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
