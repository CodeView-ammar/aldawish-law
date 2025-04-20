<?php

namespace Tasawk\Notifications\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Tasawk\Lib\Firebase;
use Tasawk\Lib\NotificationMessageParser;
use Tasawk\Models\DeviceToken;
use Tasawk\Models\Order;

class NewOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     */
    private  Order $order;
    public function __construct(Order $order)
    {
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
            ->setMoreData([ 'entity_type' => 'order',
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
            'viewData' => [ 'entity_type' => 'order',
            'entity_id' => $this->order->id],
            'duration' => 'persistent'
        ];
    }
    public function getTitle($notifiable)
    {
        return NotificationMessageParser::init($notifiable)
            ->customerMessage('panel.messages.new_order')
            ->parse();
    }
    public function getBody($notifiable)
    {
        return NotificationMessageParser::init($notifiable)
            ->customerMessage('panel.messages.description_new_order:order_id',[
                'order_id' => $this->order->id
            ])
            ->parse();
    }
}

