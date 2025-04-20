<?php

namespace Tasawk\Console\Commands;

use Illuminate\Console\Command;
use Tasawk\Models\CourseSubscription;
use Notification;
use Tasawk\Notifications\ExpireCourseSubscription;
use Tasawk\Models\Notification as NotificationModel;
use Tasawk\Models\Order;
use Carbon\Carbon; // Import the Carbon class
use Tasawk\Models\User;
use Tasawk\Notifications\Customer\ChangeOrderStatusNotification;


class ChangeStatusOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-status-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command For Change Status Order';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::where('status', 'pending')->get();
        foreach ($orders as $order) {

            $end_date = Carbon::parse($order->date)->addMinutes($order->duration);
            if (carbon::now() > $end_date) {
                $order->status = 'completed';
                $order->save();
            }
            $last_notifications = NotificationModel::where(['type' => 'Tasawk\Notifications\Customer\ChangeOrderStatusNotification', 'notifiable_id' => $order->customer_id])->first();
            if ($last_notifications) {
                continue;
            } else {
                Notification::send($order->customer, new ChangeOrderStatusNotification($order->status->value, $order));
                Notification::send(User::whereHas("roles", fn($q) => $q->where('name', 'super_admin'))->first(), new ChangeOrderStatusNotification($order->status->value, $order));
            }
        }

    }
}
