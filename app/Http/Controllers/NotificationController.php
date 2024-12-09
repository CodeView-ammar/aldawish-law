<?php

namespace Tasawk\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Tasawk\Models\Notification;

class NotificationController extends BaseController {

    public function index() {
        $notifications = auth()->guard('customer')->user()?->notifications()?->latest()->get();
        auth()->guard('customer')->user()?->unreadNotifications->markAsRead();
        return view('site.pages.profile.notifications', get_defined_vars());
    }

    public function delete() {
        $notifications = auth()->guard('customer')->user()?->notifications()->get();

        foreach ($notifications as $notification) {
            $notification->delete();
        }

        return redirect()->route('site.profile.notifications');
    }
}
