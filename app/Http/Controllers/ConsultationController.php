<?php

namespace Tasawk\Http\Controllers;

use Illuminate\Http\Request;
use Tasawk\Models\Order;

class ConsultationController extends Controller
{
    public function requestConsultation(){
        return view('site.pages.request-consultation');
    }

    public function consultationSuccess(){
        return view('site.pages.consultation-success');
    }

    public function myOrders(){
        $orders = Order::where('customer_id','2')->get();
        return view('site.pages.my-orders',compact('orders'));
    }

    public function orderDetails(Order $order){
        $order = Order::find($order->id);
        $status = $order->status->value;
        $class = '';
        if($status == 'new'){
            $class = 'new';
        }elseif($status == 'pending'){
            $class = 'current';
        }elseif($status == 'completed'){
            $class = 'completed';
        }elseif($status == 'cancelled'){
            $class = 'canceled';
        }
        return view('site.pages.order-details',compact('order','class'));
    }
}
