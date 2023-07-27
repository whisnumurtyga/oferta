<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DetailTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1,   3) as $index) {
            $qty = random_int(1, 10);
            $unit_price = random_int(1000, 10000);

            DB::table('detail_transactions')->insert([
                'transaction_id' => random_int(1,25),
                'goods_id' => random_int(1,50),
                'qty' => $qty,
                'pay' => $unit_price * $qty,
                'profit' => random_int(5000, 100000) ,
            ]);
        }
    }
}
