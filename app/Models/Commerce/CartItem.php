<?php

namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;
use App\Models\Catalog\MenuItem;
use App\Models\Commerce\Cart;

class CartItem extends Model
{
    public $fillable = [
        'cart_id',
        'menu_item_id',
        'quantity',

    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
