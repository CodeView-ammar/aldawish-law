<?php

namespace Tasawk\Filament\Resources\Content\FaqResource\Pages;

use Tasawk\Filament\Resources\Content\ContactTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Tasawk\Filament\Resources\Content\FaqResource;

class ListFaq extends ListRecords
{
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
