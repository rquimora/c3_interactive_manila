<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $soap = Category::catname('Soaps')->first();
        $toothpaste = Category::catname('Toothpaste')->first();

        Brand::insert([
            [
              'name' => 'Safeguard',
              'category_id' => $soap->id,  
            ],
            [
                'name' => 'Dove',
                'category_id' => $soap->id,  
            ],
            [
                'name' => 'Colgate',
                'category_id' => $toothpaste->id,  
            ],
            [
                'name' => 'Unique',
                'category_id' => $toothpaste->id,  
            ],
        ]);
    }
}
