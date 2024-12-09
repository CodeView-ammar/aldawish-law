<?php

namespace Tasawk\Filament\Resources\CancellationReasonResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Tasawk\Filament\Resources\CancellationReasonResource;

class ViewCancellationReason extends ViewRecord
{
    protected static string $resource = CancellationReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
