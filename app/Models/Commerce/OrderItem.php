<?php

namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;
use App\Models\Catalog\MenuItem;
use App\Models\Commerce\Order;

class OrderItem extends Model
{
    public $fillable = [
        'order_id',
        'menu_item_id',
        'quantity',
        'unit_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
