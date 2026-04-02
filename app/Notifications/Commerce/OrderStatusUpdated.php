<?php

namespace App\Notifications\Commerce;

use App\Models\Commerce\Order;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification
{
  public function __construct(public Order $order) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toDatabase(object $notifiable): array
  {
    return [
      'order_id' => $this->order->id,
      'status'   => $this->order->status,
      'message'  => "Your order #{$this->order->id} status changed to {$this->order->status}.",
    ];
  }
}
