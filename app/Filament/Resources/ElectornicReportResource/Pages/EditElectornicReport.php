<?php

namespace Tasawk\Filament\Resources\ElectornicReportResource\Pages;

use Tasawk\Filament\Resources\ElectornicReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditElectornicReport extends EditRecord
{
    protected static string $resource = ElectornicReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}