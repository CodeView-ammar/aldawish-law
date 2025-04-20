<?php

namespace Tasawk\Notifications\Customer;

use Tasawk\Lib\Firebase;
use Tasawk\Models\Order;
use Tasawk\Enum\OrderStatus;
use Illuminate\Bus\Queueable;
use Tasawk\Models\DeviceToken;
use Tasawk\Lib\NotificationMessageParser;
use Illuminate\Notifications\Notification;

class ChangeOrderStatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     */

    private  $status;
    private $order;
    public function __construct($status, $order)
    {
        $this->status = $status;
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toFirebase($notifiable)
    {
        $tokens = DeviceToken::where('user_id', $notifiable->id)->pluck('token')->unique()->toArray();
        return Firebase::make()
            ->setTokens($tokens)
            ->setTitle($this->getTitle($notifiable)[$notifiable->preferredLocale()])
            ->setBody($this->getBody($notifiable)[$notifiable->preferredLocale()])
            ->setMoreData(['entity_type' => 'order',
            'entity_id' => $this->order->id])
            ->do();
    }
    public function toArray($notifiable): array
    {
        $this->toFirebase($notifiable);
        return [
            'title' => json_encode($this->getTitle($notifiable)),
            'body' => json_encode($this->getBody($notifiable)),
            'format' => 'filament',
            'viewData' => ['entity_type' => 'order',
            'entity_id' => $this->order->id],
            'duration' => 'persistent'
        ];
    }
    public function getTitle($notifiable)
    {
        return NotificationMessageParser::init($notifiable)
            ->customerMessage('panel.messages.order_change')
            ->parse();
    }
    public function getBody($notifiable)
    {
        $body = '';
        if($this->order->status->value == OrderStatus::PENDING->value) {
            $body = "panel.enums.pending_order:order_id";
        }
        if($this->order->status->value == OrderStatus::COMPLETED->value) {
            $body = "panel.enums.complete_order:order_id";
        }
        if($this->order->status->value == OrderStatus::REJECTED->value) {
            $body = "panel.enums.rejected_order:order_id";
        }
        return NotificationMessageParser::init($notifiable)
            ->customerMessage($body,[
                'order_id' => $this->order->id
            ])
            ->parse();
    }

}

