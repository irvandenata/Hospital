<?php

namespace App\Http\Resources;

use App\Models\DataObjektif;
use App\Models\DataSubjektif;
use App\Models\Edukasi;
use App\Models\IntervensiRencanaAsuhan;
use App\Models\Kolaborasi;
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
        foreach($this->intervensis as $key => $value) {
             $intervensi = array();
            $hasilIntervensi = IntervensiRencanaAsuhan::where('intervensi_id',$value->id)->where('rencana_asuhan_id',$value->id)->first();
                $intervensi['nama'] = $value->intervensi_keperawatan;
                $intervensi['kode'] = $value->kode;
                $intervensi['pengertian'] = $value->pengertian;
                $intervensi['intervensi_keperawatan'] = $value->intervensi_keperawatan;
                $intervensi['observasi'] = Observasi::whereIn('id', explode(',',$hasilIntervensi->hasil_observasi))->get();
                $intervensi['terapeutik'] = Terapeutik::whereIn('id', explode(',',$hasilIntervensi->hasil_terapeutik))->get();
                $intervensi['kolaborasi'] = Kolaborasi::whereIn('id', explode(',',$hasilIntervensi->hasil_kolaborasi))->get();
                $intervensi['edukasi'] = Edukasi::whereIn('id', explode(',',$hasilIntervensi->hasil_edukasi))->get();

                 $dataIntervensi[$key] = $intervensi;
            }
        $data = explode("/",$this->hasil_diagnosa);
        return   [
            'id' => $this->id,
            'nama_ruangan' => $this->nama_ruangan,
            'penanggung_jawab' => $this->penanggung_jawab,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'ppja' => $this->ppja,
            'diagnosa' => $this->diagnosa,
            'luaran' => $this->luaran,

            'hasil_diagnosa' => [
                'penyebab'=> Penyebab::whereIn('id',explode(",",$data[0]))->get(),
                'data_objektif'=>DataObjektif::whereIn('id',explode(",",$data[1]))->get(),
                'data_subjektif'=>DataSubjektif::whereIn('id',explode(",",$data[2]))->get(),
            ],

            'hasil_luaran' => [
                'kriteria_hasil'=> Penyebab::whereIn('id',explode(",",$this->hasil_luaran))->get(),
            ],
            'jumlah_intervensi' => $this->jumlah_intervensi,
            'intervensi' =>   $dataIntervensi ,

        ];
    }
}
