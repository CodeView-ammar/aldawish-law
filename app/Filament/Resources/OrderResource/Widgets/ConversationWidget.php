<?php

namespace Tasawk\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\Widget;
use Livewire\Attributes\On;
use Tasawk\Models\Order;

class ConversationWidget extends Widget {
    protected int|string|array $columnSpan = 12;
    public $record;
    public bool $sessionRunning = false;
    protected static string $view = 'filament.components.conversation';

//public function __construct(public  Order $order) {
//}

    public function startSession() {
        $this->dispatch('startSession');
        $this->sessionRunning = true;
    }

    #[On('sessionClosed')]
    public function closeSession() {
        return $this->sessionRunning = false;
    }
}