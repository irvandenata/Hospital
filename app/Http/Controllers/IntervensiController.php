<?php

namespace App\Http\Controllers;

use App\Models\Intervensi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IntervensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $assets = Intervensi::latest()->get();
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                    <div class="row justify-content-center">
                    <a class="btn btn-success text-white  mx-1 mb-1 btn-sm" onclick="editItem(' . $asset->id . ')">Edit</span></a>

                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteItem(' . $asset->id . ')" >Delete</span></a>

                                </div>';
                })
                ->addColumn('terapeutik', function ($asset) {
                    return '   <a id="terapeutik" class="btn btn-warning btn-sm text-white  mx-1 mb-1" onclick="detailTerapeutik(' . $asset->id . ')" >Detail</span></a></div>';
                })
                ->addColumn('kolaborasi', function ($asset) {
                    return '   <a id="kolaborasi" class="btn btn-warning btn-sm text-white  mx-1 mb-1" onclick="detailKolaborasi(' . $asset->id . ')" >Detail</span></a></div>';
                })
                ->addColumn('observasi', function ($asset) {
                    return '   <a id="observasi" class="btn btn-warning btn-sm text-white  mx-1 mb-1" onclick="detailObservasi(' . $asset->id . ')" >Detail</span></a></div>';
                })
                ->addColumn('edukasi', function ($asset) {
                    return '   <a id="edukasi" class="btn btn-warning btn-sm text-white  mx-1 mb-1" onclick="detailEdukasi(' . $asset->id . ')" >Detail</span></a></div>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'terapeutik', 'kolaborasi', 'observasi', 'edukasi'])
                ->make(true);
        }

        $data['title'] = "Data Intervesi";

        return view('admin.intervensi.index', $data);
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
        $item = new Intervensi();
        $item->intervensi_keperawatan = $request->intervensi;
        $item->pengertian = $request->pengertian;
        $item->kode = $request->kode;
        $item->save();
        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Intervensi $intervensi)
    {
        return $intervensi;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Intervensi $intervensi)
    {
        $intervensi->intervensi_keperawatan = $request->intervensi;
        $intervensi->kode = $request->kode;
        $intervensi->pengertian = $request->pengertian;
        $intervensi->save();
        return $intervensi;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intervensi $intervensi)
    {
        $intervensi->delete();
        return response()->json('success');
    }
}
