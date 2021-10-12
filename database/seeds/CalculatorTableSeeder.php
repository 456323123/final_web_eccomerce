<?php

use App\Calculator;
use Illuminate\Database\Seeder;

class CalculatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecord = [
            ['id' => 1, 'width' => "12", "length" => "45", "result" => "none"],

        ];
        Calculator::insert($sectionRecord);
    }

}
