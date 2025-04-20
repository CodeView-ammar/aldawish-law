<?php

namespace Tasawk\Filament\Resources\Pages\OurServicesResource\Pages;

use Tasawk\Filament\Resources\Pages\OurServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOurServices extends ListRecords
{
    protected static string $resource = OurServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
