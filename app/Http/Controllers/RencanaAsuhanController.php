<?php

namespace App\Http\Controllers;

use App\Http\Resources\RencanaAsuhanResource;
use App\Models\Diagnosa;
use App\Models\Intervensi;
use App\Models\Luaran;
use App\Models\RencanaAsuhan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RencanaAsuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $assets = RencanaAsuhan::latest()->get();
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                    <div class="row justify-content-center">

                    <a id="detail" class="btn btn-info btn-sm  text-white  mx-1 mb-1" onclick="detailItem(' . $asset->id . ')" >Detail</span></a>
                    <a class="btn btn-success btn-sm text-white  mx-1 mb-1" onclick="editItem(' . $asset->id . ')">Edit</span></a>

                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteItem(' . $asset->id . ')" >Delete</span></a>

                                </div>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        $data['diagnosa'] = Diagnosa::get();
        $data['luaran'] = Luaran::get();
        $data['intervensi'] = Intervensi::get();
        $data['title'] = "Data Asuhan";

        return view('admin.asuh.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $intervensi = array();
        $luaran = '';
        if ((isset($request->hasil_kriteriahasil) && count($request->hasil_kriteriahasil)) && (isset($request->hasil_kriteria2) && count($request->hasil_kriteria2))) {
            foreach ($request->hasil_kriteriahasil as $key => $value) {
                if ($key == 0) {
                    $luaran = $value . '-' . $request->hasil_kriteria2[$key];
                } else {
                    $luaran = $luaran . "/" . $value . '-' . $request->hasil_kriteria2[$key];
                }
            }
        }
        $h_sbj = isset($request->hasil_subjektif) && count($request->hasil_subjektif) > 0 ? implode(',', $request->hasil_subjektif) : '';
        $h_obj = isset($request->hasil_objektif) && count($request->hasil_objektif) > 0 ? implode(',', $request->hasil_objektif) : '';
        $h_penyebab = isset($request->hasil_penyebab) && count($request->hasil_penyebab) > 0 ? implode(',', $request->hasil_penyebab) : '';
        $data = RencanaAsuhan::create([
            'nama_ruangan' => $request->nama_ruangan,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'pasien'=> $request->pasien,
            'status_pertama' => $request->status_pertama,
            'ppja' => $request->ppja,
            'diagnosa_id' => $request->diagnosa_id,
            'hasil_diagnosa' => $h_penyebab . "/" . $h_obj . '/' . $h_sbj,
            'luaran_id' => $request->luaran_id,
            'ekspektasi' => $request->ekspektasi,
            'hasil_luaran' => $luaran,
            'penanggung_jawab' => $request->penanggung_jawab,
            'jumlah_intervensi' => $request->jumlah_intervensi,
            'tambahan_diagnosa_objektif' => $request->tambahan_diagnosa_objektif,
            'tambahan_diagnosa_subjektif' => $request->tambahan_diagnosa_subjektif,
            'tambahan_diagnosa_penyebab' => $request->tambahan_diagnosa_penyebab,
        ]);
        if (isset($request->intervensi_id)) {

            for ($b = 0; $b < count($request->intervensi_id); $b++) {
                $obs = isset($request['hasil_observasi_' . $request->intervensi_id[$b]]) && count($request['hasil_observasi_' . $request->intervensi_id[$b]]) ? implode(",", $request['hasil_observasi_' . $request->intervensi_id[$b]]) : '';
                $klb = isset($request['hasil_kolaborasi_' . $request->intervensi_id[$b]]) && count($request['hasil_kolaborasi_' . $request->intervensi_id[$b]]) ? implode(",", $request['hasil_kolaborasi_' . $request->intervensi_id[$b]]) : '';
                $trp = isset($request['hasil_terapeutik_' . $request->intervensi_id[$b]]) && count($request['hasil_terapeutik_' . $request->intervensi_id[$b]]) ? implode(",", $request['hasil_terapeutik_' . $request->intervensi_id[$b]]) : '';
                $edk = isset($request['hasil_edukasi_' . $request->intervensi_id[$b]]) && count($request['hasil_edukasi_' . $request->intervensi_id[$b]]) ? implode(",", $request['hasil_edukasi_' . $request->intervensi_id[$b]]) : '';

                $data->intervensis()->attach($request->intervensi_id[$b], array('hasil_observasi' => $obs, 'hasil_kolaborasi' => $klb, 'hasil_terapeutik' => $trp, 'hasil_edukasi' => $edk));
            }

        }

        return response()->json([201, $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = RencanaAsuhan::where('id', $id)->first();

        return response()->json(new RencanaAsuhanResource($data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = RencanaAsuhan::where('id', $id)->first();
        $intervensi = array();
        $luaran = '';
        if ((isset($request->hasil_kriteriahasil) && count($request->hasil_kriteriahasil)) && (isset($request->hasil_kriteria2) && count($request->hasil_kriteria2))) {
            foreach ($request->hasil_kriteriahasil as $key => $value) {
                if ($key == 0) {
                    $luaran = $value . '-' . $request->hasil_kriteria2[$key];
                } else {
                    $luaran = $luaran . "/" . $value . '-' . $request->hasil_kriteria2[$key];
                }
            }
        }
        $h_sbj = isset($request->hasil_subjektif) && count($request->hasil_subjektif) > 0 ? implode(',', $request->hasil_subjektif) : '';
        $h_obj = isset($request->hasil_objektif) && count($request->hasil_objektif) > 0 ? implode(',', $request->hasil_objektif) : '';
        $h_penyebab = isset($request->hasil_penyebab) && count($request->hasil_penyebab) > 0 ? implode(',', $request->hasil_penyebab) : '';
        $item->nama_ruangan = $request->nama_ruangan;
        $item->tanggal = $request->tanggal;
        $item->jam = $request->jam;
        $item->status_pertama = $request->status_pertama;
        $item->ppja = $request->ppja;
        $item->diagnosa_id = $request->diagnosa_id;
        $item->hasil_diagnosa = $h_penyebab . "/" . $h_obj . '/' . $h_sbj;
        $item->luaran_id = $request->luaran_id;
        $item->ekspektasi = $request->ekspektasi;
        $item->hasil_luaran = $luaran;
        $item->pasien = $request->pasien;
        $item->penanggung_jawab = $request->penanggung_jawab;
        $item->jumlah_intervensi = $request->jumlah_intervensi;
        $item->tambahan_diagnosa_objektif = $request->tambahan_diagnosa_objektif;
        $item->tambahan_diagnosa_subjektif = $request->tambahan_diagnosa_subjektif;
        $item->tambahan_diagnosa_penyebab = $request->tambahan_diagnosa_penyebab;
        $item->save();
        $item->intervensis()->detach();
        if (isset($request->intervensi_id)) {
            for ($b = 0; $b < count($request->intervensi_id); $b++) {
                $obs = isset($request['hasil_observasi_' . $request->intervensi_id[$b]]) && count($request['hasil_observasi_' . $request->intervensi_id[$b]]) ? implode(",", $request['hasil_observasi_' . $request->intervensi_id[$b]]) : '';
                $klb = isset($request['hasil_kolaborasi_' . $request->intervensi_id[$b]]) && count($request['hasil_kolaborasi_' . $request->intervensi_id[$b]]) ? implode(",", $request['hasil_kolaborasi_' . $request->intervensi_id[$b]]) : '';
                $trp = isset($request['hasil_terapeutik_' . $request->intervensi_id[$b]]) && count($request['hasil_terapeutik_' . $request->intervensi_id[$b]]) ? implode(",", $request['hasil_terapeutik_' . $request->intervensi_id[$b]]) : '';
                $edk = isset($request['hasil_edukasi_' . $request->intervensi_id[$b]]) && count($request['hasil_edukasi_' . $request->intervensi_id[$b]]) ? implode(",", $request['hasil_edukasi_' . $request->intervensi_id[$b]]) : '';
                $item->intervensis()->attach($request->intervensi_id[$b], array('hasil_observasi' => $obs, 'hasil_kolaborasi' => $klb, 'hasil_terapeutik' => $trp, 'hasil_edukasi' => $edk));
            }

        }
        return response()->json([201, $item]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RencanaAsuhan::where('id', $id)->first();
        if (count($item->intervensis) > 0) {
            $item->intervensis()->detach();
        }
        $item->delete();
        return response()->json([201, "Success"]);
    }
}
