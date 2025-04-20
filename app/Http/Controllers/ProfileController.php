<?php

namespace Tasawk\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Tasawk\Models\Order;
use Tasawk\Models\CancellationReason;
use Tasawk\Models\Pages\TopBar; // تأكد من استيراد نموذج TopBar

class ProfileController extends BaseController
{
    protected function getTopBars() {
        return TopBar::where('status', 1)->get(); // جلب بيانات topBars
    }

    public function index()
    {
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.profile.index', compact('topBars')); // تمرير topBars إلى العرض
    }

    public function editPassword()
    {
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.profile.change_password', compact('topBars')); // تمرير topBars إلى العرض
    }

    public function myOrders()
    {
        $orders = Order::where('customer_id', auth()->guard('customer')->id())->latest()->get();
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.my-orders', compact('orders', 'topBars')); // تمرير topBars إلى العرض
    }

    public function orderDetails(Order $order)
    {
        $order = Order::find($order->id);
        $cancel_resouns = CancellationReason::enabled()->get();
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.order-details', compact('order', 'cancel_resouns', 'topBars')); // تمرير topBars إلى العرض
    }

    public function payments()
    {
        $payments = Order::where('customer_id', auth()->guard('customer')->id())->paid()->latest()->paginate();
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.profile.payments', compact('payments', 'topBars')); // تمرير topBars إلى العرض
    }

    public function notifications()
    {
        $topBars = $this->getTopBars(); // جلب بيانات topBars
        return view('site.pages.profile.notifications', compact('topBars')); // تمرير topBars إلى العرض
    }

    public function logout()
    {
        auth()->guard('customer')->logout();
        return redirect()->route('login');
    }
}