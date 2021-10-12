<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecord = [
            ['id' => 1, 'name' => "Hashpuupy", "Status" => 1],
              ['id' => 2, 'name' => "Arrow", "Status" => 1],

        ];
        Brand::insert($brandRecord);
    }
}
