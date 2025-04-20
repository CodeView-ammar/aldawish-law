<?php

namespace Tasawk\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Notification;
use Tasawk\Enum\OrderPaymentStatus;
use Tasawk\Enum\OrderStatus; // ✅ استيراد OrderStatus
use Tasawk\Models\User;
use Tasawk\Notifications\Customer\ChangeOrderStatusNotification;
use Tasawk\Services\MyFatoorah;
use Tasawk\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Tasawk\Actions\SendTextMessageAction;
use Moyasar\Providers\InvoiceService;
use Carbon\Carbon;

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
        ];
    }

    public function messages()
    {
        return [
            'bank_transfer_receipt.required_if' => 'الرجاء إرفاق صورة إيصال التحويل البنكي.',
        ];
    }
    
    public function submitForm() {
        $this->validate();
        session()->put('previous_url', url()->previous());

        if ($this->payment_type == 'bank_transfer') {
            // 🔹 عند الدفع عبر التحويل البنكي، الطلب يصبح PENDING
            $this->order->update([
                'payment_type' => 'bank_transfer_receipt',
                'account_number' => $this->account_number,
                'iban_number' => $this->iban_number,
                'payment_status' => OrderPaymentStatus::PENDING,
                'status' => OrderStatus::PENDING->value, // ✅ مطابق للقيم الموجودة في OrderStatus
            ]);

            $this->order->addMedia($this->bank_transfer_receipt)->toMediaCollection('bank_transfer_receipt');

            Notification::send($this->order->customer, new ChangeOrderStatusNotification($this->order->status->value, $this->order));

            return redirect()->route('site.order-details', $this->order);
        } else {
            // 🔹 معالجة الدفع عبر Moyasar
            $invoiceService = new InvoiceService();
            $cart = app('cart');
            $cart->clear();
            $cart->applyService($this->order);

            $total = (int)app('cart')->getTotal() * 100;
            $previousUrl = session()->get('previous_url', route('site.order-details', $this->order));

            $payment_data = $invoiceService->create([
                'amount' => $total,
                'currency' => 'SAR',
                'description' => 'Consulting reservation',
                'callback_url' => route('webhooks.moyasar.callback', ['order_id' => $this->order->id]),
                'expired_at' => now()->addDays(4)->format("Y-m-d"),
                "back_url" => $previousUrl
            ]);

            if (!$payment_data || !isset($payment_data->id)) {
                return redirect()->back()->withErrors(['error' => 'فشل إنشاء الفاتورة']);
            }

            $this->order->update([
                'payment_type' => $this->payment_type,
                'payment_status' => OrderPaymentStatus::PENDING,
                'payment_data' => [
                    'invoiceURL' => $payment_data->url,
                    'invoiceId' => $payment_data->id
                ],
                'status' => OrderPaymentStatus::PENDING,
            ]);
            return redirect()->to($payment_data->url);
        }
    }

    public function handleMoyasarCallback(Request $request) {
        $orderId = $request->query('order_id');
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('site.home')->withErrors(['error' => 'الطلب غير موجود']);
        }
        
        $invoiceService = new InvoiceService();
        $invoice = $invoiceService->fetch($order->payment_data['invoiceId']);

        if ($invoice && isset($invoice->status)) {
            switch ($invoice->status) {
                case 'paid':
                    $order->update([
                        'payment_status' => OrderPaymentStatus::PAID,
                        'status' => OrderStatus::COMPLETED->value, // ✅ الطلب مكتمل بعد الدفع
                    ]);
                    Notification::send($order->customer, new ChangeOrderStatusNotification($order->status->value, $order));
                    return redirect()->route('site.order-details', $order)->with('success', 'تم الدفع بنجاح');

                case 'refunded':
                    $order->update([
                        'payment_status' => OrderPaymentStatus::REFUNDED,
                        'status' => OrderStatus::REJECTED->value, // ✅ رفض الطلب عند استرداد المبلغ
                    ]);
                    return redirect()->route('site.order-details', $order)->with('info', 'تم استرداد المبلغ.');

                case 'canceled':
                    $order->update([
                        'payment_status' => OrderPaymentStatus::CANCELED,
                        'status' => OrderStatus::REJECTED->value, // ✅ الطلب مرفوض عند الإلغاء
                    ]);
                    return redirect()->route('site.order-details', $order)->with('warning', 'تم إلغاء الطلب.');

                case 'expired':
                    $order->update([
                        'payment_status' => OrderPaymentStatus::EXPIRED,
                        'status' => OrderStatus::REJECTED->value, // ✅ الطلب مرفوض عند انتهاء صلاحية الفاتورة
                    ]);
                    return redirect()->route('site.order-details', $order)->with('error', 'انتهت صلاحية الفاتورة.');

                default:
                    return redirect()->route('site.order-details', $order)->withErrors(['error' => 'لم يتم الدفع بعد']);
            }
        }

        return redirect()->route('site.order-details', $order)->withErrors(['error' => 'حدث خطأ غير متوقع.']);
    }

    public function render() {
        $setting = new GeneralSettings();
        return view('livewire.payment', compact('setting'));
    }
}
