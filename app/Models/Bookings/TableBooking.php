<?php

namespace App\Models\Bookings;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TableBooking extends Model
{
    public $fillable = [
        'user_id',
        'date',
        'time',
        'guests',
        'status',
        'notes'

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
