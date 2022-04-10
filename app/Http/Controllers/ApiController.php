<?php

namespace App\Http\Controllers;

use App\Models\DataObjektif;
use App\Models\DataSubjektif;
use App\Models\Diagnosa;
use App\Models\Edukasi;
use App\Models\Intervensi;
use App\Models\Kolaborasi;
use App\Models\KriteriaHasil;
use App\Models\Luaran;
use App\Models\Observasi;
use App\Models\Penyebab;
use App\Models\Terapeutik;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApiController extends Controller
{

    //PENYEBAB
    public function getPenyebab($id)
    {

        $item = Penyebab::where('diagnosa_id', $id)->get();
        return response()->json($item);
    }

    public function deletePenyebab($id)
    {
        $item = Penyebab::where('id', $id)->first();
        $item->delete();
        return response()->json('success');
    }

    public function storePenyebab(Request $request)
    {

        $item = new Penyebab();
        $item->nama = $request->nama;
        $item->diagnosa_id = $request->diagnosa_id;
        $item->save();
        return response()->json($item);
    }

    public function updatePenyebab(Request $request, $id)
    {

        $item = Penyebab::where('id', $id)->first();
        $item->nama = $request->nama;
        $item->save();
        return response()->json($item);
    }

    public function getTablePenyebab(Request $request)
    {
        if ($request->ajax()) {

            $assets = Diagnosa::where('id', $request->id)->first()->penyebabs;
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                             <a  class="btn btn-success btn-sm text-white  mx-1 mb-1" onclick="editChild(' . $asset->id . ',`' . $asset->nama . '`,`penyebab`)" >Edit</span></a>
                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deletePenyebab(' . $asset->id . ')" >Delete</span></a>
                                </div>';
                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    //OBJEKTIF
    public function getObj($id)
    {

        $item = DataObjektif::where('diagnosa_id', $id)->get();
        return response()->json($item);
    }
    public function deleteObjektif($id)
    {
        $item = DataObjektif::where('id', $id)->first();
        $item->delete();
        return response()->json('success');
    }

    public function updateObjektif(Request $request, $id)
    {
        $item = DataObjektif::where('id', $id)->first();
        $item->nama = $request->nama;
        $item->save();
        return response()->json($item);
    }

    public function storeObjektif(Request $request)
    {

        $item = new DataObjektif();
        $item->nama = $request->nama;
        $item->diagnosa_id = $request->diagnosa_id;
        $item->save();
        return response()->json($item);
    }

    public function getTableObjektif(Request $request)
    {
        if ($request->ajax()) {

            $assets = Diagnosa::where('id', $request->id)->first()->objektifs;
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                        <a  class="btn btn-success btn-sm text-white  mx-1 mb-1" onclick="editChild(' . $asset->id . ',`' . $asset->nama . '`,`objektif`)" >Edit</span></a>
                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteObjektif(' . $asset->id . ')" >Delete</span></a>
                                </div>';
                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    //SUBJEKTIF
    public function getSbj($id)
    {

        $item = DataSubjektif::where('diagnosa_id', $id)->get();
        return response()->json($item);
    }
    public function deleteSubjektif($id)
    {
        $item = DataSubjektif::where('id', $id)->first();
        $item->delete();
        return response()->json('success');
    }

    public function storeSubjektif(Request $request)
    {

        $item = new DataSubjektif();
        $item->nama = $request->nama;
        $item->diagnosa_id = $request->diagnosa_id;
        $item->save();
        return response()->json($item);
    }

    public function getTableSubjektif(Request $request)
    {
        if ($request->ajax()) {

            $assets = Diagnosa::where('id', $request->id)->first()->subjektifs;
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                        <a  class="btn btn-success btn-sm text-white  mx-1 mb-1" onclick="editChild(' . $asset->id . ',`' . $asset->nama . '`,`subjektif`)" >Edit</span></a>
                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteSubjektif(' . $asset->id . ')" >Delete</span></a>
                                </div>';
                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function updateSubjektif(Request $request, $id)
    {
        $item = DataSubjektif::where('id', $id)->first();
        $item->nama = $request->nama;
        $item->save();
        return response()->json($item);
    }

    //KRITERIA
    public function getKriteria($id)
    {
        $item = KriteriaHasil::where('luaran_id', $id)->get();
        return response()->json($item);
    }

    public function deleteKriteria($id)
    {

        $item = KriteriaHasil::where('id', $id)->first();
        $item->delete();
        return response()->json('success');
    }

    public function storeKriteria(Request $request)
    {

        $item = new KriteriaHasil();
        $item->nama = $request->nama;
        $item->luaran_id = $request->luaran_id;
        $item->kelompok = $request->kelompok;

        $item->save();
        return response()->json($item);
    }

    public function getTableKriteria(Request $request)
    {
        if ($request->ajax()) {

            $assets = Luaran::where('id', $request->id)->first()->kriterias;
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                    <a  class="btn btn-success btn-sm text-white  mx-1 mb-1" onclick="editChild(' . $asset->id . ',`' . $asset->nama . '`,`' . $asset->kelompok . '`,`kriteria`)" >Edit</span></a>
                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteKriteria(' . $asset->id . ')" >Delete</span></a>
                                </div>';
                })
                ->addColumn('kelompok', function ($asset) {
                    return str_replace(";", ", ", $asset->kelompok);

                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function updateKriteria(Request $request, $id)
    {
        $item = KriteriaHasil::where('id', $id)->first();
        $item->nama = $request->nama;
        $item->kelompok = $request->kelompok;
        $item->save();
        return response()->json($item);
    }

    public function getIntervensi($id)
    {
        $item = Intervensi::where('id', $id)->first();
        $kolaborasi = $item->kolaborasis;
        $terapeutik = $item->terapeutiks;
        $edukasi = $item->edukasis;
        $observasi = $item->observasis;
        return response()->json(['observasi' => $observasi, 'terapeutik' => $terapeutik, 'edukasi' => $edukasi, 'kolaborasi' => $kolaborasi, 'nama' => $item->intervensi_keperawatan, "kode" => $item->kode, "pengertian" => $item->pengertian, "id" => $item->id]);
    }

    //TERAPEUTIK
    public function getTerapeutik($id)
    {
        $item = Penyebab::where('intervensi_id', $id)->get();
        return response()->json($item);
    }

    public function deleteTerapeutik($id)
    {
        $item = Terapeutik::where('id', $id)->first();
        $item->delete();
        return response()->json('success');
    }

    public function storeTerapeutik(Request $request)
    {

        $item = new Terapeutik();
        $item->nama = $request->nama;
        $item->intervensi_id = $request->intervensi_id;
        $item->save();
        return response()->json($item);
    }

    public function updateTerapeutik(Request $request, $id)
    {

        $item = Terapeutik::where('id', $id)->first();
        $item->nama = $request->nama;
        $item->save();
        return response()->json($item);
    }

    public function getTableTerapeutik(Request $request)
    {
        if ($request->ajax()) {

            $assets = Intervensi::where('id', $request->id)->first()->terapeutiks;

            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                             <a  class="btn btn-success btn-sm text-white  mx-1 mb-1" onclick="editChild(' . $asset->id . ',`' . $asset->nama . '`,`terapeutik`)" >Edit</span></a>
                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteTerapeutik(' . $asset->id . ')" >Delete</span></a>
                                </div>';
                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    //KOLABORASI
    public function getKolaborasi($id)
    {
        $item = Kolaborasi::where('intervensi_id', $id)->get();
        return response()->json($item);
    }

    public function deleteKolaborasi($id)
    {
        $item = Kolaborasi::where('id', $id)->first();
        $item->delete();
        return response()->json('success');
    }

    public function storeKolaborasi(Request $request)
    {

        $item = new Kolaborasi();
        $item->nama = $request->nama;
        $item->intervensi_id = $request->intervensi_id;
        $item->save();
        return response()->json($item);
    }

    public function updateKolaborasi(Request $request, $id)
    {

        $item = Kolaborasi::where('id', $id)->first();
        $item->nama = $request->nama;
        $item->save();
        return response()->json($item);
    }

    public function getTableKolaborasi(Request $request)
    {
        if ($request->ajax()) {

            $assets = Intervensi::where('id', $request->id)->first()->kolaborasis;

            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                             <a  class="btn btn-success btn-sm text-white  mx-1 mb-1" onclick="editChild(' . $asset->id . ',`' . $asset->nama . '`,`kolaborasi`)" >Edit</span></a>
                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteKolaborasi(' . $asset->id . ')" >Delete</span></a>
                                </div>';
                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    //OBSERVASI
    public function getObservasi($id)
    {
        $item = Observasi::where('intervensi_id', $id)->get();
        return response()->json($item);
    }

    public function deleteObservasi($id)
    {
        $item = Observasi::where('id', $id)->first();
        $item->delete();
        return response()->json('success');
    }

    public function storeObservasi(Request $request)
    {

        $item = new Observasi();
        $item->nama = $request->nama;
        $item->intervensi_id = $request->intervensi_id;
        $item->save();
        return response()->json($item);
    }

    public function updateObservasi(Request $request, $id)
    {

        $item = Observasi::where('id', $id)->first();
        $item->nama = $request->nama;
        $item->save();
        return response()->json($item);
    }

    public function getTableObservasi(Request $request)
    {
        if ($request->ajax()) {

            $assets = Intervensi::where('id', $request->id)->first()->observasis;

            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                             <a  class="btn btn-success btn-sm text-white  mx-1 mb-1" onclick="editChild(' . $asset->id . ',`' . $asset->nama . '`,`observasi`)" >Edit</span></a>
                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteObservasi(' . $asset->id . ')" >Delete</span></a>
                                </div>';
                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    //EDUKASI
    public function getEdukasi($id)
    {
        $item = Edukasi::where('intervensi_id', $id)->get();
        return response()->json($item);
    }

    public function deleteEdukasi($id)
    {
        $item = Edukasi::where('id', $id)->first();
        $item->delete();
        return response()->json('success');
    }

    public function storeEdukasi(Request $request)
    {

        $item = new Edukasi();
        $item->nama = $request->nama;
        $item->intervensi_id = $request->intervensi_id;
        $item->save();
        return response()->json($item);
    }

    public function updateEdukasi(Request $request, $id)
    {

        $item = Edukasi::where('id', $id)->first();
        $item->nama = $request->nama;
        $item->save();
        return response()->json($item);
    }

    public function getTableEdukasi(Request $request)
    {
        if ($request->ajax()) {

            $assets = Intervensi::where('id', $request->id)->first()->edukasis;

            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                             <a  class="btn btn-success btn-sm text-white  mx-1 mb-1" onclick="editChild(' . $asset->id . ',`' . $asset->nama . '`,`edukasi`)" >Edit</span></a>
                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteEdukasi(' . $asset->id . ')" >Delete</span></a>
                                </div>';
                })

                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

    }
}
