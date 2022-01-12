<?php

namespace Database\Seeders;

use App\Models\Luaran;
use Illuminate\Database\Seeder;

class LuaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $data = Luaran::create([
                'kode' => "D.000" . $i,
                'luaran' => "Bersihan Jalan Napas Tidak Efektif",
            ]);
            for ($b = 0; $b < 5; $b++) {
                $data->kriterias()->create([
                    'nama' => 'nama ' . $b,
                ]);
            }
        }
    }
}
