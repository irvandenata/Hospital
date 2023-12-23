<?php

namespace App\Http\Resources;

use App\Models\DataObjektif;
use App\Models\DataSubjektif;
use App\Models\Edukasi;
use App\Models\IntervensiRencanaAsuhan;
use App\Models\Kolaborasi;
use App\Models\KriteriaHasil;
use App\Models\Luaran;
use App\Models\Observasi;
use App\Models\Penyebab;
use App\Models\Terapeutik;
use Illuminate\Http\Resources\Json\JsonResource;

class RencanaAsuhanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dataIntervensi = array();
        $id = $this->id;
        foreach ($this->intervensis as $key => $value) {
            $intervensi = array();
            $hasilIntervensi = IntervensiRencanaAsuhan::where('rencana_asuhan_id', $id)->where('intervensi_id', $value->id)->first();
            $intervensi['nama'] = $value->intervensi_keperawatan;
            $intervensi['kode'] = $value->kode;
            $intervensi['id'] = $value->id;
            $intervensi['pengertian'] = $value->pengertian;
            $intervensi['intervensi_keperawatan'] = $value->intervensi_keperawatan;
            $intervensi['hasil_observasi'] = Observasi::whereIn('id', explode(',', $hasilIntervensi->hasil_observasi))->get();
            $intervensi['hasil_terapeutik'] = Terapeutik::whereIn('id', explode(',', $hasilIntervensi->hasil_terapeutik))->get();
            $intervensi['hasil_kolaborasi'] = Kolaborasi::whereIn('id', explode(',', $hasilIntervensi->hasil_kolaborasi))->get();
            $intervensi['hasil_edukasi'] = Edukasi::whereIn('id', explode(',', $hasilIntervensi->hasil_edukasi))->get();

            $dataIntervensi[$key] = $intervensi;
        }
        $kriteria_hasil = array();
        $tamp = explode("/", $this->hasil_luaran);
        foreach ($tamp as $key => $value) {
            $tamp2 = explode("-", $value);
            array_push($kriteria_hasil, $tamp2[0]);
        }
        $data = explode("/", $this->hasil_diagnosa);
        return [
            'id' => $this->id,
            'nama_ruangan' => $this->nama_ruangan,
            'penanggung_jawab' => $this->penanggung_jawab,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'status_pertama' => $this->status_pertama,
            'ppja' => $this->ppja,
            'diagnosa' => $this->diagnosa,
            'luaran' => $this->luaran,
            'ekspektasi' => $this->ekspektasi,
            'tambahan_diagnosa_objektif' => $this->tambahan_diagnosa_objektif,
            'tambahan_diagnosa_subjektif' => $this->tambahan_diagnosa_subjektif,
            'tambahan_diagnosa_penyebab' => $this->tambahan_diagnosa_penyebab,

            'hasil_diagnosa' => [
                'penyebab' => Penyebab::whereIn('id', explode(",", $data[0]))->get(),
                'data_objektif' => DataObjektif::whereIn('id', explode(",", $data[1]))->get(),
                'data_subjektif' => DataSubjektif::whereIn('id', explode(",", $data[2]))->get(),
            ],

            'hasil_luaran' => [
                'kriteria_hasil' => KriteriaHasil::whereIn('id', $kriteria_hasil)->get(),
                'kriteria_sub' => $this->hasil_luaran,

            ],
            'jumlah_intervensi' => $this->jumlah_intervensi,
            'intervensi' => $dataIntervensi,
            'pasien' => $this->pasien,

        ];
    }
}
