<?php

namespace Database\Seeders;

use App\Models\Intervensi;
use Illuminate\Database\Seeder;

class IntervensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $data =  Intervensi::create([
                'kode' => "D.000" . $i,
                'pengertian' => "ini pengertiannya",
                'intervensi_keperawatan' => "Bersihan Jalan Napas Tidak Efektif",

            ]);
            for ($b = 0; $b < 5; $b++) {
                $data->kolaborasis()->create([
                    'nama' => 'nama ' . $b,
                ]);
            }
            for ($b = 0; $b < 5; $b++) {
                $data->observasis()->create([
                    'nama' => 'nama ' . $b,
                ]);
            }
            for ($b = 0; $b < 5; $b++) {
                $data->edukasis()->create([
                    'nama' => 'nama ' . $b,
                ]);
            }
            for ($b = 0; $b < 5; $b++) {
                $data->terapeutiks()->create([
                    'nama' => 'nama ' . $b,
                ]);
            }
        }
    }
}
