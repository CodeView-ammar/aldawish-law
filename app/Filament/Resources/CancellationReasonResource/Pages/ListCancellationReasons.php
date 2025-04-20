<?php

namespace Tasawk\Filament\Resources\CancellationReasonResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Tasawk\Filament\Resources\CancellationReasonResource;

class ListCancellationReasons extends ListRecords
{
    protected static string $resource = CancellationReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
