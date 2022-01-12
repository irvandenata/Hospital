<?php

namespace Database\Seeders;

use App\Models\RencanaAsuhan;
use Illuminate\Database\Seeder;

class RencanaAsuhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $data = RencanaAsuhan::create([
                'nama_ruangan' => "Room " . $i,
                'tanggal' => $i . "/5/2020",
                'jam' => $i . ":00",
                'ppja' => "ppja " . $i,
                'diagnosa_id' => $i + 1,
                'hasil_diagnosa' => "1,2,3,4/1,2,3/3,2",
                'luaran_id' => $i + 1,
                'hasil_luaran' => "1,2,3,4",
                'penanggung_jawab' => "jamal " . $i,
                'jumlah_intervensi' => $i+1,



            ]);
            for ($b = 0; $b < 5; $b++) {
                $data->intervensis()->attach(($i + 1), array('hasil_observasi' => "1,2,3,4",'hasil_kolaborasi' => "1,2,3,4",'hasil_edukasi' => "1,2,3,4",'hasil_terapeutik' => "1,2,3,4",));
            }
        }
    }
}
