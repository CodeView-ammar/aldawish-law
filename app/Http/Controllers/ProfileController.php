<?php

namespace Tasawk\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Tasawk\Models\Order;
use Tasawk\Models\CancellationReason;


class ProfileController extends BaseController
{

    public function index()
    {
        return view('site.pages.profile.index', get_defined_vars());
    }

    public function editPassword()
    {
        return view('site.pages.profile.change_password', get_defined_vars());
    }

    public function myOrders()
    {
        $orders = Order::where('customer_id', auth()->guard('customer')->id())->latest()->get();
        return view('site.pages.my-orders', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        $order = Order::find($order->id);
        $cancel_resouns = CancellationReason::enabled()->get();
        return view('site.pages.order-details', compact('order','cancel_resouns'));
    }

    public function payments()
    {
        $payments = Order::where('customer_id', auth()->guard('customer')->id())->paid()->latest()->paginate();
        return view('site.pages.profile.payments', compact('payments'));
    }

    public function notifications()
    {
        return view('site.pages.profile.notifications', get_defined_vars());
    }

    public function logout()
    {
        auth()->guard('customer')->logout();
        return redirect()->route('login');
    }
}
