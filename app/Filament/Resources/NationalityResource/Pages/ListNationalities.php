<?php

namespace Tasawk\Filament\Resources\NationalityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Tasawk\Filament\Resources\NationalityResource;

class ListNationalities extends ListRecords
{
    protected static string $resource = NationalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
