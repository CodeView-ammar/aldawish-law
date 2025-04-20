<?php

use Tasawk\Models\Order;
use Tasawk\Models\User;
use Tasawk\Notifications\Customer\PaidOrderNotification;

Route::any('webhooks/moyasar/callback', function () {
    Log::info('moyasar',request()->all());

    $response = request()->all();
    $order = Order::where('payment_data->invoiceId', $response['id'])->first();

    if ($response['status'] == 'paid') {
        $order->update([
            'payment_data' => array_merge($order->payment_data, [...collect($response)->toArray(), 'method' =>'visa', 'paid_at' => now()]),
            'payment_status' => 'paid',

        ]);
        Notification::send($order->customer, new PaidOrderNotification($order));
        Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new PaidOrderNotification($order));
    }


})->name('webhooks.moyasar.callback');
