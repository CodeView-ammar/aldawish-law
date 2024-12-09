<?php

namespace Tasawk\Filament\Resources\OrderResource\Pages;

use Tasawk\Enum\OrderStatus;
use Tasawk\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Tasawk\Filament\Resources\OrderResource\Widgets\ConversationWidget;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Tasawk\Models\Order;
use Notification;
use Tasawk\Notifications\Customer\ChangeOrderStatusNotification;
use Tasawk\Models\User;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;
    protected function getHeaderWidgets(): array
    {
        return [
            ConversationWidget::make(['order' => $this->getRecord()]),

        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
            
        ];
    }
}
