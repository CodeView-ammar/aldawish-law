<?php

namespace Tasawk\Filament\Resources\Pages\CareerResource\Pages;

use Tasawk\Filament\Resources\Pages\CareerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareers extends ListRecords
{
    protected static string $resource = CareerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
