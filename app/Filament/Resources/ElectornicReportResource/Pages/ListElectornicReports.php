<?php

namespace Tasawk\Filament\Resources\ElectornicReportResource\Pages;

use Tasawk\Filament\Resources\ElectornicReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListElectornicReports extends ListRecords
{
    protected static string $resource = ElectornicReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}