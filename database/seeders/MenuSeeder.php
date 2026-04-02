<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $category = Category::create([
            'name' => 'Coffee',
            'slug' => 'coffee',
        ]);

        MenuItem::create([
            'category_id'  => $category->id,
            'name'         => 'Signature V60',
            'description'  => 'Bright and floral hand-pour with citrus finish.',
            'price'        => 4.50,
            'is_available' => true,
        ]);
        MenuItem::create([
            'category_id'  => $category->id,
            'name'         => 'Espresso',
            'description'  => 'Rich and bold with a velvety crema.',
            'price'        => 3.00,
            'is_available' => true,
        ]);

        
    }
}
