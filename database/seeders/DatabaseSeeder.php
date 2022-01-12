<?php

namespace Database\Seeders;

use App\Models\RencanaAsuhan;
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
        $this->call([
            DiagnosaSeeder::class,
            IntervensiSeeder::class,
            LuaranSeeder::class,
            RencanaAsuhSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
