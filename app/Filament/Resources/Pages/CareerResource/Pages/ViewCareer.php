<?php

namespace Tasawk\Filament\Resources\Pages\CareerResource\Pages;

use Tasawk\Filament\Resources\Pages\CareerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCareer extends ViewRecord
{
    protected static string $resource = CareerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
