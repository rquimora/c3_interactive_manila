<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $safeguard = Brand::brandname('Safeguard')->first();
        $dove = Brand::brandname('Dove')->first();

        Variant::insert([
            [
                'name' => 'Green',
                'brand_id' => $safeguard->id,
            ],
            [
                'name' => 'Red',
                'brand_id' => $safeguard->id,
            ],
            [
                'name' => 'Blue',
                'brand_id' => $safeguard->id,
            ],
            [
                'name' => 'Pink',
                'brand_id' => $safeguard->id,
            ],
            [
                'name' => 'Black',
                'brand_id' => $safeguard->id,
            ],
            [
                'name' => 'Green',
                'brand_id' => $dove->id,
            ],
            [
                'name' => 'Red',
                'brand_id' => $dove->id,
            ],
        ]);
    }
}
