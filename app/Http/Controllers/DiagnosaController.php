<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $assets = Diagnosa::latest()->get();
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    return '
                    <div class="row justify-content-center">
                    <a class="btn btn-success text-white  mx-1 mb-1 btn-sm" onclick="editItem(' . $asset->id . ')">Edit</span></a>

                                <a id="delete" class="btn btn-danger btn-sm text-white  mx-1 mb-1" onclick="deleteItem(' . $asset->id . ')" >Delete</span></a>

                                </div>';
                })
                ->addColumn('penyebab', function ($asset) {
                    return '   <a id="penyebab" class="btn btn-warning btn-sm text-white  mx-1 mb-1" onclick="detailPenyebab(' . $asset->id . ')" >Detail</span></a></div>';
                })
                ->addColumn('subjektif', function ($asset) {
                    return '   <a id="subjektif" class="btn btn-warning btn-sm text-white  mx-1 mb-1" onclick="detailSubjektif(' . $asset->id . ')" >Detail</span></a></div>';
                })
                ->addColumn('objektif', function ($asset) {
                    return '   <a id="objektif" class="btn btn-warning btn-sm text-white  mx-1 mb-1" onclick="detailObjektif(' . $asset->id . ')" >Detail</span></a></div>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action', 'penyebab', 'objektif', 'subjektif'])
                ->make(true);
        }

        $data['title'] = "Data Diagnosa";

        return view('admin.diagnosa.index', $data);
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
        $item = new Diagnosa();
        $item->diagnosis = $request->diagnosis;
        $item->definisi = $request->definisi;
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
    public function edit(Diagnosa $diagnosa)
    {
        return $diagnosa;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnosa $diagnosa)
    {
        $diagnosa->diagnosis = $request->diagnosis;
        $diagnosa->kode = $request->kode;
        $diagnosa->definisi = $request->definisi;
        $diagnosa->save();
        return $diagnosa;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosa $diagnosa)
    {
        $diagnosa->delete();
        return response()->json("success");
    }
}
