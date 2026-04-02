<?php

namespace App\Notifications\Bookings;

use App\Models\Bookings\TableBooking;
use Illuminate\Notifications\Notification;

class BookingStatusUpdated extends Notification
{
  public function __construct(public TableBooking $booking) {}

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toDatabase(object $notifiable): array
  {
    return [
      'booking_id' => $this->booking->id,
      'status'     => $this->booking->status,
      'message'    => "Your table booking on {$this->booking->date} has been {$this->booking->status}.",
    ];
  }
}
