<?php

namespace Tasawk\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Tasawk\Models\Pages\TopBar; // تأكد من استيراد نموذج TopBar
use Tasawk\Models\Notification;

class NotificationController extends BaseController {

    protected function getTopBars() {
        return TopBar::where('status', 1)->get(); // جلب بيانات topBars
    }

    public function index() {
        $notifications = auth()->guard('customer')->user()?->notifications()?->latest()->get();
        auth()->guard('customer')->user()?->unreadNotifications->markAsRead();

        $topBars = $this->getTopBars(); // جلب بيانات topBars

        return view('site.pages.profile.notifications', compact('notifications', 'topBars')); // تمرير topBars إلى العرض
    }

    public function delete() {
        $notifications = auth()->guard('customer')->user()?->notifications()->get();

        foreach ($notifications as $notification) {
            $notification->delete();
        }

        return redirect()->route('site.profile.notifications');
    }
}