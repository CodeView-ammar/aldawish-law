<?php

namespace Tasawk\Http\Controllers;


use Api;
use Tasawk\Models\Order;


class OrderServices {


    public function join(Order $order) {
        $join = request()->get('confirmed', 1);
        $order->generateVoiceCall();
        $column = $order->user_id == auth()->id() ? 'customer_start_at' : 'contractor_start_at';
        $order->conversation()->update(["is_started" => 1, $column => now()]);

        return Api::isOk(__("Joined"))->setData(
            array_merge(['agora_token' => $order->conversation->token,], $order->generateChatTokens())
        );
    }


    public function left(Order $order) {
        $column = $order->user_id == auth()->id() ? 'customer_end_at' : 'contractor_start_at';
        $order->conversation()->update([$column => now()]);
        return Api::isOk(__("Has left"));
    }

    public function end(Order $order) {

        if ($order->user_id == auth()->id()) {
            $order?->conversation()?->update(["finished_at" => now()]);
        }


        return Api::isOk(__("Session end"));
    }
}
