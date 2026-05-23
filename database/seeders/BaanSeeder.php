<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banen = [
            ['id' => 1,'hekjes' => '0'],
            ['id' => 2,'hekjes' => '0'],
            ['id' => 3,'hekjes' => '1'],
            ['id' => 4,'hekjes' => '1'],
            ['id' => 5,'hekjes' => '1'],
            ['id' => 6,'hekjes' => '1'],
            ['id' => 7,'hekjes' => '1'],
            ['id' => 8,'hekjes' => '1'],

        ];

        DB::table('banen')->insert($banen);
    }
}
