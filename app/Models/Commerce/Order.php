<?php

namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Commerce\OrderItem;

class Order extends Model
{
    public $fillable = [
        'user_id',
        'status',
        'total',
        'address',
        'phone',
        'notes',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
