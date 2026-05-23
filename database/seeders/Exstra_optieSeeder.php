<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Exstra_optieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['naam' => 'Snackpakket_basis', 'omschrijving' => '', 'cost' => 7.50],
            ['naam' => 'Snackpakket_luxe', 'omschrijving' => '', 'cost' => 10.00],
            ['naam' => 'Snackpakket', 'omschrijving' => 'chips, cola en verrassing', 'cost' => 6.50 ],
            ['naam' => 'Vrijgezellenfeest ', 'omschrijving' => '4 consumpties', 'cost' => 15.00],
            ['naam' => 'geen ', 'omschrijving' => ' ', 'cost' => 15.00],
        ];

        DB::table('exstra_opties')->insert($options);
    }

}

