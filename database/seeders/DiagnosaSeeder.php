<?php

namespace Database\Seeders;

use App\Models\Diagnosa;
use Illuminate\Database\Seeder;

class DiagnosaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 5; $i++) {
            $data = Diagnosa::create([
                'kode' => "D.000" . $i,
                'diagnosis' => "Bersihan Jalan Napas Tidak Efektif",
                'definisi' => "Ketidakmampuan membersihkan sekret atau obstruksi jalan napas untuk mempertahankan jalan napas tetap paten",
            ]);
            for ($b = 0; $b < 5; $b++) {
                $data->objektifs()->create([
                    'nama' => 'nama ' . $b,
                ]);
            }
            for ($b = 0; $b < 5; $b++) {
                $data->penyebabs()->create([
                    'nama' => 'nama ' . $b,
                ]);
            }
            for ($b = 0; $b < 5; $b++) {
                $data->subjektifs()->create([
                    'nama' => 'nama ' . $b,
                ]);
            }
        }
    }
}
