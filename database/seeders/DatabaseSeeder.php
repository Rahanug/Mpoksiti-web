<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Trader;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * cara jalaninnya php artisan migrate:fresh --seed
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(1)->create();
        Trader::factory(5)->create();
    }
}
