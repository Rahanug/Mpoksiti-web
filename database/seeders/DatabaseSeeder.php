<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\JenisKurir;
use App\Models\Jpp;
use App\Models\JPPNotif;
use App\Models\KategoriDokumen;
use App\Models\Menu;
use App\Models\Notif;
use App\Models\tbRTrader;
use App\Models\Trader;
use App\Models\trMstPelaporan;
use App\Models\vDataHeader;
use App\Models\vDtlPelaporan;
use App\Models\vForQr;
use Database\Factories\NotifFactory;
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
        JPPNotif::factory(50)->create();
        Menu::factory(8)->create();
        // Ppk::factory(20)->create();
        KategoriDokumen::factory(4)->create();
        vDataHeader::factory(20)->create();
        vForQr::factory(20)->create();
        trMstPelaporan::factory(20)->create();
        vDtlPelaporan::factory(50)->create();
        tbRTrader::factory(5)->create();
        // Notif::factory(2)->create();
        // FormModel::factory(5)->create();
    }
}
