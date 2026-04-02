<?php

namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cart extends Model
{
    public $fillable = [
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
