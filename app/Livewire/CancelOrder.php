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
            // 'selected_reason' => ['required'],
            'note' => ['required'], // الحقل ملاحظات مطلوب دائمًا
        ];
    }

    public function submit()
    {
        $order = Order::where('id', $this->order['id'])->first();
        $this->validate(); // التأكد من صحة البيانات
        $order->cancellation()->create([
            "order_id" => $order->id,
            "cancellation_reason_id" =>  0,
            "notes" => $this->note ?? null,
            'user_id' => auth()->guard('customer')->id(),
        ]);

        if ($order->payment_status == 'paid') {
            auth()->user()->deposit($order->total->formatByDecimal());
        }

        $order->update(['status' => OrderStatus::REJECTED->value]);

        // إرسال الإشعارات
        Notification::send($order->customer, new ChangeOrderStatusNotification($order->status->value, $order));
        Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new ChangeOrderStatusNotification($order->status->value, $order));

        // إغلاق النافذة
        $this->dispatch('closeModal');
        return redirect()->route('site.profile.myOrders');
    }

    public function render()
    {
        $cancel_resouns = CancellationReason::enabled()->get();
        return view('livewire.cancel-order', compact('cancel_resouns'));
    }
}
