<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_settings')->insert([
            'name' => 'inbizsys',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
