<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $major = ['Informatika', 'Data Science', 'Sistem Informasi'];
        $faculty = ['FTIB', 'FTEIC'];

        foreach (range(1,   50) as $index) {
            DB::table('members')->insert([
                'name' => $faker->name,
                'nim' => '12' . rand(100, 999) . rand(100, 999) . rand(10, 99),
                'major' => $major[array_rand($major)],
                'faculty' => $faculty[array_rand($faculty)],
                'year' => rand(2019, 2023),
            ]);
        }
    }
}
