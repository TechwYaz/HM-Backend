<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Catalog\MenuItem;

class Category extends Model
{

    public $fillable = ['name', 'slug'];
    public   function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
};
