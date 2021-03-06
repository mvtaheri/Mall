<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)
            ->create();
        Vendor::factory()->count(1)->create();
        Product::factory()->hasAttached(
            Favorite::factory()->count(10),
            ['send_notif_on_available'=>true]
        )->count(200)->create();

    }
}
