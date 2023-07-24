<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $categories = ['Snack', 'Kudapan', 'Gorengan', 'Makanan', 'Minuman'];

        foreach (range(0,   4) as $index) {
            DB::table('categories')->insert([
                'name' => $categories[$index],
            ]);
        }
    }
}
