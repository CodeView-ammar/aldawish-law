<?php

namespace Tasawk\Livewire;

use LivewireUI\Modal\ModalComponent;
use Tasawk\Models\Order;
use Livewire\WithFileUploads;


class BankTransferModal extends ModalComponent
{
    use WithFileUploads;
    public $order;
    public $bank_transfer_receipt;

    public function getValidationAttributes()
    {
        return [
            'bank_transfer_receipt' => __('site.bank_transfer_receipt'),
        ];
    }
    public function getRules()
    {
        return [
            'bank_transfer_receipt' => ['required'],
        ];
    }
    public function submit()
    {
        $order = Order::where('id', $this->order['id'])->first();
        $this->validate();
        if ($this->bank_transfer_receipt) {
            $order->addMedia($this->bank_transfer_receipt)->toMediaCollection('bank_transfer_receipt');
        }
        $this->dispatch('closeModal');
        // return redirect()->route('site.profile.myOrders');

    }

    public function render()
    {
        return view('livewire.bank-transfer-modal');
    }
}
