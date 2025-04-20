<?php

namespace Tasawk\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Tasawk\Models\Order;
use Tasawk\Models\CancellationReason;
use Tasawk\Settings\GeneralSettings;

class ProfileOrderView extends Component {
    public Order $order;
    public bool $sessionRunning = false;
    public function render() {
        $setting = New GeneralSettings();
        $cancel_resouns = CancellationReason::enabled()->get();
        return view('livewire.profile-order-view',compact('cancel_resouns','setting'));
    }
    public function startSession() {
        $this->dispatch('startSession');
        $this->sessionRunning = true;
    }
    #[On('sessionClosed')]
    public function closeSession() {
        return $this->sessionRunning = false;
    }
}