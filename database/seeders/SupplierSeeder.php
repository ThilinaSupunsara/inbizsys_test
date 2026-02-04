<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 200) as $index) {
            DB::table('suppliers')->insert([

                'name' => Str::limit($faker->company, 255),


                'email' => $faker->unique()->companyEmail,


                'phone' => $faker->numerify('07########'),

                
                'address' => $faker->address,

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
