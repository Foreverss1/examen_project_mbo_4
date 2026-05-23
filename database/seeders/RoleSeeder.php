<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $roles = [
                ['id' => 1, 'name' => 'admin'],
                ['id' => 2, 'name' => 'mederker'],
                ['id' => 3, 'name' => 'klant'],
            ];

            DB::table('roles')->insert($roles);
    }
}
