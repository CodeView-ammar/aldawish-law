<?php

namespace Tasawk\Http\Controllers;

use Illuminate\Http\Request;
use Tasawk\Models\Order;
use Tasawk\Models\Pages\TopBar; // تأكد من استيراد نموذج TopBar
class ConsultationController extends Controller
{
    protected function getTopBars() {
        return TopBar::where('status', 1)->get(); // جلب بيانات topBars
    }
    public function requestConsultation(){
        $topBars = $this->getTopBars();
        return view('site.pages.request-consultation',compact('topBars'));
    }

    public function consultationSuccess(){
        $topBars = $this->getTopBars();
        return view('site.pages.consultation-success',compact('topBars'));
    }

    public function paymentSuccess(){
        $topBars = $this->getTopBars();
        return view('site.pages.payment-success',compact('topBars'));
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
