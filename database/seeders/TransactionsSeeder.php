<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1,   50) as $index)
        {
            $a = rand(50000, 100000);
            $b = rand(50000, 100000);
            $year = Carbon::now()->subYears(rand(0,3))->year;
            $month = rand(1, 12);
            $day = rand(1, 31);
            $currentTime = Carbon::now()->format('H:i:s');

            DB::table('Transactions')->insert([
                'date' => Carbon::create($year, $month, $day, $currentTime),
                'user_id' => rand(1,25),
                'member_id' => rand(1,25),
                'total_pay' => ($a > $b) ? $b : $a,
                'total_profit' => ($a > $b) ? $a : $b,
                'status_id' => rand(1,3),
                'payment_id' => rand(1,4)
            ]);
        }
    }
}
