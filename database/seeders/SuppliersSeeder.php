<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1,   50) as $index) {
            DB::table('suppliers')->insert([
                'name' => $faker->name,
                'phone' => "082" . $faker->randomNumber(9, true),
                'address' => $faker->address,
            ]);
        }
    }
}
