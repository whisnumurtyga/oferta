<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\RolesSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\MembersSeeder;
use Database\Seeders\SuppliersSeeder;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\GoodsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UsersSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(MembersSeeder::class);
        $this->call(SuppliersSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(GoodsSeeder::class);
        $this->call(TransactionsSeeder::class);


    }

}
