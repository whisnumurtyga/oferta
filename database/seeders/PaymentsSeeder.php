<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment = ['Kartu Debit/Kredit', 'QRIS', 'Cash'];

        foreach (range(0,   2) as $index) {
            DB::table('payments')->insert([
                'name' => $payment[$index]
            ]);
        }
    }
}
