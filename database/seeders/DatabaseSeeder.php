<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Jpp;
use App\Models\JenisKurir;
use App\Models\Menu;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
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
        Admin::factory(2)->create();
        Trader::factory(5)->create();
        JenisKurir::factory(4)->create();
        Jpp::factory(50)->create();
        Menu::factory(8)->create();
        Ppk::factory(20)->create();
        KategoriDokumen::factory(1)->create();
    }
}
