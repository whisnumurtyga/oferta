<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1,   50) as $index) {
            DB::table('goods')->insert([
                'name' => $faker->word(),
                'category_id' => rand(1,4),
                'supplier_id' => rand(1,20),
                'stock' => rand(10,100),
                'buy' => $faker->numberBetween(1000, 25000),
                'sell' => $faker->numberBetween(1000, 50000),
                'date_in' => $faker->dateTime(),
                'date_exp' => now(),
            ]);
        }
    }
}
