<?php

namespace Tasawk\Livewire;

use Livewire\Component;
use Tasawk\Models\CancellationReason;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Validation\Rule;
use Tasawk\Models\Order;
use Tasawk\Notifications\Customer\OrderCancelNotification;
use Tasawk\Enum\OrderStatus;
use Notification;
use Tasawk\Notifications\Customer\ChangeOrderStatusNotification;
use Tasawk\Models\User;
class CancelOrder extends ModalComponent
{
    public $selected_reason;
    public $note;
    public $showTextarea = 'hidden';
    public $order;

    public function getValidationAttributes()
    {
        return [
            'selected_reason' => __('site.cancel_detect'),
            'note' => __('site.note_desc'),
        ];
    }
    public function getRules()
    {
        return [
            'selected_reason' => ['required'],
            'note' => [Rule::requiredIf($this->selected_reason == 'other')],
        ];
    }


    public function updatedSelectedReason($value)
    {
        $this->showTextarea = $value == 'other' ? '' : 'hidden';
    }


    public function handleReasonChange($value)
    {
        $this->updatedSelectedReason($value);
    }

    public function submit()
    {
        $order = Order::where('id',$this->order['id'])->first();
        $this->validate();
        $order->cancellation()->create([
            "order_id" => $order->id,
            "cancellation_reason_id" => $this->selected_reason == 'other' ? 0 : $this->selected_reason,
            "notes" => $this->note ?? null,
            'user_id' => auth()->guard('customer')->id(),

        ]);
        if($order->payment_status == 'paid'){
            auth()->user()->deposit($order->total->formatByDecimal());
        }
        $order->update(['status' => OrderStatus::REJECTED->value]);
        Notification::send($order->customer, new ChangeOrderStatusNotification($order->status->value, $order));
        Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new ChangeOrderStatusNotification($order->status->value, $order));
        $this->dispatch('closeModal');
        return redirect()->route('site.profile.myOrders');

    }

    public function render()
    {
        $cancel_resouns = CancellationReason::enabled()->get();
        return view('livewire.cancel-order', compact('cancel_resouns'));
    }

}
