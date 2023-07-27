<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = ['Pending', 'Success', 'Cancelled'];

        foreach (range(0,   2) as $index) {
            DB::table('statuses')->insert([
                'name' => $status[$index]
            ]);
        }
    }
}
