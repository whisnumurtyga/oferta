<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            $a = rand(1000, 10000);
            $b = rand(1000, 10000);
            $year = Carbon::now()->subYears(rand(0,3))->year;
            $month = rand(1, 12);
            $day = rand(1, 31);

            DB::table('goods')->insert([
                'name' => $faker->word(),
                'category_id' => rand(1,4),
                'supplier_id' => rand(1,20),
                'stock' => rand(10,100),
                'buy' => ($a > $b) ? $b : $a,
                'sell' => ($a > $b) ? $a : $b,
                'date_in' => Carbon::create($year, $month, $day),
                'date_exp' => now(),
            ]);
        }
    }
}
