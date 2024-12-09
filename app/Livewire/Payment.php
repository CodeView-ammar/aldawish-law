<?php

namespace Tasawk\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Notification;
use Tasawk\Enum\OrderPaymentStatus;
use Tasawk\Lib\Cart;
use Tasawk\Models\User;
use Tasawk\Notifications\Customer\ChangeOrderStatusNotification;
use Tasawk\Services\MyFatoorah;
use Tasawk\Settings\GeneralSettings;

class Payment extends Component {
    use WithFileUploads;

    public $order;
    public $bank_transfer_receipt;
    public $iban_number;
    public $account_number;
    public $payment_type;

    public function mount($order) {
        $this->order = $order;
    }

    public function getRules() {
        return [
            'payment_type' => 'required|in:visa,mada,pay,bank_transfer',
            'bank_transfer_receipt' => ['required_if:payment_type,bank_transfer'],
//            'iban_number' => ['required_if:payment_type,bank_transfer'],
//            'account_number' => ['required_if:payment_type,bank_transfer'],


        ];
    }

    public function getValidationAttributes() {
        return [
            'payment_type' => __('site.payment_type'),
            'bank_transfer_receipt' => __('site.bank_transfer_receipt'),
            'iban_number' => __('site.iban_number'),
            'account_number' => __('site.account_number'),
        ];
    }

    public function messages() {
        return [
            'bank_transfer_receipt.required_if' => __('validation.required', ['attribute' => __('site.bank_transfer_receipt')]),
            'iban_number.required_if' => __('validation.required', ['attribute' => __('site.iban_number')]),
            'account_number.required_if' => __('validation.required', ['attribute' => __('site.account_number')]),

        ];
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function submitForm() {
        $this->validate();
        /**
         * @var Cart $cart
         * */
        if ($this->payment_type == 'bank_transfer') {
            $this->order->update([
                'payment_type' => 'bank_transfer_receipt',
                'account_number' => $this->account_number,
                'iban_number' => $this->iban_number,
                'payment_status' => OrderPaymentStatus::PENDING,
                // 'payment_data' => $payment_data,
                'status' => 'pending',
            ]);
            $this->order->addMedia($this->bank_transfer_receipt)->toMediaCollection('bank_transfer_receipt');
            // }
            Notification::send($this->order->customer, new ChangeOrderStatusNotification($this->order->status->value, $this->order));
            Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new ChangeOrderStatusNotification($this->order->status->value, $this->order));
            return redirect()->route('site.order-details', $this->order);

        } else {
            $invoiceService = new \Moyasar\Providers\InvoiceService();
            $cart = app('cart');
            $cart->clear();
            $cart->applyService($this->order);
            $payment_status = OrderPaymentStatus::PENDING;
            $total = (int)app('cart')->getTotal() * 100;
            $payment_data = $invoiceService->create([
                'amount' => $total,
                'currency' => 'SAR',
                'description' => 'Consulting reservation',
                'callback_url' => route('webhooks.moyasar.callback'),
                'expired_at' => now()->addDays(4)->format("Y-m-d")
            ]);

            $this->order->update([
                'payment_type' => $this->payment_type,
                'payment_status' => $payment_status,
                'payment_data' => [
                    'invoiceURL' => $payment_data->url,
                    'invoiceId' => $payment_data->id
                ],
                'status' => 'pending',
            ]);
            Notification::send($this->order->customer, new ChangeOrderStatusNotification($this->order->status->value, $this->order));
            Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new ChangeOrderStatusNotification($this->order->status->value, $this->order));
            return redirect()->to($this->order->payment_data['invoiceURL']);
        }

    }

    public function render() {
        $setting = new GeneralSettings();

        return view('livewire.payment', compact('setting'));
    }
}
