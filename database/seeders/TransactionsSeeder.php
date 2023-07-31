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
    public function run()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $i = 0;

        // Seed data 7 tahun ke belakang
        for ($year = $currentYear - 7; $year <= $currentYear; $year++) {
            if($year == $currentYear) {
                $currentMonth -= 2;
            }

            for ($month = 1; $month <= $currentMonth; $month++) {
                $daysInMonth = Carbon::createFromDate($year, $month)->daysInMonth;

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $a = rand(50000, 100000);
                    $b = rand(50000, 100000);
                    $currentTime = Carbon::now()->format('H:i:s');
                    list($hour, $minute, $second) = explode(':', $currentTime);
                    $role_kode = ['ADM', 'OWN', 'KSR'];

                    DB::table('Transactions')->insert([
                        'order_id' => $role_kode[array_rand($role_kode)] . "-" . rand(1, 50) . "-" . rand(11, 100),
                        'date' => Carbon::create($year, $month, $day)->setTime($hour, $minute, $second),
                        'user_id' => rand(1, 25),
                        'member_id' => rand(1, 25),
                        'total_pay' => ($a > $b) ? $b : $a,
                        'total_profit' => ($a > $b) ? $a : $b,
                        'status_id' => rand(1, 3),
                        'payment_id' => rand(1, 3)
                    ]);
                }
            }
        }



        // Seed data untuk tahun dan bulan saat ini
        $daysInCurrentMonth = Carbon::createFromDate($currentYear, $currentMonth)->daysInMonth;
        $currentMonth += 2;
        for ($day = 1; $day <= 28; $day++) {
            $a = rand(50000, 100000);
            $b = rand(50000, 100000);
            $currentTime = Carbon::now()->format('H:i:s');
            list($hour, $minute, $second) = explode(':', $currentTime);
            $role_kode = ['ADM', 'OWN', 'KSR'];

            DB::table('Transactions')->insert([
                'order_id' => $role_kode[array_rand($role_kode)] . "-" . rand(1, 50) . "-" . rand(11, 100),
                'date' => Carbon::create($currentYear, $currentMonth, $day)->setTime($hour, $minute, $second),
                'user_id' => rand(1, 25),
                'member_id' => rand(1, 25),
                'total_pay' => ($a > $b) ? $b : $a,
                'total_profit' => ($a > $b) ? $a : $b,
                'status_id' => rand(1, 3),
                'payment_id' => rand(1, 3)
            ]);
        }
    }
}
