<?php

namespace Tasawk\Filament\Resources\ElectornicReportResource\Pages;

use Tasawk\Filament\Resources\ElectornicReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Tasawk\Filament\Resources\OrderResource\Widgets\ConversationWidget;

class ViewElectornicReport extends ViewRecord
{
    protected static string $resource = ElectornicReportResource::class;


    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}