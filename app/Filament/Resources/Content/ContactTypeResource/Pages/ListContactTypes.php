<?php

namespace Tasawk\Filament\Resources\Content\ContactTypeResource\Pages;

use Tasawk\Filament\Resources\Content\ContactTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactTypes extends ListRecords
{
    protected static string $resource = ContactTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
