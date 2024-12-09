<?php

namespace Tasawk\Filament\Resources\Pages\PagesResource\Pages;

use Tasawk\Filament\Resources\Pages\PagesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = PagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
